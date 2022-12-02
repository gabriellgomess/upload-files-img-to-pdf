<?php

$cpf = $_POST['id'];
$files = $_POST['files'];

$files = json_encode($files);
$files = str_replace('[',"",$files);
$files = str_replace(']',"",$files);
$files = str_replace('"',"'",$files);

// $files = explode(",", $files);

$pasta = "uploads/".$cpf."img/";

$arquivos = glob($pasta.$files, GLOB_BRACE);

foreach($arquivos as $img){
    echo "Imagem" . $img;
}











?>