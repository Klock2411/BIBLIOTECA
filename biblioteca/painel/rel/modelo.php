<?php 
include('../../conexao.php');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));
?>
<!DOCTYPE html>
<html>
<head>

<style>

@import url('https://fonts.cdnfonts.com/css/tw-cen-mt-condensed');
@page { margin: 145px 20px 20px 20px; }
#header { position: fixed; left: 0px; top: -110px; bottom: 100px; right: 0px; height: 35px; text-align: center; padding-bottom: 100px; }
#content {margin-top: 0px;}
#footer { position: fixed; left: 0px; bottom: -50px; right: 0px; height: 80px; }
#footer .page:after {content: counter(page, my-sec-counter);}
body {font-family: 'Tw Cen MT', sans-serif;}

</style>

</head>
<body>
<div id="header" >

	<div style="border-style: solid; font-size: 10px; height: 50px;">
		<table style="width: 100%; border: 0px solid #ccc;">
			<tr>
				<td style="border: 1px; solid #000; width: 7%; text-align: left;">
					<img style="margin-top: 7px; margin-left: 7px;" id="imag" src="<?php echo $url_sistema ?>img/logo.jpg" width="45px">
				</td>
				<td style="width: 33%; text-align: left; font-size: 13px;">
				BIBLIOTECA <br> FREITAS	
				</td>
				<td style="width: 5%; text-align: center; font-size: 13px;">
				
				</td>
				<td style="width: 40%; text-align: right; font-size: 11px;padding-right: 10px;">
						RELATÓRIO DE LIVROS<br> FILTROS <br> DATA <?php mb_strtoupper($data_hoje) ?>
				</td>
			</tr>		
		</table>
	</div>

<br>
		<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 8px; margin-bottom:10px; width: 100%; table-layout: auto;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#CCC">
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
					<td>6</td>				
					<td>7</td>	
					<td>8</td>	
				</tr>
			</thead>
		</table>
</div>

<div id="footer" class="row">
<hr style="margin-bottom: 0;">
	<table style="width:100%;">
		<tr style="width:100%;">
			<td style="width:60%; font-size: 10px; text-align: left;">Nome e telefone do Sistema</td>
			<td style="width:40%; font-size: 10px; text-align: right;"><p class="page">Pág. </p></td>
		</tr>
	</table>
</div>

<div id="content" style="margin-top: 0;">



		<table style="width: 100%; table-layout: auto; font-size:7px; text-transform: uppercase;">
			<thead>
				<tbody>
					<?php for($i=0; $i<200; $i++){ ?>
					<tr>
						<td><b>1</td>
						<td><b>2</td>
						<td><b>3</td>
						<td><b>4</td>
						<td>5</td>
						<td><b>6</td>
						<td>7</td>
						<td><b>8</td>				
					</tr>
				<?php } ?>
				</tbody>
	
			</thead>
		</table>
	


</div>
<hr>
		<table>
			<thead>
				<tbody>
					<tr>
						<td style="font-size: 10px; width:332px; text-align: left;"<b>Total de registros: 0</td>
						<td style="font-size: 10px; width:130px; padding-right: 5px; text-align: right; background-color: #DCDCDC;"<b>Entradas: 0</td>						
						<td style="font-size: 10px; width:130px; padding-right: 5px; text-align: right; background-color: #DCDCDC;"<b>Saídas: 0</td>
						<td style="font-size: 10px; width:130px; padding-right: 5px; text-align: right; background-color: #DCDCDC;"<b>Saldo: 0</td>
					</tr>
				</tbody>
			</thead>
		</table>

</body>

</html>


