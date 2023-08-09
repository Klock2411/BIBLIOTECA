<?php 
$pag = 'leitores';
$data_atual = date('Y-m-d');
$data_entrega = date('Y-m-d', strtotime("+$dias_entrega days",strtotime($data_atual)));
 ?>
 <div class="row">
 	<a onclick="inserir()" type="button" class="btn btn-primary"><span class="fa fa-plus"></span> Leitor</a>

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
						<div class="col-md-4">							
								<label>Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>							
						</div>

						<div class="col-md-4">							
								<label>CPF</label>
								<input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF">							
						</div>

							<div class="col-md-4">							
								<label>Telefone</label>
								<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required>							
						</div>

						
					</div>

				

					<div class="row">

						<div class="col-md-12">							
								<label>Endereço</label>
								<input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço" >							
						</div>
					</div>

					
					<div class="row">

						<div class="col-md-12">							
								<label>Observações</label>
								<input maxlength="255" type="text" class="form-control" id="obs" name="obs" placeholder="Observações" >							
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
						<span><b>Telefone: </b></span><span id="telefone_dados"></span>
					</div>

					
					<div class="col-md-8" style="margin-bottom: 5px">
						<span><b>CPF: </b></span><span id="cpf_dados"></span>
					</div>
					

					
					

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Ativo: </b></span><span id="ativo_dados"></span>
					</div>

					<div class="col-md-6" style="margin-bottom: 5px">
						<span><b>Data Cadastro: </b></span><span id="data_dados"></span>
					</div>

					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>Endereço: </b></span><span id="endereco_dados"></span>
					</div>

					<div class="col-md-12" style="margin-bottom: 5px">
						<span><b>OBS: </b></span><span id="obs_dados"></span>
					</div>

					
				</div>
			</div>
					
		</div>
	</div>
</div>






<!-- Modal Form -->
<div class="modal fade" id="modalEmprestimo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_emprestimo"></span></h4>
				<button id="btn-fechar-emprestimo" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-emprestimo">
			<div class="modal-body">
				

					<ul class="nav nav-tabs" id="myTab" role="tablist">
					  <li class="nav-item">
					    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Livro</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Data</a>
					  </li>
					
					</ul>
					<div class="tab-content" id="myTabContent">
					  <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab" >

					  	<div class="row">					  		
						  		<div class="col-md-4">
						  			<div style="display:inline-flex;">
							  			<input class="form-control" type="text" name="codigo_livro" id="codigo_livro" style="margin-right: 5px" placeholder="Código do Livro">
							  			<button onclick="buscarCodigo()" type="button" class="btn btn-secondary btn-primary"><i class="fa fa-search"></i></button>	
						  			</div>	
					  		</div>

					  		<div class="col-md-8">
					  			<select class="form-control sel4" name="livro" id="livro" style="width:100%" onchange="buscarCodigoSelect()">					<option value="0">Selecionar Livro</option>			  

								<?php 
								$query = $pdo->query("SELECT * FROM livros order by titulo asc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								for($i=0; $i < @count($res); $i++){	
								$editora = $res[$i]['editora'];
								$query2 = $pdo->query("SELECT * from editoras where id = '$editora'");
								$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
								$nome_editora = @$res2[0]['nome'];	
									?>	
									<option value="<?php echo $res[$i]['codigo'] ?>"><?php echo $res[$i]['titulo'] ?> - <?php echo $nome_editora ?></option>

								<?php } ?>

							</select>		
					  		</div>
					  	</div>

					  	<div class="row">
					  		<div class="col-md-6">
					  			<input class="form-control" type="text" id="subtitulo" readonly="true" placeholder="Subtítulo do Livro">
					  		</div>
					  		<div class="col-md-4">
					  			<input class="form-control" type="text" id="autor" readonly="true" placeholder="Autor do Livro">
					  		</div>
					  		<div class="col-md-2">
					  			<input class="form-control" type="text" id="ano" readonly="true" placeholder="Ano do Livro">
					  		</div>
					  	</div>

					  	<div class="row">
					  		<div class="col-md-4">
					  			<input class="form-control" type="text" id="editora" readonly="true" placeholder="Editora do Livro">
					  		</div>
					  		<div class="col-md-4">
					  			<input class="form-control" type="text" id="edicao" readonly="true" placeholder="Edição do Livro">
					  		</div>
					  		<div class="col-md-4">
					  			<input class="form-control" type="text" id="categoria" readonly="true" placeholder="Categoria do Livro">
					  		</div>
					  	</div>

					  	<div class="row">
					  		<div class="col-md-4">
					  			<input class="form-control" type="text" id="local" readonly="true" placeholder="Local do Livro">
					  		</div>
					  		<div class="col-md-8">
					  			<input class="form-control" type="text" id="obs2" readonly="true" placeholder="OBS do Livro">
					  		</div>
					  		
					  	</div>
					  

					  	<hr>
					  	<div align="right">
					  		<button onclick="segundaAba()" type="button" class="btn btn-primary">Próximo</button>
					  	</div>
					  </div>
					  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					  	
					  	<div class="row">
					  		<div class="col-md-4">
					  			<label>Data Empréstimo</label>
					  			<input class="form-control" type="date" id="data_emprestimo" name="data_emprestimo" value="<?php echo date('Y-m-d') ?>" onchange="mudarData()">
					  		</div>
					  		<div class="col-md-4">
					  			<label>Data Entrega</label>
					  			<input class="form-control" type="date" id="data_entrega" name="data_entrega" value="<?php echo $data_entrega ?>">
					  		</div>
					  		
					  	</div>


					  	<div class="row">
					  		<div class="col-md-12">
					  			<label>Observações</label>
					  			<textarea class="form-control" id="obs_emprestimo" name="obs_emprestimo" maxlength="255"></textarea>
					  		</div>
					  	</div>

					  	<hr>

					  	<div align="right">
					  		<button id="btn_emp" type="submit" class="btn btn-primary">Salvar</button>
					  	</div>
					  </div>
					  
					</div>					


					<input type="hidden" class="form-control" id="id_leitor" name="id">
					<input type="hidden" class="form-control" id="id_livro" name="id_livro">					

				<br>
				
			</div>

			<div class="modal-footer">       
				<small><div align="center" id="mensagem_emprestimo"></div></small>
			</div>
			
			</form>
		</div>
	</div>
