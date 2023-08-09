<?php 
$pag = 'livros';
?>
<div class="row t50-">
	<a onclick="inserir()" type="button" class="btn btn-primary"><span class="fa fa-plus"></span> Livro</a>

	<li class="dropdown head-dpdn2" style="display: inline-block;">
			<a href="#" class="dropdown-toggle btn btn-danger" data-toggle="dropdown" aria-expanded="false" id="btn-deletar" style="display:none"><span class="fa fa-trash"></span> DELETAR</a>

			<ul class="dropdown-menu" style="margin-left:0px;">
			<li>
			<div class="notification_desc2">
			<p>Confirmar Exclusão? <a href="#" onclick="deletarSel()"><span class="text-danger">Sim</span></a></p>
			</div>
			</li>										
			</ul>
		</li>	

	<a style="position:absolute; right:30px" id="btn-rel" onclick="relatorio()" type="button" class="btn btn-success"><span class="fa fa-file-o"></span> Relatório</a>	
	

</div>

<div class="row">
	<div class="col-md-3 col-sm-6 b5">
		<select onchange="buscar()" class="form-control sel5" id="categoria_busca" style="width:100%">				<option value="">Selecionar Categoria</option>				  

			<?php 
			$query = $pdo->query("SELECT * FROM categorias  order by nome asc");
			$res = $query->fetchAll(PDO::FETCH_ASSOC);
			for($i=0; $i < @count($res); $i++){		
				?>	
				<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

			<?php } ?>

		</select>	
	</div>

	<div class="col-md-3 col-sm-6 b5">
		<select onchange="buscar()" class="form-control sel5" id="editora_busca" style="width:100%">				<option value="">Selecionar Editora</option>				  

			<?php 
			$query = $pdo->query("SELECT * FROM editoras  order by nome asc");
			$res = $query->fetchAll(PDO::FETCH_ASSOC);
			for($i=0; $i < @count($res); $i++){		
				?>	
				<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

			<?php } ?>

		</select>	
	</div>


	<div class="col-md-3 col-sm-6 b5">
		<select onchange="buscar()" class="form-control sel5" id="local_busca" style="width:100%">				<option value="">Selecionar Local</option>				  

			<?php 
			$query = $pdo->query("SELECT * FROM locais  order by nome asc");
			$res = $query->fetchAll(PDO::FETCH_ASSOC);
			for($i=0; $i < @count($res); $i++){		
				?>	
				<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

			<?php } ?>

		</select>	
	</div>


	<div class="col-md-3 col-sm-6 b5">
		<select onchange="buscar()" class="form-control sel5" id="status_busca" style="width:100%">				<option value="">Selecionar Status</option>				  
		<option value="Disponível">Disponíveis</option>	
		<option value="Emprestado">Emprestados</option>	
		</select>	
	</div>
</div>


<div class="bs-example widget-shadow" style="padding:15px" id="listar">

</div>

<input type="hidden" name="ids" id="ids">


