<?php 
$pag = 'devolucoes_atraso';

$data_atual = date('Y-m-d');

?>

<div class="row">
	<a href="index.php?pagina=leitores" type="button" class="btn btn-primary"><span class="fa fa-plus"></span> Novo Empréstimo</a>

	<li class="dropdown head-dpdn2" style="display: inline-block;">
			<a href="#" class="dropdown-toggle btn btn-success" data-toggle="dropdown" aria-expanded="false" id="btn-deletar" style="display:none"><span class="fa fa-check-square"></span> Dar Baixa</a>

			<ul class="dropdown-menu" style="margin-left:0px;">
			<li>
			<div class="notification_desc2">
			<p>Confirmar Baixa? <a href="#" onclick="baixarSel()"><span class="text-danger">Sim</span></a></p>
			</div>
			</li>										
			</ul>
		</li>	

	<a style="position:absolute; right:30px" id="btn-rel" onclick="relatorio()" type="button" class="btn btn-success"><span class="fa fa-file-o"></span> Relatório</a>	

</div>


<div class="bs-example widget-shadow" style="padding:15px" id="listar">

</div>

<input type="hidden" name="ids" id="ids">

<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>



<script type="text/javascript">
	function listarData() {
		var data_inicial = $('#data-inicial').val();
		var data_final = $('#data-final').val();
		var status = $('#status').val();		
		listar(data_inicial, data_final, status);
	}


	function relatorio() {
		var data_inicial = "<?=$data_atual?>";
		var data_final = "<?=$data_atual?>";	
		var status = "data_devolucao";
		window.open("rel/emprestimos_class.php?inicio="+data_inicial+"&final="+data_final+"&status="+status+"&devolvido=Não&emprestimos=Devoluções em Atraso");
	}

	
</script>