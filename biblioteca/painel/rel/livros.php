<?php 
include('../../conexao.php');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

$cat = $_GET['cat'];
$editora = $_GET['editora'];
$local = $_GET['local'];
$status = $_GET['status'];

$nome_categ = "";
if($cat != ""){
	$query2 = $pdo->query("SELECT * from categorias where id = '$cat'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_categ = 'Categoria: '.@$res2[0]['nome']; 
}

$nome_edit = "";
if($editora != ""){
	$query2 = $pdo->query("SELECT * from editoras where id = '$editora'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_edit = 'Editora: '.@$res2[0]['nome']; 
}

$nome_loc = "";
if($local != ""){
	$query2 = $pdo->query("SELECT * from locais where id = '$local'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_loc = 'Local: '.@$res2[0]['nome']; 
}

$nome_stat = "";
if($status != ""){
	$nome_stat = 'Status: '.$status; 
}

$texto_filtro = "";
if($nome_categ != "" || $nome_edit != "" || $nome_loc != "" ||  $nome_stat != ""){
	$texto_filtro = 'Livros '.$nome_categ.' '.$nome_edit.' '.$nome_loc.' '.$nome_stat;
}


?>
<!DOCTYPE html>
<html>
<head>

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
						<b><big>RELATÓRIO DE LIVROS</big></b><br> <?php echo mb_strtoupper($texto_filtro) ?> <br> <?php echo mb_strtoupper($data_hoje) ?>
				</td>
			</tr>		
		</table>
	</div>

<br>


		<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 8px; margin-bottom:10px; width: 100%; table-layout: fixed;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#CCC">
					<td style="width:8%">CÓDIGO</td>
					<td style="width:22%">TÍTULO</td>
					<td style="width:17%">CATEGORIA</td>
					<td style="width:15%">EDIÇÃO</td>
					<td style="width:15%">EDITORA</td>
					<td style="width:15%">LOCAL</td>				
					<td style="width:8%">STATUS</td>	
					
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



		<table style="width: 100%; table-layout: fixed; font-size:7px; text-transform: uppercase;">
			<thead>
				<tbody>
					<?php 
	$livros_emprestados = 0;
			$livros_disponiveis = 0;
			$query = $pdo->query("SELECT * from livros where categoria LIKE '%$cat%' and editora LIKE '%$editora%' and local LIKE '%$local%' and status LIKE '%$status%' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$codigo = $res[$i]['codigo'];
	$titulo = $res[$i]['titulo'];
	$subtitulo = $res[$i]['subtitulo'];
	$autor = $res[$i]['autor'];
	$ano = $res[$i]['ano'];
	$editora = $res[$i]['editora'];
	$edicao = $res[$i]['edicao'];
	$categoria = $res[$i]['categoria'];
	$foto = $res[$i]['foto'];
	$local = $res[$i]['local'];
	$status = $res[$i]['status'];
	$obs = $res[$i]['obs'];
	$data_cad = $res[$i]['data_cad'];

	$dataF = implode('/', array_reverse(explode('-', $data_cad)));

	if($status == 'Disponível'){	
		$classe_ativo = 'verde.jpg';
		$livros_disponiveis += 1;
	}else{			
		$classe_ativo = 'vermelho.jpg';
		$livros_emprestados += 1;
	}

	if($obs == ""){
		$disp = 'none';
	}else{
		$disp = 'inline-block';
	}

	
	$query2 = $pdo->query("SELECT * from categorias where id = '$categoria'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_categoria = @$res2[0]['nome'];

	$query2 = $pdo->query("SELECT * from locais where id = '$local'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_local = @$res2[0]['nome'];

	$query2 = $pdo->query("SELECT * from editoras where id = '$editora'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_editora = @$res2[0]['nome'];

  	 ?>

  	 
      <tr>
<td style="width:8%"><?php echo $codigo ?></td>
<td style="width:22%"><?php echo $titulo ?></td>
<td style="width:17%"><?php echo $nome_categoria ?></td>
<td style="width:15%"><?php echo $edicao ?></td>
<td style="width:15%"><?php echo $nome_editora ?></td>
<td style="width:15%"><?php echo $nome_local ?></td>
<td style="width:8%"><img src="<?php echo $url_sistema ?>img/<?php echo $classe_ativo ?>" width="12px"></td>
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
						<td style="font-size: 10px; width:332px; text-align: left;"<b>Total de registros: <?php echo $linhas ?></td>
						<td style="font-size: 10px; width:130px; padding-right: 5px; text-align: right;"></td>						
						<td style="font-size: 10px; width:130px; padding-right: 5px; text-align: right; color:green"><b>DISPONÍVEIS: <?php echo $livros_disponiveis ?></td>
						<td style="font-size: 10px; width:130px; padding-right: 5px; text-align: right; color:red"><b>EMPRESTADOS: <?php echo $livros_emprestados ?></td>
					</tr>
				</tbody>
			</thead>
		</table>

</body>

</html>


