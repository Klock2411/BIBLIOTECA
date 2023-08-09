<?php 
$tabela = 'emprestimos';
require_once("../../../conexao.php");
$data_atual = date('Y-m-d');
$query = $pdo->query("SELECT * from $tabela where data_devolucao = curDate() and devolvido = 'Não' order by data_devolucao asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th class="esc">Livro</th>	
	<th class="">Leitor</th>	
	<th class="esc">Data Empréstimo</th>
	<th class="esc">Data Entrega</th>
	<th class="esc">Funcionário</th>			
	<th class="esc">Baixar</th>		
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

	


echo <<<HTML
<tr class="{$classe_ativo}">
<td>
<input type="checkbox" class="form-check-input" id="seletor-{$id}" onchange="selecionar('{$id}')">
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
<td class="esc ">{$nome_leitor}</td>
<td class="esc">{$data_emprestimoF}</td>
<td class="esc">{$data_devolucaoF}</td>
<td class="esc">{$nome_func}</td>
<td>
	

<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-check-square verde"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Entrega? <a href="#" onclick="ativar('{$id}')"><span class="text-danger">Sim</span></a></p>
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
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
<div align="right" style="margin-top: 10px" class="verde">Devoluções Pendentes Hoje: {$linhas}</div>
HTML;

}else{
	echo '<small>Não possui nenhum registro cadastrado!</small>';
}
?>



<script type="text/javascript">
	$(document).ready( function () {	

    $('#tabela').DataTable({    	
        "ordering": false,
		"stateSave": true
    });



    $('.sel4').select2({
    	dropdownParent: $('#modalForm')
    });

     $('.sel2').select2({
    	dropdownParent: $('#modalForm')
    });

      $('.sel3').select2({
    	dropdownParent: $('#modalForm')
    });

      $('.sel5').select2({
    	
    });



} );
</script>

<script type="text/javascript">
		

	function limparCampos(){		
    	$('#ids').val('');
    	$('#btn-deletar').hide();
    	
	}

	function selecionar(id){
		var ids = $('#ids').val();	

		if($('#seletor-'+id).is(":checked") == true){
			var novo_id = ids + id + '-';
			$('#ids').val(novo_id);
		}else{
			var retirar = ids.replace(id + '-', '');
			$('#ids').val(retirar);
		}

		var ids_final = $('#ids').val();	

		if(ids_final != ""){
			$('#btn-deletar').show();
		}else{
			$('#btn-deletar').hide();
		}
		
	}



	function baixarSel(){
		var ids = $('#ids').val();
		var id = ids.split('-');

		for(i=0; i < id.length - 1; i++){
			ativar(id[i]);

		}

		limparCampos();
	}
</script>