<!-- Modal Form -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form">
				<div class="modal-body">


					<div class="row">

						<div class="col-md-2">							
							<label>Código</label>
							<input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código do Livro" required>							
						</div>

						<div class="col-md-4">							
							<label>Título</label>
							<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título do Livro" required>							
						</div>					

						

						<div class="col-md-3">							
							<label>Subtítulo</label>
							<input type="text" class="form-control" id="subtitulo" name="subtitulo" placeholder="Subtitulo do Livro" >							
						</div>

						<div class="col-md-3">							
							<label>Autor</label>
							<input type="text" class="form-control" id="autor" name="autor" placeholder="Autor do Livro" >							
						</div>					

						
					</div>



					<div class="row">

						<div class="col-md-2">							
							<label>Ano</label>
							<input type="number" class="form-control" id="ano" name="ano"  >							
						</div>

						<div class="col-md-4">							
							<label>Editora</label>
							<select class="form-control sel4" name="editora" id="editora" style="width:100%">					<option value="0">Selecionar Editora</option>			  

								<?php 
								$query = $pdo->query("SELECT * FROM editoras  order by nome asc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								for($i=0; $i < @count($res); $i++){		
									?>	
									<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

								<?php } ?>

							</select>							
						</div>		


						<div class="col-md-3">							
							<label>Categoria</label>
							<select class="form-control sel2" name="categoria" id="categoria" style="width:100%">				<option value="0">Selecionar Categoria</option>					  

								<?php 
								$query = $pdo->query("SELECT * FROM categorias  order by nome asc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								for($i=0; $i < @count($res); $i++){		
									?>	
									<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

								<?php } ?>

							</select>							
						</div>	


						<div class="col-md-3">							
							<label>Edição</label>
							<input type="text" class="form-control" id="edicao" name="edicao"  >							
						</div>


						
					</div>



					<div class="row">
						

						<div class="col-md-4">							
							<label>Local do Livro</label>
							<select class="form-control sel3" name="local" id="local" style="width:100%">					<option value="0">Selecionar Local</option>			  

								<?php 
								$query = $pdo->query("SELECT * FROM locais  order by nome asc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								for($i=0; $i < @count($res); $i++){		
									?>	
									<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

								<?php } ?>

							</select>							
						</div>		


						<div class="col-md-8">							
							<label>Observações</label>
							<input maxlength="255" type="text" class="form-control" id="obs" name="obs" placeholder="Observações" >							
						</div>

						
					</div>

					
					<div class="row">
						<div class="col-md-7">							
							<label>Foto</label>
							<input type="file" class="form-control" id="foto" name="foto" onchange="carregarImg()">							
						</div>

						<div class="col-md-5">								
							<img src=""  width="100px" id="target">								
							
						</div>

						
					</div>
					


					<input type="hidden" class="form-control" id="id" name="id">					

					<br>
					<small><div id="mensagem" align="center"></div></small>
				</div>
				<div class="modal-footer">       
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>





<!-- Modal Dados -->
<div class="modal fade" id="modalDados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_dados"></span></h4>
				<button id="btn-fechar-dados" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">
				<div class="row" style="margin-top: 0px">
					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Código: </b></span><span id="codigo_dados"></span>
					</div>

					
					<div class="col-md-8" style="margin-bottom: 5px">
						<span><b>Subtítulo: </b></span><span id="subtitulo_dados"></span>
					</div>
					

					
					

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Autor: </b></span><span id="autor_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Ano: </b></span><span id="ano_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Editora: </b></span><span id="editora_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Edição: </b></span><span id="edicao_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Categoria: </b></span><span id="categoria_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Local: </b></span><span id="local_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Status: </b></span><span id="status_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Cadastrado: </b></span><span id="data_dados"></span>
					</div>

					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>Obs: </b></span><span id="obs_dados"></span>
					</div>

					<div class="col-md-12" style="margin-bottom: 5px">
						<div align="center"><img src="" id="foto_dados" width="200px"></div>
					</div>

					
				</div>
			</div>

		</div>
	</div>
</div>



<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>



<script type="text/javascript">
	function carregarImg() {
		var target = document.getElementById('target');
		var file = document.querySelector("#foto").files[0];

		var reader = new FileReader();

		reader.onloadend = function () {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>


<script type="text/javascript">
	function buscar() {
		var cat = $('#categoria_busca').val();
		var editora = $('#editora_busca').val();
		var local = $('#local_busca').val();
		var status = $('#status_busca').val();
		listar(cat, editora, local, status);
	}

	function relatorio() {
		var cat = $('#categoria_busca').val();
		var editora = $('#editora_busca').val();
		var local = $('#local_busca').val();
		var status = $('#status_busca').val();
		window.open("rel/livros_class.php?cat="+cat+"&editora="+editora+"&local="+local+"&status="+status);
	}
</script>