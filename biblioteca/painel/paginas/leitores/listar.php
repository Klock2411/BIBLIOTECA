<?php 
$tabela = 'leitores';
require_once("../../../conexao.php");

$query = $pdo->query("SELECT * from $tabela order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Nome</th>	
	<th class="esc">Telefone</th>	
	<th class="esc">CPF</th>	
	<th class="esc">Data Cadastro</th>	
		
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;


for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];
	$telefone = $res[$i]['telefone'];
	$cpf = $res[$i]['cpf'];
	$obs = $res[$i]['obs'];
	$endereco = $res[$i]['endereco'];
	$ativo = $res[$i]['ativo'];
	$data = $res[$i]['data_cad'];

	$dataF = implode('/', array_reverse(explode('-', $data)));

	if($ativo == 'Sim'){
	$icone = 'fa-check-square';
	$titulo_link = 'Desativar Usuário';
	$acao = 'Não';
	$classe_ativo = '';
	}else{
		$icone = 'fa-square-o';
		$titulo_link = 'Ativar Usuário';
		$acao = 'Sim';
		$classe_ativo = '#c4c4c4';
	}

	if($obs == ""){
		$disp = 'none';
	}else{
		$disp = 'inline-block';
	}


	$query2 = $pdo->query("SELECT * from emprestimos where leitor = '$id' and data_devolucao < curDate() and devolvido = 'Não'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$total_livros = @count($res2);

	if($total_livros > 0){	
	$classe_ativo2 = 'text-danger';
	}else{			
		$classe_ativo2 = 'verde';
	}



	$query2 = $pdo->query("SELECT * from emprestimos where leitor = '$id'  and devolvido = 'Não'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$total_livros2 = @count($res2);

	if($total_livros2 > 0){	
	$classe_ativo3 = 'text-danger';
	}else{			
		$classe_ativo3 = 'primary';
	}


echo <<<HTML
<tr style="color:{$classe_ativo}">
<td>
<input type="checkbox" class="form-check-input" id="seletor-{$id}" onchange="selecionar('{$id}')">
{$nome}

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
<td class="esc">{$telefone}</td>
<td class="esc">{$cpf}</td>
<td class="esc">{$dataF}</td>

<td>
	<big><a href="#" onclick="editar('{$id}','{$nome}','{$cpf}','{$telefone}','{$endereco}','{$obs}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

	<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
</li>

<big><a href="#" onclick="mostrar('{$nome}','{$cpf}','{$telefone}','{$endereco}','{$ativo}','{$dataF}', '{$obs}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>


<big><a href="#" onclick="ativar('{$id}', '{$acao}')" title="{$titulo_link}"><i class="fa {$icone} text-success"></i></a></big>


<big><a href="#" onclick="emprestimo('{$id}', '{$nome}')" title="Emprestar Livro"><i class="fa fa-hand-o-right {$classe_ativo2}"></i></a></big>

<big><a href="#" onclick="emprestimos('{$id}', '{$nome}')" title="Empréstimos do Leitor"><i class="fa fa-list {$classe_ativo3}"></i></a></big>

</td>
</tr>
HTML;

}


echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
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



    $('.sel').select2({
    	dropdownParent: $('#modalForm')
    });

    $('.sel4').select2({
    	dropdownParent: $('#modalEmprestimo')
    });

} );
</script>

<script type="text/javascript">
	function editar(id, nome, cpf, telefone, endereco, obs){
		$('#mensagem').text('');
    	$('#titulo_inserir').text('Editar Registro');

    	$('#id').val(id);
    	$('#nome').val(nome);
    	$('#cpf').val(cpf);
    	$('#telefone').val(telefone);
    	$('#endereco').val(endereco);
    	$('#obs').val(obs);

    	$('#modalForm').modal('show');
	}


	function mostrar(nome, cpf, telefone, endereco, ativo, data, obs){
		    	
    	$('#titulo_dados').text(nome);
    	$('#cpf_dados').text(cpf);
    	$('#telefone_dados').text(telefone);
    	$('#endereco_dados').text(endereco);
    	$('#ativo_dados').text(ativo);
    	$('#data_dados').text(data);
    	$('#obs_dados').text(obs);
    	
    	

    	$('#modalDados').modal('show');
	}

	function limparCampos(){
		$('#id').val('');
    	$('#nome').val('');
    	$('#cpf').val('');
    	$('#telefone').val('');
    	$('#endereco').val('');	
    	$('#obs').val('');	
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



	function deletarSel(){
		var ids = $('#ids').val();
		var id = ids.split('-');

		for(i=0; i < id.length - 1; i++){
			excluir(id[i]);

		}

		limparCampos();
	}

	function emprestimo(id, nome){	
		$('#myTab a[href="#home"]').tab('show');			    	
    	$('#titulo_emprestimo').text("Retirar Livro: " + nome);
    	$('#id_leitor').val(id);
    	
    	

    	$('#modalEmprestimo').modal('show');
	}


	function emprestimos(id, nome){						    	
    	$('#titulo_emprestimos').text("Emprestimos do: " + nome);
    	listarEmprestimos(id);   	   	

    	$('#modalEmprestimos').modal('show');
	}
</script>