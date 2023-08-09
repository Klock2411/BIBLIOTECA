<?php 
$pag = 'acessos';
 ?>
 <div class="row">
 	<a onclick="inserir()" type="button" class="btn btn-primary"><span class="fa fa-plus"></span> Acesso</a>

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
 </div>


<div class="bs-example widget-shadow" style="padding:15px" id="listar">

</div>

<input type="hidden" name="ids" id="ids">


<!-- Modal Form -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
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
						<div class="col-md-6">							
								<label>Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Seu Nome" required>							
						</div>

						<div class="col-md-6">							
								<label>Chave</label>
								<input type="text" class="form-control" id="chave" name="chave" placeholder="Seu Email"  required>							
						</div>

						
					</div>


					<div class="row">						
						

						<div class="col-md-12">							
								<label>Grupo</label>
								<select class="form-control sel" name="grupo" id="grupo" style="width:100%">		<option value="0">Sem Grupo</option>						  

									<?php 
									$query = $pdo->query("SELECT * FROM grupos  order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){		
											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

									<?php } ?>

								</select>							
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







<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>


