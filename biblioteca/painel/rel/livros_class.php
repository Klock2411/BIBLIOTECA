<?php 
require_once("../../conexao.php");

$cat = $_GET['cat'];
$editora = $_GET['editora'];
$local = $_GET['local'];
$status = urlencode($_GET['status']);

$html = file_get_contents($url_sistema."painel/rel/livros.php?cat=$cat&editora=$editora&local=$local&status=$status");

//CARREGAR DOMPDF
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

header("Content-Transfer-Encoding: binary");
header("Content-Type: image/png");

//INICIALIZAR A CLASSE DO DOMPDF
$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$pdf = new DOMPDF($options);


//Definir o tamanho do papel e orientação da página
$pdf->set_paper('A4', 'portrait');

//CARREGAR O CONTEÚDO HTML
$pdf->load_html($html);

//RENDERIZAR O PDF
$pdf->render();
//NOMEAR O PDF GERADO

$output = $pdf->output();
$arquivo = "../pdf/livros/livros.pdf";
	
if(file_put_contents($arquivo,$output) <> false) {
	$pdf->stream(
	'livros.pdf',
	array("Attachment" => false)
);

}


//enviar relatório para o whatsapp
$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_sistema);
$mensagem = 'Relatório de Livros';
$url_envio = $url_sistema."painel/pdf/livros/livros.pdf";
require("../api/arquivo.php")


 ?>