</div>






<!-- Modal Lista emprestimos -->
<div class="modal fade" id="modalEmprestimos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_emprestimos"></span></h4>
				<button id="btn-fechar-emprestimos" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">
				<div id="listar_emprestimos"></div>				
			</div>
					
		</div>
	</div>
</div>



<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>

<script type="text/javascript">
	function segundaAba(){
		var id_livro = $('#id_livro').val();
		if(id_livro != ""){
			$('#myTab a[href="#profile"]').tab('show');
		}else{
			alert("Selecione um Livro!");
			$('#livro').val("0").change();
		}
		
	}

	function buscarCodigo(){
		var codigo = $('#codigo_livro').val();
		$('#livro').val(codigo).change();
	}

	function buscarCodigoSelect(){
		$('#codigo_livro').val("");
		var codigo = $('#livro').val();
		if(codigo != "0"){
			listarCodigo(codigo);
		}else{
			limparCamposEmp();
		}
		
	}

	function listarCodigo(codigo){
		$.ajax({
        url: 'paginas/' + pag + "/listar-codigo.php",
        method: 'POST',
        data: {codigo},
        dataType: "html",

        success:function(result){
            var msg = result.split("**");

            if(msg[0] == "0"){
            	alert("Código do Livro Inválido");
            	limparCamposEmp();
            	return;
            }

            if(msg[0] == "-1"){
            	alert("Este Livro está emprestado");
            	limparCamposEmp();
            	return;
            }
            
            //preencher os dados
            $('#codigo_livro').val(msg[1]);
            $('#id_livro').val(msg[0]);            
            $('#subtitulo').val(msg[3]);
            $('#autor').val(msg[4]);
            $('#ano').val(msg[5]);
            $('#editora').val(msg[6]);
            $('#edicao').val(msg[7]);
            $('#categoria').val(msg[8]);
            $('#local').val(msg[9]);
            $('#obs2').val(msg[10]);
            $('#mensagem_emprestimo').text('');
        }
    });
	}

	function limparCamposEmp(){
			$('#subtitulo').val("");
            $('#autor').val("");
            $('#ano').val("");
            $('#editora').val("");
            $('#edicao').val("");
            $('#categoria').val("");
            $('#local').val("");
            $('#obs2').val("");
            $('#id_livro').val("");
            $('#livro').val("0").change();
	}




$("#form-emprestimo").submit(function () {
	$('#mensagem_emprestimo').text('Salvando !!!');
	$('#btn_emp').hide();
	event.preventDefault();
	
		var id_livro = $('#id_livro').val();
		if(id_livro == ""){
			alert('Selecione um Livro')
			$('#myTab a[href="#home"]').tab('show');
			return;
			}

    
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/emprestimo.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem_emprestimo').text('');
            $('#mensagem_emprestimo').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {

            	$('#btn_emp').show();
                $('#btn-fechar-emprestimo').click();
                alert('Empréstimo Feito!'); 
                listar();
                limparCamposEmp();
                


            } else {

                $('#mensagem_emprestimo').addClass('text-danger')
                $('#mensagem_emprestimo').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});


function mudarData(){
	var data_emprestimo = $('#data_emprestimo').val();
	$.ajax({
        url: 'paginas/' + pag + "/dias_entrega.php",
        method: 'POST',
        data: {data_emprestimo},
        dataType: "html",

        success:function(result){ 
            $('#data_entrega').val(result);
        }
    });
}


function listarEmprestimos(id){	
    $.ajax({
        url: 'paginas/' + pag + "/listar_emprestimos.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(result){
            $("#listar_emprestimos").html(result);
            $('#mensagem-excluir2').text('');
        }
    });
}

</script>
