<?php 

$cpf_url = $_GET['id']."/";

foreach (glob('./uploads/'.$cpf_url.'/pdf/*.pdf') as $pdf) {
    if($pdf){
        $verifica_pdf = 'true';
    }else{
        $verifica_pdf = 'false';
    }
}

foreach (scandir('./uploads/'.$cpf_url.'img/') as $img) {    
    $tipo = mime_content_type('./uploads/'.$cpf_url.'img/'.$img);
    if($tipo == 'image/jpeg' || $tipo == 'image/jpg' ||$tipo == 'image/png' || $tipo == 'image/gif' || $tipo == 'image/bmp' || $tipo == 'image/svg'){
        $verifica_img = 'true';
    }else{
        $verifica_img = 'false';
    }

}

?>

<!doctype html>
<html lang="pt-BR">

<head>

    <title>UPLOAD FILES</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="index.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Uppy -->
    <link rel="stylesheet" href="./uppy core/dist/uppy.min.css">
    <style>
        .uploaded-files {
            display: flex !important;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .preview-cont {
            margin: 0 auto
        }

        .check {
            position: absolute;
            right: 0;
            margin: 10px;
        }
        #icon-close{
            position: absolute;
            top: 0;
            right: 30px;
            color: red;
            cursor: pointer;
        }
        
    </style>

</head>

