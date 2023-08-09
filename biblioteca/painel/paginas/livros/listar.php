<?php 
$tabela = 'livros';
require_once("../../../conexao.php");

$categoria = @$_POST['p1'];
$editora = @$_POST['p2'];
$local = @$_POST['p3'];
$status = @$_POST['p4'];

$query = $pdo->query("SELECT * from $tabela where categoria LIKE '%$categoria%' and editora LIKE '%$editora%' and local LIKE '%$local%' and status LIKE '%$status%' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th class="esc">Código</th>	
	<th class="">Título</th>	
	<th class="esc">Categoria</th>
	<th class="esc">Edição</th>
	<th class="esc">Local</th>	
	<th class="esc">Foto</th>		
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;


for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$codigo = $res[$i]['codigo'];
	$titulo = $res[$i]['titulo'];
	$subtitulo = $res[$i]['subtitulo'];
	$autor = $res[$i]['autor'];
	$ano = $res[$i]['ano'];
	$editora = $res[$i]['editora'];
	$edicao = $res[$i]['edicao'];
	$categoria = $res[$i]['categoria'];
	$foto = $res[$i]['foto'];
	$local = $res[$i]['local'];
	$status = $res[$i]['status'];
	$obs = $res[$i]['obs'];
	$data_cad = $res[$i]['data_cad'];

	$dataF = implode('/', array_reverse(explode('-', $data_cad)));

	if($status == 'Disponível'){	
	$classe_ativo = 'verde';
	}else{			
		$classe_ativo = 'text-danger';
	}

	if($obs == ""){
		$disp = 'none';
	}else{
		$disp = 'inline-block';
	}

	
	$query2 = $pdo->query("SELECT * from categorias where id = '$categoria'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_categoria = @$res2[0]['nome'];

	$query2 = $pdo->query("SELECT * from locais where id = '$local'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_local = @$res2[0]['nome'];

	$query2 = $pdo->query("SELECT * from editoras where id = '$editora'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_editora = @$res2[0]['nome'];


echo <<<HTML
<tr>
<td>
<input type="checkbox" class="form-check-input" id="seletor-{$id}" onchange="selecionar('{$id}')">
{$codigo}

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
<td class="esc {$classe_ativo}">{$titulo}</td>
<td class="esc">{$nome_categoria}</td>
<td class="esc">{$edicao}</td>
<td class="esc">{$nome_local}</td>
<td class="esc"><img src="images/livros/{$foto}" width="25px"></td>

<td>
	<big><a href="#" onclick="editar('{$id}','{$codigo}','{$titulo}','{$subtitulo}','{$autor}','{$ano}','{$editora}','{$edicao}','{$categoria}','{$foto}','{$local}','{$obs}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

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

<big><a href="#" onclick="mostrar('{$codigo}','{$titulo}','{$subtitulo}','{$autor}','{$ano}','{$nome_editora}','{$edicao}','{$nome_categoria}','{$foto}','{$nome_local}','{$status}','{$obs}','{$dataF}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>



</td>
</tr>
HTML;

}


echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
<div align="right" style="margin-top: 10px" class="verde">Total de Livros: {$linhas}</div>
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
	function editar(id, codigo, titulo, subtitulo, autor, ano, editora, edicao, categoria, foto, local, obs){
		
		$('#mensagem').text('');
    	$('#titulo_inserir').text('Editar Registro');

    	$('#id').val(id);
    	$('#codigo').val(codigo);
    	$('#titulo').val(titulo);
    	$('#subtitulo').val(subtitulo);
    	$('#autor').val(autor);
    	$('#ano').val(ano);
    	$('#editora').val(editora).change();
    	$('#edicao').val(edicao);
    	$('#categoria').val(categoria).change();
    	$('#local').val(local).change();
    	$('#obs').val(obs);

    	$('#target').attr("src", "images/livros/" + foto);

    	$('#modalForm').modal('show');
	}


	function mostrar(codigo, titulo, subtitulo, autor, ano, editora, edicao, categoria, foto, local, status, obs, data){
		    	
    	$('#codigo_dados').text(codigo);
    	$('#titulo_dados').text(titulo);
    	$('#subtitulo_dados').text(subtitulo);
    	$('#autor_dados').text(autor);
    	$('#ano_dados').text(ano);
    	$('#editora_dados').text(editora);
    	$('#edicao_dados').text(edicao);
    	$('#categoria_dados').text(categoria);
    	$('#local_dados').text(local);
    	$('#status_dados').text(status);
    	$('#obs_dados').text(obs);
    	$('#data_dados').text(data);
    	
    	$('#foto_dados').attr("src", "images/livros/" + foto);

    	$('#modalDados').modal('show');
	}

	function limparCampos(){
		$('#id').val('');
    	$('#codigo').val('');
    	$('#titulo').val('');
    	$('#subtitulo').val('');
    	$('#autor').val('');	
    	$('#ano').val('');	
    	$('#edicao').val('');	
    	$('#obs').val('');	
    	$('#ids').val('');
    	$('#btn-deletar').hide();

    	$('#target').attr("src", "images/livros/sem-foto.jpg");
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
</script>