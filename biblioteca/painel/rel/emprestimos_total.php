<?php 
include('../../conexao.php');
$data_atual = date('Y-m-d');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

$inicio = $_GET['inicio'];
$final = $_GET['final'];
$status = $_GET['status'];

$inicioF = implode('/', array_reverse(explode('-', $inicio)));
$finalF = implode('/', array_reverse(explode('-', $final)));

if($status == 'data_emprestimo'){
	$texto_status = 'Data Empréstimos: ';
}else{
	$texto_status = 'Data Entrega: ';
}

$texto_filtro = "";
if($inicio == $final){
	$texto_filtro = $texto_status.$inicioF;
}else{
	$texto_filtro = $texto_status.$inicioF.' Até '.$finalF;
}


?>
<!DOCTYPE html>
<html>
<head>
<title>Relatório de Empréstimos</title>
<style>

@import url('https://fonts.cdnfonts.com/css/tw-cen-mt-condensed');
@page { margin: 145px 20px 25px 20px; }
#header { position: fixed; left: 0px; top: -110px; bottom: 100px; right: 0px; height: 35px; text-align: center; padding-bottom: 100px; }
#content {margin-top: 0px;}
#footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 80px; }
#footer .page:after {content: counter(page, my-sec-counter);}
body {font-family: 'Tw Cen MT', sans-serif;}

.marca{
	position:fixed;
	left:50;
	top:100;
	width:80%;
	opacity:8%;
}

.text-danger{
	color:red;
}

.verde{
	color:green;
}

</style>

</head>
<body>
<?php 
if($marca_dagua == 'Sim'){ ?>
<img class="marca" src="<?php echo $url_sistema ?>img/logo.jpg">	
<?php } ?>


<div id="header" >

	<div style="border-style: solid; font-size: 10px; height: 50px;">
		<table style="width: 100%; border: 0px solid #ccc;">
			<tr>
				<td style="border: 1px; solid #000; width: 7%; text-align: left;">
					<img style="margin-top: 7px; margin-left: 7px;" id="imag" src="<?php echo $url_sistema ?>img/logo.jpg" width="45px">
				</td>
				<td style="width: 33%; text-align: left; font-size: 13px;">
				<?php echo mb_strtoupper($nome_sistema) ?>	
				</td>
				<td style="width: 5%; text-align: center; font-size: 13px;">
				
				</td>
				<td style="width: 40%; text-align: right; font-size: 9px;padding-right: 10px;">
						<b><big>RELATÓRIO DE EMPRÉSTIMOS</big></b><br> <?php echo mb_strtoupper($texto_filtro) ?> <br> <?php echo mb_strtoupper($data_hoje) ?>
				</td>
			</tr>		
		</table>
	</div>

<br>


		<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 10px; margin-bottom:10px; width: 100%; table-layout: fixed;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#CCC">
					<td style="width:28%">LIVRO</td>
					<td style="width:22%">LEITOR</td>
					<td style="width:10%">EMPRESTADO</td>
					<td style="width:10%">ENTREGA</td>
					<td style="width:20%">FUNCIONÁRIO</td>				
					<td style="width:10%">DEVOLVIDO</td>	
				</tr>
			</thead>
		</table>
</div>

<div id="footer" class="row">
<hr style="margin-bottom: 0;">
	<table style="width:100%;">
		<tr style="width:100%;">
			<td style="width:60%; font-size: 10px; text-align: left;"><?php echo $nome_sistema ?> Telefone: <?php echo $telefone_sistema ?></td>
			<td style="width:40%; font-size: 10px; text-align: right;"><p class="page">Página  </p></td>
		</tr>
	</table>
</div>

<div id="content" style="margin-top: 0;">



		<table style="width: 100%; table-layout: fixed; font-size:9px; text-transform: uppercase;">
			<thead>
				<tbody>
					<?php 
	$atrasos = 0;		
$total_devolvidos = 0;
$total_emprestados = 0;

	$query = $pdo->query("SELECT * from emprestimos where $status >= '$inicio' and $status <= '$final' order by id desc");

			
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$livro = $res[$i]['livro'];
	$leitor = $res[$i]['leitor'];
	$data_emprestimo = $res[$i]['data_emprestimo'];
	$data_devolucao = $res[$i]['data_devolucao'];
	$obs = $res[$i]['obs'];
	$funcionario = $res[$i]['funcionario'];
	$devolvido = $res[$i]['devolvido'];	

	$data_emprestimoF = implode('/', array_reverse(explode('-', $data_emprestimo)));
	$data_devolucaoF = implode('/', array_reverse(explode('-', $data_devolucao)));

	if($data_devolucao < $data_atual and $devolvido != 'Sim'){	
	$classe_ativo = 'text-danger';
	$atrasos += 1;
	}else{			
		$classe_ativo = '';
	}

	if($obs == ""){
		$disp = 'none';
	}else{
		$disp = 'inline-block';
	}

	
	$query2 = $pdo->query("SELECT * from livros where id = '$livro'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_livro = @$res2[0]['titulo'];

	$query2 = $pdo->query("SELECT * from leitores where id = '$leitor'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_leitor = @$res2[0]['nome'];

	$query2 = $pdo->query("SELECT * from usuarios where id = '$funcionario'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_func = @$res2[0]['nome'];

	if($devolvido == 'Sim'){	
	$classe_ativo2 = '';
	$total_devolvidos += 1;
	}else{			
		$classe_ativo2 = 'text-danger';
		$total_emprestados += 1;
	}

  	 ?>

  	 
      <tr class="<?php echo $classe_ativo ?>">
<td style="width:28%"><?php echo $nome_livro ?></td>
<td style="width:22%"><?php echo $nome_leitor ?></td>
<td style="width:10%"><?php echo $data_emprestimoF ?></td>
<td style="width:10%"><?php echo $data_devolucaoF ?></td>
<td style="width:20%"><?php echo $nome_func ?></td>
<td style="width:10%" class="<?php echo $classe_ativo2 ?>"><?php echo $devolvido ?></td>
    </tr>

<?php } } ?>
				</tbody>
	
			</thead>
		</table>
	


</div>
<hr>
		<table>
			<thead>
				<tbody>
					<tr>
						<td style="font-size: 10px; width:332px; text-align: left;"><b>Empréstimos: <?php echo $linhas ?></td>
						<td style="font-size: 10px; width:130px; padding-right: 5px; text-align: right;"></td>

						<td style="font-size: 10px; width:130px; padding-right: 5px; text-align: right; color:green"><b>DEVOLVIDOS: <?php echo $total_devolvidos ?></td>
						<td style="font-size: 10px; width:130px; padding-right: 5px; text-align: right; color:red"><b>EMPRESTADOS: <?php echo $total_emprestados ?></td>				
						
					</tr>
				</tbody>
			</thead>
		</table>

</body>

</html>


