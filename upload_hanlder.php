<?php

// var_dump($_POST['name']);
// var_dump($_POST['caption']);
// var_dump($_FILES);
// $filename = $_FILES['files']['name'][0];
// $tmp_name = $_FILES['files']['tmp_name'][0];
$cpf = $_POST['cpf'];
mkdir("uploads/".$cpf, 0777, true);

// move_uploaded_file($tmp_name, './uploads/'.$cpf.'/' . $filename);

// $link = "<script>window.open('./uploads/".$cpf."/" . $filename."')</script>";

// echo $link;

$countfiles = count($_FILES['file']['name']);
 
// Looping all files
for($i=0;$i<$countfiles;$i++){
  $filename = $_FILES['file']['name'][$i];
  
  // Upload file
  move_uploaded_file($_FILES['file']['tmp_name'][$i],'./uploads/'.$cpf.'/' . $filename);
   
}