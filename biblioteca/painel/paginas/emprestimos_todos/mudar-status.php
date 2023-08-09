<?php 
$tabela = 'emprestimos';
require_once("../../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id'];

$id = $_POST['id'];
$acao = @$_POST['acao'];

$query2 = $pdo->query("SELECT * from $tabela where id = '$id'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$id_livro = @$res2[0]['livro'];
$hash = @$res2[0]['hash'];

$pdo->query("UPDATE $tabela SET devolvido = 'Sim', funcionario = '$id_usuario', data_devolucao = curDate() WHERE id = '$id' ");
echo 'Alterado com Sucesso';

$pdo->query("UPDATE livros SET status = 'Disponível' where id = '$id_livro'");

//cancelamento do agendamento de mensagem
if($hash != ""){
	require("../../api/deletar_agd.php");
}
?>