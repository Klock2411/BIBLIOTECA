<?php 
$tabela = 'leitores';
require_once("../../../conexao.php");

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$obs = $_POST['obs'];
$endereco = $_POST['endereco'];
$id = $_POST['id'];

//validacao email
if($cpf != ""){
$query = $pdo->query("SELECT * from $tabela where cpf = '$cpf'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'CPF já Cadastrado!';
	exit();
}
}

if($telefone != ""){
//validacao telefone
$query = $pdo->query("SELECT * from $tabela where telefone = '$telefone'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'Telefone já Cadastrado!';
	exit();
}
}

if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, cpf = :cpf, ativo = 'Sim', telefone = :telefone, data_cad = curDate(), endereco = :endereco, obs = :obs ");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, cpf = :cpf, telefone = :telefone, endereco = :endereco, obs = :obs where id = '$id'");
}
$query->bindValue(":nome", "$nome");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":obs", "$obs");
$query->execute();

echo 'Salvo com Sucesso';
 ?>