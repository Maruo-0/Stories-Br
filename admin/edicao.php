<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("Location: /StoriesBr/");
        exit();
    }
    require('../config/db.php');
    if($_SESSION['isadmin'] === 2){
        $aprovado = 1;
        $userid = $_SESSION['userid'];
    }else{
        $aprovado = 0;
        $userid = $_SESSION['userid'];
    }
    function uploadArquivo(){
        $dir_img = '../resources/src/';
        $dir_pdf = '../resources/pdf/';
        
        //upload de arquivos
        if( isset($_FILES['arquivo']['name'])) {
              
            $total = count($_FILES['arquivo']['name']);
          
            for($contador = 0; $contador < $total; $contador++) {
            
                // Check if file is selected
                if(isset($_FILES['arquivo']['name'][$contador]) && $_FILES['arquivo']['size'][$contador] > 0) {
                
                    $nome_original = $_FILES['arquivo']['name'][$contador];
                    $destino = $dir_pdf . basename($nome_original);
                    $fileType = pathinfo($destino,PATHINFO_EXTENSION);
    
    
                    if($fileType === 'pdf'){
                        $tmp  = $_FILES['arquivo']['tmp_name'][$contador];
                        move_uploaded_file($tmp, $destino);    
                    }
                    else{
                        $destino = $dir_img . basename($nome_original);
                        $tmp  = $_FILES['arquivo']['tmp_name'][$contador];
                        move_uploaded_file($tmp, $destino);    
                    }    
                }
            }
        }
    }
    // criar postagem
    if(isset($_POST['submit'])  && !empty($_FILES["arquivo"]["name"])){
        uploadArquivo();

        //get form data
        $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
        $desc = mysqli_real_escape_string($conn, $_POST['desc']);
        $texto = mysqli_real_escape_string($conn, $_POST['texto']);
        $textoIn = mysqli_real_escape_string($conn, $_POST['textoIn']);
        $pdf = mysqli_real_escape_string($conn, $_FILES['arquivo']['name'][1]);
        $img = mysqli_real_escape_string($conn, $_FILES['arquivo']['name'][0]);

        $query = "insert into `historias` (`aprovado`, `criador_id`, `titulo`, `img_capa`, `desc`, `texto`, `textoIngles`, `pdf`) values ('$aprovado', '$userid', '$titulo', '$img', '$desc', '$texto', '$textoIn', '$pdf')";

        if(empty($titulo) || empty($desc) || empty($texto)){
            header("Location: edicao.php?error=camposvazios");
            exit();
        }
        else{
            if(mysqli_query($conn, $query)){
                header("Location: ../livros");
                exit();
            }else{
                header("Location: edicao.php?error=sqlerror");
                exit();
            }
        }
    } // editar postagem
    elseif(isset($_POST['atualizar']) && !empty($_FILES["arquivo"]["name"]) && isset($_GET['ed'])){
        uploadArquivo();

        //checar se nome do arquivo está vazio e recolocar o existente se estiver
        for($i = 0; $i <= 1; $i++){
            if($_FILES['arquivo']['name'][$i] === ''){
                $id = mysqli_real_escape_string($conn, $_GET['id']);
                $query = 'select * from historias where id ='.$id;
                $result = mysqli_query($conn, $query);
                $historia = mysqli_fetch_assoc($result);
                mysqli_free_result($result);
                if($i === 0) $_FILES['arquivo']['name'][$i] = $historia['img_capa'];
                else  $_FILES['arquivo']['name'][$i] = $historia['pdf'];
            }    
        }

        $updated_id = mysqli_real_escape_string($conn, $_POST['update_id']);
        $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
        $desc = mysqli_real_escape_string($conn, $_POST['desc']);
        $texto = mysqli_real_escape_string($conn, $_POST['texto']);
        $textoIn = mysqli_real_escape_string($conn, $_POST['textoIn']);
        $pdf = mysqli_real_escape_string($conn, $_FILES['arquivo']['name'][1]);
        $img = mysqli_real_escape_string($conn, $_FILES['arquivo']['name'][0]);

        $query = "update `historias` set `titulo`='$titulo',  `img_capa`='$img', `desc`='$desc', `texto`='$texto', `textoIngles`='$textoIn', `pdf`='$pdf' where `id` = {$updated_id}";

        if(empty($titulo) || empty($desc) || empty($texto)){
            header("Location: edicao.php?error=camposvazios");
            exit();
        }
        else{
            if(mysqli_query($conn, $query)){
                header("Location: ../livros");
                exit();
            }else{
                header("Location: edicao.php?error=sqlerror");
                exit();
            }
        }
    }

    //pegar dados do conteúdo
    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $query = 'select * from historias where id ='.$id;
        $result = mysqli_query($conn, $query);
        $historia = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
    }
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="../resources/favicon.png"/>
    <title>Edição de conteúdo - Stories Br</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Slab&display=swap');
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto Slab', serif;
        }
        a{
            text-decoration: none;
            color: #000000;
            font-size: large;
        }
        .content{
            background: rgb(255, 238, 217);
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            margin: 26px auto 0;
            max-width: 100%;
            min-height: 300px;
            padding: 24px;
            position: relative;
            width: 85%;
        }
        .content:before, .content:after{
            content: "";
            height: 98%;
            position: absolute;
            width: 100%;
            z-index: -1;
        }
        .content:before{
            background: rgb(255, 244, 230);
            box-shadow: 0 0 8px rgba(0,0,0,0.2);
            left: -5px;
            top: 4px;
            transform: rotate(-2.5deg);
        }
        .content:after{
            background: rgb(216, 211, 204);
            box-shadow: 0 0 3px rgba(0,0,0,0.2);
            right: -3px;
            top: 1px;
            transform: rotate(1.4deg);
        }
        h1, h2{
            font-weight: 500;
            margin: 20px 0 10px 0 ;
        }
        form{
            background-color: rgb(221, 204, 191);
            padding: 20px;
            border: solid 1px #000000;
            border-radius: 0 5px 5px 0;
            overflow: hidden;
        }
        input[type="file"] {
            cursor: pointer;
            font-size: 18px;
        }
        .btn{
            border: none;
            padding: 16px 32px;
            text-decoration: none;
            margin-top: 10px;
            cursor: pointer;
            font-size: 25px;
        }
    </style>
