<?php

$arq = $_POST['file'];
$cpf = $_POST['cpf'];

include("/var/www/html/upvendas/sistema/connect.php");
include("/var/www/html/upvendas/sistema/utf8.php");


$diretory = "./uploads/".$cpf."pdf/";

$arquivo = $arq;
$resultado = unlink($diretory.$arquivo);

$sql = "DELETE FROM sys_listas_anexos WHERE anexo_nome = '$arquivo'";
                        
mysqli_query($con, $sql) or die(mysqli_error($con));


// echo '<a href="../index.php">Voltar</a>'

?>