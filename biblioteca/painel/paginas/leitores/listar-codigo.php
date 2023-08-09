<?php 
$tabela = 'livros';
require_once("../../../conexao.php");

$codigo = $_POST['codigo'];

$query = $pdo->query("SELECT * from $tabela where codigo = '$codigo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	$id = $res[0]['id'];
	$codigo = $res[0]['codigo'];
	$titulo = $res[0]['titulo'];
	$subtitulo = $res[0]['subtitulo'];
	$autor = $res[0]['autor'];
	$ano = $res[0]['ano'];
	$editora = $res[0]['editora'];
	$edicao = $res[0]['edicao'];
	$categoria = $res[0]['categoria'];
	$foto = $res[0]['foto'];
	$local = $res[0]['local'];
	$status = $res[0]['status'];
	$obs = $res[0]['obs'];

	$query2 = $pdo->query("SELECT * from categorias where id = '$categoria'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_categoria = @$res2[0]['nome'];

	$query2 = $pdo->query("SELECT * from locais where id = '$local'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_local = @$res2[0]['nome'];

	$query2 = $pdo->query("SELECT * from editoras where id = '$editora'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_editora = @$res2[0]['nome'];

	if($status != "Disponível"){
		echo '-1';
		exit();
	}

	echo $id.'**'.$codigo.'**'.$titulo.'**'.$subtitulo.'**'.$autor.'**'.$ano.'**'.$nome_editora.'**'.$edicao.'**'.$nome_categoria.'**'.$nome_local.'**'.$obs;
}else{
	echo '0';
}	
 ?>
