<?php

$arq = $_POST['file'];
$cpf = $_POST['cpf'];
$arq_part = explode("/", $arq);

// echo $arq_part[0].'<br>';
// echo $arq_part[1].'<br>';
// echo $arq_part[2].'<br>';
// echo $arq_part[3].'<br>';
// echo $arq_part[4].'<br>';
$diretory = "./uploads/".$cpf."img/";

$arquivo = $arq;
$resultado = unlink($diretory.$arquivo);


// echo '<a href="../index.php">Voltar</a>'


?>