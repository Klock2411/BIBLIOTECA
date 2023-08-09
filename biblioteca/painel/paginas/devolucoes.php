<?php 
$pag = 'devolucoes';

$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_mes = $ano_atual."-".$mes_atual."-01";
$data_ano = $ano_atual."-01-01";

?>

<div class="row t50-">
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
<div class="row">
	<div class="col-md-8">

		

	<div class="" style="float:left; margin-right:10px"><span><small><i title="Data Inicial" class="fa fa-calendar-o"></i></small></span>
		</div>
		<div class="" style="float:left; margin-right:20px">
			<input onchange="listarData()" type="date" class="form-control " name="data-inicial"  id="data-inicial" value="<?php echo date('Y-m-d') ?>" required>
		</div>

		<div class="" style="float:left; margin-right:10px"><span><small><i title="Data Final" class="fa fa-calendar-o"></i></small></span></div>
		<div class="" style="float:left; margin-right:30px">
			<input onchange="listarData()" type="date" class="form-control " name="data-final"  id="data-final" value="<?php echo date('Y-m-d') ?>" required>
		</div>

		
		
			

	</div>	

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
		var status = 'data_devolucao';	
		listar(data_inicial, data_final, status);
	}


	function relatorio() {
		var data_inicial = $('#data-inicial').val();
		var data_final = $('#data-final').val();		
		var status = 'data_devolucao';
		window.open("rel/emprestimos_class.php?inicio="+data_inicial+"&final="+data_final+"&status="+status+"&devolvido=Sim&emprestimos=Devolvidos");
	}

	
</script>