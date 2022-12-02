<?php

$pasta = "uploads/".$cpf."/";
$arquivos = glob("$pasta{*.jpg,*.jpeg,*.JPG,*.png,*.gif,*.bmp}", GLOB_BRACE);

foreach($arquivos as $img){

   $exif = @exif_read_data($img)['Orientation'];  

   if($exif == 6){
      $img_class = '-webkit-transform: rotate(90deg); -ms-transform: rotate(90deg); transform: rotate(90deg);margin-top: 80px;';
   }else{
      $img_class = '';
   }

   

?>
<div style='width: 100%; height: 80%; padding: 30px'>
   <p><?php echo "EXIF: " . $exif; ?></p>   
</div>

   <?php } ?>


   