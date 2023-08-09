<?php 
$tabela = 'emprestimos';
@session_start();
require_once("../../../conexao.php");

$id_leitor = $_POST['id'];
$id_livro = $_POST['id_livro'];
$data_emprestimo = $_POST['data_emprestimo'];
$data_entrega = $_POST['data_entrega'];
$obs_emprestimo = $_POST['obs_emprestimo'];
$id_usuario = $_SESSION['id'];

if($id_livro == ""){
	echo 'Selecione um Livro';
	exit();
}


$query2 = $pdo->query("SELECT * from livros where id = '$id_livro'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$emprestimos = @$res2[0]['emprestimos'];
$nome_livro = @$res2[0]['titulo'];
$total_emprestimo = $emprestimos + 1;

if($api_whatsapp == 'Sim'){

	$query2 = $pdo->query("SELECT * from leitores where id = '$id_leitor'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$telefone = @$res2[0]['telefone'];
	$nome_leitor = @$res2[0]['nome'];

	$query2 = $pdo->query("SELECT * from usuarios where id = '$id_usuario'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_func = @$res2[0]['nome'];

	$data_emprestimoF = implode('/', array_reverse(explode('-', $data_emprestimo)));
	$data_entregaF = implode('/', array_reverse(explode('-', $data_entrega)));

	$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);
	$mensagem = '_Empréstimo de Livro_ %0A';
	$mensagem .= 'Livro: *'.$nome_livro.'* %0A';
	$mensagem .= 'Leitor: *'.$nome_leitor.'* %0A';
	$mensagem .= 'Data Empréstimo: *'.$data_emprestimoF.'* %0A';
	$mensagem .= 'Data Entrega: *'.$data_entregaF.'* %0A';
	$mensagem .= 'Emprestado Por: *'.$nome_func.'* %0A';
	if($obs_emprestimo != ""){
		$mensagem .= 'OBS: _'.$obs_emprestimo.'_ %0A';
	}	

	require("../../api/mensagem.php");

	//agendar mensagem para o dia da entrega
	$mensagem = '_Entrega do Livro Hoje_ %0A';
	$mensagem .= 'Livro: *'.$nome_livro.'* %0A';
	$mensagem .= 'Leitor: *'.$nome_leitor.'* %0A';
	$mensagem .= 'Data Entrega: *'.$data_entregaF.'* %0A';
	
	$data_agd = $data_entrega.' 07:00:00';
	require("../../api/agendar.php");
}


$query = $pdo->prepare("INSERT INTO $tabela SET livro = '$id_livro', leitor = '$id_leitor', data_emprestimo = '$data_emprestimo', data_devolucao = '$data_entrega', obs = :obs, funcionario = '$id_usuario', devolvido = 'Não', hash = '$hash' ");	

$query->bindValue(":obs", "$obs_emprestimo");
$query->execute();


$pdo->query("UPDATE livros SET status = 'Emprestado', emprestimos = '$total_emprestimo' where id = '$id_livro'");	

echo 'Salvo com Sucesso';


 ?>