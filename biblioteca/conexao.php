<?php 

//definir fuso horário
date_default_timezone_set('America/Sao_Paulo');


//dados conexão bd local
$servidor = 'localhost';
$banco = 'biblioteca';
$usuario = 'root';
$senha = 'root';


/*
$servidor = 'sh-pro24.hostgator.com.br';
$banco = 'hugocu75_biblioteca';
$usuario = 'hugocu75_biblioteca';
$senha = 'Senhateste';
*/

try {
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
} catch (Exception $e) {
	echo 'Erro ao conectar ao banco de dados!<br>';
	echo $e;
}


//variaveis globais
$nome_sistema = 'Nome Sistema';
$email_sistema = 'contato@hugocursos.com.br';
$telefone_sistema = '(31)97527-5084';

$url_sistema = "http://$_SERVER[HTTP_HOST]/";
$url = explode("//", $url_sistema);
if($url[1] == 'localhost/'){
	$url_sistema = "http://$_SERVER[HTTP_HOST]/biblioteca/";
}

$query = $pdo->query("SELECT * from config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas == 0){
	$pdo->query("INSERT INTO config SET nome = '$nome_sistema', email = '$email_sistema', telefone = '$telefone_sistema', logo = 'logo.png', logo_rel = 'logo.jpg', icone = 'icone.png', marca_dagua = 'Sim', dias_entrega = '5', api_whatsapp = 'Não'");
}else{
$nome_sistema = $res[0]['nome'];
$email_sistema = $res[0]['email'];
$telefone_sistema = $res[0]['telefone'];
$endereco_sistema = $res[0]['endereco'];
$instagram_sistema = $res[0]['instagram'];
$logo_sistema = $res[0]['logo'];
$logo_rel = $res[0]['logo_rel'];
$icone_sistema = $res[0]['icone'];
$marca_dagua = $res[0]['marca_dagua'];
$dias_entrega = $res[0]['dias_entrega'];
$api_whatsapp = $res[0]['api_whatsapp'];
$token_api = $res[0]['token_api'];
$instancia_api = $res[0]['instancia_api'];
}	
 ?>
