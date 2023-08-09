<?php 
$tabela = 'emprestimos';
require_once("../../../conexao.php");

$id = $_POST['id'];
$data_atual = date('Y-m-d');

$query = $pdo->query("SELECT * from $tabela where leitor = '$id' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-hover" id="tabela2">
	<thead> 
	<tr> 
	<th class="esc">Livro</th>			
	<th class="esc">Data Empréstimo</th>
	<th class="esc">Data Entrega</th>
	<th class="esc">Emprestado Por</th>
			
	<th>Baixar</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;


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

	if($data_devolucao < $data_atual){	
	$classe_ativo = 'text-danger';
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

	

	if($devolvido != "Sim"){	
	$classe_ativo3 = 'text-danger';
	$ocultar_botao = '';
	}else{			
		$classe_ativo3 = 'primary';
		$ocultar_botao = 'ocultar';
	}


echo <<<HTML
<tr class="{$classe_ativo}">
<td>
{$nome_livro}
	<li class="dropdown head-dpdn2" style="display: {$disp};">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-bell-o text-danger"></i></big></a>

		<ul class="dropdown-menu">
		<li>
		<div class="notification_desc2">
		<p style="color:#b53b12">{$obs}</p>
		</div>
		</li>										
		</ul>
</li>

</td>

<td class="esc">{$data_emprestimoF}</td>
<td class="esc">{$data_devolucaoF}</td>
<td class="esc">{$nome_func}</td>


<td>
	

<li class="dropdown head-dpdn2 " style="display: inline-block;">
		<a class="{$ocultar_botao}" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-check-square verde"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Entrega? <a href="#" onclick="baixar('{$id}', '{$leitor}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
</li>


</td>
</tr>
HTML;

}


echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir2"></div></small>
</table>
<div align="right" style="margin-top: 10px" class="verde">Total de Empréstimos: {$linhas}</div>
HTML;

}else{
	echo '<small>Não possui nenhum registro cadastrado!</small>';
}
?>



<script type="text/javascript">
	$(document).ready( function () {	

    $('#tabela2').DataTable({    	
        "ordering": false,
		"stateSave": true
    });


} );

	function baixar(id, id_leitor){	
    $.ajax({
        url: 'paginas/emprestimos/mudar-status.php',
        method: 'POST',
        data: {id, id_leitor},
        dataType: "html",

        success:function(mensagem){
            if (mensagem.trim() == "Alterado com Sucesso") {
            	listarEmprestimos(id_leitor);
                listar();
            } else {
                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }
        }
    });
}
</script>

