<?php
session_start();
//referenciar o DomPDF com namespace
use Dompdf\Dompdf;
use Dompdf\Options;
// include autoloader
require "dompdf/dompdf/autoload.inc.php";
ob_start();
// include_once("pdf_doc.php");


include("/var/www/html/upvendas/sistema/connect.php");
include("/var/www/html/upvendas/sistema/utf8.php");



$cpf = $_POST['id'];
$files = $_POST['files'];

$html = '';

$pasta = "uploads/".$cpf."img/";

// $files = json_encode($files);
// $files = str_replace("[", "", $files);
// $files = str_replace("]", "", $files);
// $files = str_replace('"', "'", $files);


foreach($files as $file){
$arquivos = glob("$pasta{$file}", GLOB_BRACE);


foreach($arquivos as $img){

   $exif = @exif_read_data($img)['Orientation']; 

   if($exif == 6){
      $html = $html . "<div style='width: 100%; height: 80%; padding: 30px'><img style='width: 100%; margin: 20px;-webkit-transform: rotate(90deg); -ms-transform: rotate(90deg); transform: rotate(90deg);margin-top: 80px;' src=".$img."></div>";
   }else{
      $html = $html . "<div style='width: 100%; height: 80%; padding: 30px'><img style='width: 100%; margin: 20px;' src=".$img."></div>";
   }

}



}




// $sql_anexo = "INSERT INTO sys_listas_anexos
//                         (anexo_id,
//                         lista_id,
//                         registro_id,
//                         anexo_nome,
//                         anexo_caminho,
//                         anexo_data) VALUES
//                         (NULL,
//                         $lista_id,
//                         '".$last_registro['registro_id']."',
//                         '$lista_arquivo',
//                         '$anexo_caminho',
//                         NOW());";
// mysqli_query($con, $sql_anexo) or die(mysqli_error($con));


ob_end_clean();

//Criando a Instancia
$options = new Options();
$options->set('defaultFont', 'Courier');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$pdf = $dompdf->output();
$date_hour = date('d-m-Y-H-i-s');
$fp = fopen("uploads/".$cpf."pdf/".$date_hour.".pdf", "a");
fwrite($fp, $pdf);
fclose($fp);

$lista_arquivo = $date_hour.".pdf";
$anexo_caminho = "/var/www/html/includes_doc_cliente/upload/uploads/".$cpf."pdf/".$date_hour.".pdf";

$sql_anexo = "INSERT INTO sys_listas_anexos
                        (anexo_id,
                        anexo_nome,
                        anexo_caminho,
                        anexo_data) VALUES
                        (NULL,
                        '$lista_arquivo',
                        '$anexo_caminho',
                        NOW());";
mysqli_query($con, $sql_anexo) or die(mysqli_error($con));

foreach($files as $file){
array_map('unlink', glob("uploads/".$cpf."/img/".$file));
}
$cpf = explode("/", $cpf);
$dompdf->stream($cpf[0]."_".$date_hour.".pdf",["Attachment" => false]);
  header('Content-type: application/pdf; charset=utf-8');
  echo $pdf;


?>