<?php 

$data_atual = date('Y-m-d');
$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_mes = $ano_atual."-".$mes_atual."-01";
$data_ano = $ano_atual."-01-01";

//totalizando livros
$query = $pdo->query("SELECT * from livros");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_livros = @count($res);

//totalizando leitores
$query = $pdo->query("SELECT * from leitores");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_leitores = @count($res);

$query = $pdo->query("SELECT * from livros where status = 'Emprestado'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_emprestados = @count($res);

$query = $pdo->query("SELECT * from emprestimos where data_devolucao = curDate() and devolvido = 'Não'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_hoje = @count($res);

$query = $pdo->query("SELECT * from emprestimos where data_devolucao = curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_entregas_hoje = @count($res);

$query = $pdo->query("SELECT * from emprestimos where data_devolucao < curDate() and devolvido = 'Não'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_atraso = @count($res);

$query = $pdo->query("SELECT * from livros where status = 'Disponível'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_disponiveis = @count($res);


$query = $pdo->query("SELECT * from emprestimos where data_emprestimo >= '$data_mes' and data_emprestimo <= curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_emprestimos_mes = @count($res);

$query = $pdo->query("SELECT * from emprestimos where data_emprestimo >= '$data_mes' and data_emprestimo <= curDate() and devolvido = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_devolvidos_mes = @count($res);


if($total_disponiveis > 0 and $total_livros > 0){
    $porcentagemDisponiveis = ($total_disponiveis / $total_livros) * 100;
}else{
    $porcentagemDisponiveis = 0;
}


if($total_hoje > 0 and $total_entregas_hoje > 0){
    $porcentagemHoje = ($total_hoje / $total_entregas_hoje) * 100;
}else{
    $porcentagemHoje = 0;
}


if($total_emprestimos_mes > 0 and $total_devolvidos_mes > 0){
    $porcentagemMes = ($total_devolvidos_mes / $total_emprestimos_mes) * 100;
}else{
    $porcentagemMes = 0;
}



//GRAFICO DE LINHAS
$emprestimos_grafico = '';
for($i=1; $i <= 12; $i++){
	if($i < 10){
                $mes_atual = '0'.$i;
            }else{
                $mes_atual = $i;
            }

         if($mes_atual == '4' || $mes_atual == '6' || $mes_atual == '9' || $mes_atual == '11'){
            $dia_final_mes = '30';
        }else if($mes_atual == '2'){
            $dia_final_mes = '28';
        }else{
            $dia_final_mes = '31';
        } 
        

        $data_mes_inicio_grafico = $ano_atual."-".$mes_atual."-01";
        $data_mes_final_grafico = $ano_atual."-".$mes_atual."-".$dia_final_mes; 

         //totalizar em cada mes o numero de emprestimos
        $query = $pdo->query("SELECT * from emprestimos where data_emprestimo >= '$data_mes_inicio_grafico' and data_emprestimo <= '$data_mes_final_grafico'");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$emprestimos_grafico_mes = @count($res);

		$emprestimos_grafico = $emprestimos_grafico.$emprestimos_grafico_mes.'*';


}


//GRAFICO DE BARRAS
$emprestimos_grafico_barras = '';
$nome_barras = '';
$query = $pdo->query("SELECT * from livros order by emprestimos desc limit 5");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for($i=0; $i<@count($res); $i++){
	$emp = $res[$i]['emprestimos'];
	$nome = $res[$i]['titulo'];
	$nome = mb_strimwidth($nome, 0, 17, "...");
	if($emp == ""){
		$emp = 0;
	}
	$emprestimos_grafico_barras = $emprestimos_grafico_barras.$emp.'*';
	$nome_barras = $nome_barras.$nome.'*';
}

 ?>

 <input type="hidden" id="emprestimos_mes">
  <input type="hidden" id="emprestimos_mes_barras">
  <input type="hidden" id="nome_barras">
<div class="main-page">
	<div class="col_3">

		<a href="index.php?pagina=livros">
		<div class="col-md-3 widget widget1">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-file icon-rounded"></i>
				<div class="stats">
					<h5><strong><?php echo $total_livros ?></strong></h5>
					<span>Livros</span>
				</div>
			</div>
		</div>
		</a>
		<a href="index.php?pagina=emprestimos">
		<div class="col-md-3 widget widget1">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-file-o user1 icon-rounded"></i>
				<div class="stats">
					<h5><strong><?php echo $total_emprestados ?></strong></h5>
					<span>Emprestados</span>
				</div>
			</div>
		</div>
		</a>
		<a href="index.php?pagina=devolucoes_hoje">
		<div class="col-md-3 widget widget1">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-file icon-rounded" style="background: green"></i>
				<div class="stats">
					<h5><strong><?php echo $total_hoje ?></strong></h5>
					<span>Entregas Hoje</span>
				</div>
			</div>
		</div>
		</a>
		<a href="index.php?pagina=devolucoes_atraso">
		<div class="col-md-3 widget widget1">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-file dollar1 icon-rounded"></i>
				<div class="stats">
					<h5><strong><?php echo $total_atraso ?></strong></h5>
					<span>Entregas Atraso</span>
				</div>
			</div>
		</div>
		</a>
		<a href="index.php?pagina=leitores">
		<div class="col-md-3 widget">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-users icon-rounded"></i>
				<div class="stats">
					<h5><strong><?php echo $total_leitores ?></strong></h5>
					<span>Leitores</span>
				</div>
			</div>
		</div>
		</a>
		<div class="clearfix"> </div>
	</div>
	
	<div class="row-one widgettable">
		<div class="col-md-8 content-top-2 card" style="padding:20px">
			<div class="card-header">
				<h3>Livros Mais Emprestados</h3>
			</div>			
				<canvas id="canvas" style="width: 100%; height:450px;"></canvas>
				
		</div>	
		<div class="col-md-4 stat">
			<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Livros Disponíveis</h5>
					<label><?php echo $total_disponiveis ?></label>
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-1" class="pie-title-center" data-percent="<?php echo $porcentagemDisponiveis ?>"> <span class="pie-value"></span> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Entregas Pendentes Hoje</h5>
					<label><?php echo $total_entregas_hoje ?></label>
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-2" class="pie-title-center" data-percent="<?php echo $porcentagemHoje ?>"> <span class="pie-value"></span> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Empréstimos Entregues Mês</h5>
					<label><?php echo $total_emprestimos_mes ?></label>
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-3" class="pie-title-center" data-percent="<?php echo $porcentagemMes ?>"> <span class="pie-value"></span> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		


		<div class="clearfix"> </div>
	</div>
	
	

	<div class="row-one widgettable">
		<div class="col-md-12 content-top-2 card">
			<div class="agileinfo-cdr">
				<div class="card-header">
					<h3>Empréstimos no Ano</h3>
				</div>
				
				<div id="Linegraph" style="width: 98%; height: 350px">
				</div>
				
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
	

	
</div>




<!-- for index page weekly sales java script -->
<script src="js/SimpleChart.js"></script>


<script>
	//GRAFICO DE LINHAS
	$('#emprestimos_mes').val('<?=$emprestimos_grafico?>');
	var dados = $('#emprestimos_mes').val();
    emprestimos_mes = dados.split('*'); 

	var graphdata1 = {
		linecolor: "#058212",
		title: "Meses",
		values: [
		{ X: "Janeiro", Y: emprestimos_mes[0] },
		{ X: "Fevereiro", Y: emprestimos_mes[1] },
		{ X: "Março", Y: emprestimos_mes[2] },
		{ X: "Abril", Y: emprestimos_mes[3] },
		{ X: "Maio", Y: emprestimos_mes[4] },
		{ X: "Junho", Y: emprestimos_mes[5] },
		{ X: "Julho", Y: emprestimos_mes[6] },
		{ X: "Agosto", Y: emprestimos_mes[7] },
		{ X: "Setembro", Y: emprestimos_mes[8] },
		{ X: "Outubro", Y: emprestimos_mes[9] },
		{ X: "Novembro", Y: emprestimos_mes[10] },
		{ X: "Dezembro", Y: emprestimos_mes[11] },
		
		]
	};
	
	
	
	$(function () {		
		
		$("#Linegraph").SimpleChart({
			ChartType: "Line",
			toolwidth: "50",
			toolheight: "25",
			axiscolor: "#E6E6E6",
			textcolor: "#6E6E6E",
			showlegends: false,
			data: [graphdata1],
			legendsize: "140",
			legendposition: 'bottom',
			xaxislabel: 'Meses',
			title: 'Total de Empréstimos',
			yaxislabel: 'Total'
		});
		
	});

</script>
<!-- //for index page weekly sales java script -->


	<!-- GRAFICO DE BARRAS -->
	<script type="text/javascript">
		$(document).ready(function() {

			$('#emprestimos_mes_barras').val('<?=$emprestimos_grafico_barras?>');
			var dados = $('#emprestimos_mes_barras').val();
		    emprestimos_mes = dados.split('*'); 

		    $('#nome_barras').val('<?=$nome_barras?>');
			var dados2 = $('#nome_barras').val();
		    nomes = dados2.split('*'); 

				var color = Chart.helpers.color;
				var barChartData = {
					labels: [nomes[0], nomes[1], nomes[2], nomes[3], nomes[4]],
					datasets: [{
						label: '',
						backgroundColor: color('blue').alpha(0.5).rgbString(),
						borderColor: 'blue',
						borderWidth: 1,
						data: [
						emprestimos_mes[0],
						emprestimos_mes[1],
						emprestimos_mes[2],
						emprestimos_mes[3],
						emprestimos_mes[4]
						
						]
					}, 
					]

				};

			var ctx = document.getElementById("canvas").getContext("2d");
					window.myBar = new Chart(ctx, {
						type: 'bar',
						data: barChartData,
						options: {
							responsive: true,
							legend: {
								position: '',
							},
							title: {
								display: true,
								text: 'Os 5 Livros Mais Emprestados'
							}
						}
					});

	})
	
	</script>