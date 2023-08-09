<?php 
$tabela = 'acessos';
require_once("../../../conexao.php");

$nome = $_POST['nome'];
$chave = $_POST['chave'];
$grupo = $_POST['grupo'];
$id = $_POST['id'];

//validacao email
$query = $pdo->query("SELECT * from $tabela where chave = '$chave'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'Chave já cadastrada!';
	exit();
}


if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, chave = :chave, grupo = '$grupo'");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, chave = :chave, grupo = '$grupo' where id = '$id'");
}
$query->bindValue(":nome", "$nome");
$query->bindValue(":chave", "$chave");
$query->execute();

echo 'Salvo com Sucesso';


 ?>