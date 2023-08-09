<?php 
require_once("../../../conexao.php");
$data_emprestimo = $_POST['data_emprestimo'];
$data_entrega = date('Y-m-d', strtotime("+$dias_entrega days",strtotime($data_emprestimo)));
echo $data_entrega;
?>