</head>
<body>
    <div class="content">
    <a href="../" >/Página Inicial</a>
    <?php
        if(isset($_GET['error'])){
            echo '<h3>Erro Campos Vazios</h3>';
        }
        if (isset($_SESSION['userid']) && $_SESSION['isadmin'] === 1 || $_SESSION['isadmin'] === 2) {
            if(!isset($_GET['id'])){
                echo '<h1>Postar nova história</h1>
                <form method="POST" action="edicao.php"  enctype="multipart/form-data">

                <input type="file" name="arquivo[]" accept=".png, .jpg">
                <h2>Titulo:</h2>
                <div type="text"  id="titulo"></div>

                <h2>Descrição:</h2>
                <div type="text"  id="desc"></div>

                <h2>Texto:</h2>
                <div type="text" id="texto"></div>

                <h2>Texto Inglês (opcional):</h2>
                <div type="text" id="textoIn"></div>

                <h2>Pdf:</h2>
                <input type="file" name="arquivo[]" accept=".pdf">
                    
                <center>

                <input type="submit" name="submit" value="Postar" class="btn hidden"></center>
                </form>';
            }
            elseif(isset($_GET['id'])){
                echo '<h1>Editando - '.trim($historia['titulo'], '<p></p>').'</h1>

                    <form method="POST" action="edicao.php?ed=true&id='.$historia['id'].'" enctype="multipart/form-data">

                    <input type="file" name="arquivo[]" accept=".png, .jpg">
                    <h2>Titulo:</h2>
                    <div type="text" id="titulo">'.$historia['titulo'].'</div>
        
                    <h2>Descrição:</h2>
                    <div type="text"  id="desc">'.$historia['desc'].'</div>
        
                    <h2>Texto:</h2>
                    <div type="text" id="texto">'.$historia['texto'].'</div>
        
                    <h2>Texto Inglês (opcional):</h2>
                    <div type="text" id="textoIn">'.$historia['textoIngles'].'</div>
        
                    <h2>Pdf:</h2>
                    <input type="file" name="arquivo[]" accept=".pdf">
                    <center>
        
        
                    <input type="hidden" name="update_id" value="'.$historia['id'].'">
                    <input type="submit" name="atualizar" value="Atualizar" class="btn"></center>
                
                </form>';
            }
        }    
    ?>
    </div>
    <!--editor de texto tinymce-->
    <script src='https://cdn.tiny.cloud/1/m5k5p2iwalfnp6bt442au68lhsqaurzbdaqlt6a3pgkf7f38/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#titulo, #desc, #texto, #textoIn',
            menu: {Opções: {title: 'Opções', items: 'code searchreplace wordcount'}},
            menubar: 'file Opções',
            toolbar: 'undo redo | styleselect',
            plugins: 'wordcount code searchreplace print preview paste',
            paste_auto_cleanup_on_paste : true,
            paste_remove_styles: true,
            paste_remove_styles_if_webkit: true,
            paste_retain_style_properties: false,
            paste_strip_class_attributes: true,
        });
    </script>
</body>
</html>
