<?php 
require_once("../conexao.php");
@session_start();
$id_usuario = $_SESSION['id'];

$home = 'ocultar';
$config = 'ocultar';

//grupo pessoas
$usuarios = 'ocultar';
$leitores = 'ocultar';


//grupo cadastros
$livros = 'ocultar';
$cargos = 'ocultar';
$categorias = 'ocultar';
$grupos = 'ocultar';
$acessos = 'ocultar';
$locais = 'ocultar';
$editoras = 'ocultar';

//grupo emprestimos
$emprestimos_ativos = 'ocultar';
$lista_devolucoes = 'ocultar';
$devolucoes_hoje = 'ocultar';
$devolucoes_atraso = 'ocultar';
$todos_emprestimos = 'ocultar';


$query = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
		$permissao = $res[$i]['permissao'];
		
		$query2 = $pdo->query("SELECT * FROM acessos where id = '$permissao'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$nome = $res2[0]['nome'];
		$chave = $res2[0]['chave'];
		$id = $res2[0]['id'];

		if($chave == 'home'){
			$home = '';
		}

		if($chave == 'config'){
			$config = '';
		}

		if($chave == 'leitores'){
			$leitores = '';
		}

		if($chave == 'usuarios'){
			$usuarios = '';
		}

		if($chave == 'livros'){
			$livros = '';
		}


		if($chave == 'cargos'){
			$cargos = '';
		}

		if($chave == 'categorias'){
			$categorias = '';
		}

		if($chave == 'grupos'){
			$grupos = '';
		}

		if($chave == 'acessos'){
			$acessos = '';
		}

		if($chave == 'locais'){
			$locais = '';
		}

		if($chave == 'editoras'){
			$editoras = '';
		}

		if($chave == 'emprestimos'){
			$emprestimos_ativos = '';
		}

		if($chave == 'devolucoes'){
			$lista_devolucoes = '';
		}


		if($chave == 'devolucoes_hoje'){
			$devolucoes_hoje = '';
		}

		if($chave == 'devolucoes_atraso'){
			$devolucoes_atraso = '';
		}

		if($chave == 'devolucoes_atraso'){
			$devolucoes_atraso = '';
		}

		if($chave == 'todos_emprestimos'){
			$todos_emprestimos = '';
		}





	}

}


if($home != 'ocultar'){
	$pag_inicial = 'home';
}else{
	$query = $pdo->query("SELECT * FROM usuarios_permissoes where usuario = '$id_usuario' order by id asc limit 1");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){	
			$permissao = $res[0]['permissao'];		
			$query2 = $pdo->query("SELECT * FROM acessos where id = '$permissao'");
			$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);		
			$pag_inicial = $res2[0]['chave'];		

	}else{
		$pag_inicial = 'nenhuma';
	}
}


if($usuarios == 'ocultar' and $leitores == 'ocultar'){
	$menu_pessoas = 'ocultar';
}else{
	$menu_pessoas = '';
}


if($livros == 'ocultar' and $cargos == 'ocultar' and $categorias == 'ocultar' and $grupos == 'ocultar' and $acessos == 'ocultar' and $locais == 'ocultar' and $editoras == 'ocultar'){
	$menu_cadastros = 'ocultar';
}else{
	$menu_cadastros = '';
}


if($emprestimos_ativos == 'ocultar' and $lista_devolucoes == 'ocultar' and $devolucoes_hoje == 'ocultar' and $devolucoes_atraso == 'ocultar' and $todos_emprestimos == 'ocultar'){
	$menu_emprestimos = 'ocultar';
}else{
	$menu_emprestimos = '';
}


 ?>