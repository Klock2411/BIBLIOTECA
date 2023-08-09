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
	<title>Relatório de Livros</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">


<style>

		@page {
			margin: 0px;

		}

		body{
			margin-top:5px;
			font-family:Times, "Times New Roman", Georgia, serif;
		}		

			.footer {
				margin-top:20px;
				width:100%;
				background-color: #ebebeb;
				padding:5px;
				position:absolute;
				bottom:0;
			}

		

		.cabecalho {    
			padding:10px;
			margin-bottom:30px;
			width:100%;
			font-family:Times, "Times New Roman", Georgia, serif;
		}

		.titulo_cab{
			color:#0340a3;
			font-size:20px;
		}

		
		
		.titulo{
			margin:0;
			font-size:28px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;

		}

		.subtitulo{
			margin:0;
			font-size:12px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;
		}



		hr{
			margin:8px;
			padding:0px;
		}


		
		.area-cab{
			
			display:block;
			width:100%;
			height:10px;

		}

		
		.coluna{
			margin: 0px;
			float:left;
			height:30px;
		}

		.area-tab{
			
			display:block;
			width:100%;
			height:30px;

		}


		.imagem {
			width: 130px;
			position:absolute;
			right:20px;
			top:10px;
		}

		.titulo_img {
			position: absolute;
			margin-top: 10px;
			margin-left: 10px;

		}

		.data_img {
			position: absolute;
			margin-top: 40px;
			margin-left: 10px;
			border-bottom:1px solid #000;
			font-size: 10px;
		}

		.endereco {
			position: absolute;
			margin-top: 50px;
			margin-left: 10px;
			border-bottom:1px solid #000;
			font-size: 10px;
		}

		.verde{
			color:green;
		}



		table.borda {
    		border-collapse: collapse; /* CSS2 */
    		background: #FFF;
    		font-size:12px;
    		vertical-align:middle;
		}
 
		table.borda td {
		    border: 1px solid #dbdbdb;
		}
		 
		table.borda th {
		    border: 1px solid #dbdbdb;
		    background: #ededed;
		    font-size:13px;
		}

		table{
			width:100%;
			text-align: center;
		}


		.esquerda{
			display:inline;
			width:50%;
			float:left;
		}

		.direita{
			display:inline;
			width:50%;
			float:right;
		}

		.text-danger{
			color:red;
		}

		.mx-2{
			margin:0px 10px;
		}
			
				

	</style>

</head>
<body>	

<div class="titulo_cab titulo_img"><u>Relatório de Livros </u></div>	
	<div class="data_img"><?php echo mb_strtoupper($data_hoje) ?></div>

	<img class="imagem" src="<?php echo $url_sistema ?>img/logo.jpg">

	
	<br><br><br>
	<div class="cabecalho" style="border-bottom: solid 1px #0340a3">
	</div>


	<div class="mx-2" >

			
			<div style="margin-top: -20px; margin-bottom: 10px">
				<small><small><small><u><?php echo $texto_filtro ?></u></small></small></small>
			</div>	

			<?php 
			$livros_emprestados = 0;
			$livros_disponiveis = 0;
			$query = $pdo->query("SELECT * from livros where categoria LIKE '%$cat%' and editora LIKE '%$editora%' and local LIKE '%$local%' and status LIKE '%$status%' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
			 ?>


			 <table class="table table-striped borda" cellpadding="6">
  <thead>
    <tr align="center">
      <th>Código</th>	
		<th class="esc">Título</th>	
		<th class="esc">Categoria</th>
		<th class="esc">Edição</th>
		<th class="esc">Local</th>
		<th class="esc">Status</th>
    </tr>
  </thead>
  <tbody>

  	<?php 

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


  	  <tr align="center">
      <tr>
<td><?php echo $codigo ?></td>
<td class="esc"><?php echo $titulo ?></td>
<td class="esc"><?php echo $nome_categoria ?></td>
<td class="esc"><?php echo $edicao ?></td>
<td class="esc"><?php echo $classe_ativo ?></td>
<td class="esc"><img src="<?php echo $url_sistema ?>img/<?php echo $classe_ativo ?>" width="13px"></td>
    </tr>

<?php } ?>
  
  </tbody>
</table>

<?php }else{
echo 'Não possuem registros para serem exibidos!';
exit();
} ?>

	</div>



	<div class="col-md-12 p-2">
		<div class="" align="right" style="margin-right: 20px">

			<span class="text-danger"> <small><small><small><small>EMPRESTADOS</small> : <?php echo @$livros_emprestados ?></small></small></small>  </span>

		<span class="text-success"> <small><small><small><small>DISPONÍVEIS</small> : <?php echo @$livros_disponiveis ?></small></small></small>  </span>


				
		</div>
	</div>
	<div class="cabecalho" style="border-bottom: solid 1px #0340a3">
	</div>



	<div class="footer"  align="center">
		<span style="font-size:10px"><?php echo $nome_sistema ?> Telefone: <?php echo $telefone_sistema ?></span> 
	</div>

</body>
</html>