<body>
    <div class="container mt-5">
        <div class="row">
        </div>
        <div class="row">
            <form id="formulario">
                <input id="uppyResult" type="hidden" name="uppyResult">
                <input id="cpf" name="cpf" placeholder="CPF" type="hidden" value="<?php echo $cpf_url; ?>">
                <div class="uppy-container">
                <button type="submit" class="btn btn-primary">Upload...</button>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <h4>PDF's Gerados</h4>
    </div>
    <div class="uploaded-files" style="width: 100%">
    <table class="table table-light">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Link</th>
                <th scope="col">Ação</th>                
            </tr>
        </thead>
        <tbody>
        <?php
        if($verifica_pdf == 'true'){       
        if(is_dir('uploads/'.$cpf_url."pdf/")){            
            foreach (scandir('./uploads/'.$cpf_url."pdf/") as $dir) {
                if ($dir == '.' || $dir == '..') {
                    continue;
                }
                $extensao = explode(".", $dir);    
        ?>        
        <div class="preview-cont">
            
            <?php if($extensao[1] == 'pdf') { ?>
            <tr>
                <td><?php echo $dir; ?></td>
                <td><a href="./uploads/<?php echo $cpf_url ."pdf/". $dir?>" target="blank">Abrir</a></td>
                <td><button class="btn btn-danger btn-sm delete_pdf"><i class="bi bi-trash"></i></button></td>
             
            </tr>
            <?php  } ?>
            <?php } ?>
            <?php } ?>
            <?php }else{ ?>
            <tr>
                <td style="color: lightgrey; font-weight: bold" colspan="3">Nenhum PDF gerado</td>
            </tr>                
            <?php } ?>
        </tbody>
    </table>
    
      
        
        
    </div>
    <hr>
    <div class="row">
        <h4>Imagens Carregadas</h4>
    </div>
    <div class="uploaded-files" style="width: 100%">
        <?php
        if($verifica_img == 'true'){
        if(is_dir('uploads/'.$cpf_url.'img/')){            
            foreach (scandir('./uploads/'.$cpf_url.'img/') as $dir) {
                if ($dir == '.' || $dir == '..') {
                    continue;
                }            
        ?>        
        <div class="preview-cont">
            <?php
                $extensao = explode(".", $dir);
                if ($extensao[1] == 'jpg' || $extensao[1] == 'png' || $extensao[1] == 'jpeg' || $extensao[1] == 'gif' || $extensao[1] == 'bmp' || $extensao[1] == 'svg' || $extensao[1] == 'webp' || $extensao[1] == 'ico' || $extensao[1] == 'tiff') { ?>

            <div class="card" style="width: 14rem;">
                <input type="hidden" class="dir" name="" value="<?php echo $dir?>">
                <img src="./uploads/<?php echo $cpf_url ."img/". $dir?>" class="card-img-top" alt=""><input type="checkbox"
                    class="form-check-input check"></img>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $dir?></h5>
                    <button class="btn btn-outline-danger delete"><i class="bi bi-trash"></i></button>
                </div>
            </div>

            <?php } ?>
        </div>
        
        <?php    } ?>
        <?php    } ?>
        <?php    }else{ ?>
            <h6 style="font-weight: bold; color: lightgrey">Nenhuma imagem carregada</h6>
        <?php    } ?>
    </div>
    <div class="row mt-5 mb-5">
        <?php if($verifica_img == 'true'){ ?>
        <button onclick="gerarPDF()" id="gerar_pdf" class="btn btn-secondary" disabled><i class="bi bi-check2-square"></i> Selecione as imagens</button>
        <?php } ?>
    </div>
    </div>

    <!-- Optional JavaScript -->
    <script>
        function testando(){
            $('#gerar_pdf').attr('disabled', true);
        }
        function reload_page() {
            setTimeout(function () {
                location.reload();
            }, 1000);
        }
        var array = []
        $('.check').change(function () {
            if (this.checked) {
                array.push($(this).parent().find(".dir").val())
                console.log(array)
            } else {
                var index = array.indexOf($(this).parent().find(".dir").val())
                if (index > -1) {
                    array.splice(index, 1);
                }
                console.log(array)
            }

        })

        function gerarPDF(){
        
            $.ajax({
                url: "gerapdf.php",
                type: "POST",
                data: {
                    id: '<?php echo $cpf_url; ?>',
                    files: array
                },
                beforeSend: function () {
                    $('#gerar_pdf').html('<i class="bi bi-file-arrow-up"></i> Gerando PDF...');
                },
                success: function(response){
                    location.reload();
                }            
        })
        }
        $(".delete_pdf").on("click", function(){
            var file = $(this).parent().parent().find("a").attr("href")
            var file = file.split("/")
            var file = file[4]
            var cpf = '<?php echo $cpf_url; ?>';
            $.ajax({
                url: "delete_pdf.php",
                type: "POST",
                data: {
                    file: file,
                    cpf: cpf
                },
                success: function(response){
                    location.reload()
                }
            })
        
        })
        $(".delete").on("click", function () {
            var file = $(this).parent().parent().find("img").attr("src");
            var file = file.split("/");
            var file = file[4];
            var cpf = '<?php echo $cpf_url; ?>';
            $.ajax({
                url: "delete.php",
                type: "POST",
                data: {
                    file: file,
                    cpf: cpf
                },
                success: function (data) {
                    location.reload();
                }
            })
            
        });
        $(document).ready(function () {
            var total = $('.check').length;
            var total_checked = $('.check:checked').length;
            if (total_checked > 0) {
                $('#gerar_pdf').attr('disabled', false);
                $('#gerar_pdf').html("<i class='bi bi-filetype-pdf'></i> Gerar PDF");
            } else {
                $('#gerar_pdf').attr('disabled', true);
                $('#gerar_pdf').html("<i class='bi bi-check2-square'></i> Selecione as imagens");
            }
            $('.check').change(function () {
                var total = $('.check').length;
                var total_checked = $('.check:checked').length;
                if (total_checked > 0) {
                    $('#gerar_pdf').attr('disabled', false);
                    $('#gerar_pdf').html("<i class='bi bi-filetype-pdf'></i> Gerar PDF");
                } else {
                    $('#gerar_pdf').attr('disabled', true);
                    $('#gerar_pdf').html("<i class='bi bi-check2-square'></i> Selecione as imagens");
                    
                }
            })
        })
    </script>
    <script src="./uppy core/dist/uppy.min.js"></script>
    <script src="./index.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

</body>

</html>