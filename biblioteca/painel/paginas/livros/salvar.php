<?php 
$tabela = 'livros';
require_once("../../../conexao.php");

$codigo = $_POST['codigo'];
$titulo = $_POST['titulo'];
$subtitulo = $_POST['subtitulo'];
$autor = $_POST['autor'];
$ano = $_POST['ano'];
$editora = $_POST['editora'];
$edicao = $_POST['edicao'];
$categoria = $_POST['categoria'];
$local = $_POST['local'];
$obs = $_POST['obs'];
$id = $_POST['id'];

//validacao email

$query = $pdo->query("SELECT * from $tabela where codigo = '$codigo'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'Livro já Cadastrado, código repetido!';
	exit();
}



//validar troca da foto
$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['foto'];
}else{
	$foto = 'sem-foto.jpg';
}



//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../images/livros/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.jpg"){
				@unlink('../../images/livros/'.$foto);
			}

			$foto = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}




if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET codigo = :codigo, titulo = :titulo, subtitulo = :subtitulo, autor = :autor,  ano = '$ano', editora = '$editora', edicao = :edicao, categoria = '$categoria', foto = '$foto', local = '$local', status = 'Disponível', obs = :obs, data_cad = curDate()");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET codigo = :codigo, titulo = :titulo, subtitulo = :subtitulo, autor = :autor,  ano = '$ano', editora = '$editora', edicao = :edicao, categoria = '$categoria', foto = '$foto', local = '$local', obs = :obs where id = '$id'");
}
$query->bindValue(":codigo", "$codigo");
$query->bindValue(":titulo", "$titulo");
$query->bindValue(":subtitulo", "$subtitulo");
$query->bindValue(":autor", "$autor");
$query->bindValue(":edicao", "$edicao");
$query->bindValue(":obs", "$obs");
$query->execute();

echo 'Salvo com Sucesso';

$query = $pdo->query("SELECT * from categorias where id = '$categoria'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_categoria = $res[0]['nome'];

if($api_whatsapp == 'Sim' and $id == ""){
	$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_sistema);
	$mensagem = '_Foi Cadastrado um novo Livro_ %0A';
	$mensagem .= 'Nome: *'.$titulo.'* %0A';
	$mensagem .= 'Autor: *'.$autor.'* %0A';
	$mensagem .= 'Categoria: *'.$nome_categoria.'* %0A%0A';	
	require("../../api/mensagem.php");
}
 ?>