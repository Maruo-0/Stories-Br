<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("Location: /StoriesBr/");
        exit();
    }
    require('../config/db.php');

    //check for submit
    if(isset($_POST['submit'])  && !empty($_FILES["arquivo"]["name"])){

        $dir_img = '../resources/src/';
        $dir_pdf = '../resources/pdf/';
    
        if( isset($_FILES['arquivo']['name'])) {
              
            $total = count($_FILES['arquivo']['name']);
          
            for($key = 0; $key < $total; $key++) {
            
                // Check if file is selected
                if(isset($_FILES['arquivo']['name'][$key]) && $_FILES['arquivo']['size'][$key] > 0) {
                
                    $nome_original = $_FILES['arquivo']['name'][$key];
                    $destino = $dir_pdf . basename($nome_original);
                    $fileType = pathinfo($destino,PATHINFO_EXTENSION);
    
    
                    if($fileType === 'pdf'){
                        $tmp  = $_FILES['arquivo']['tmp_name'][$key];
                        move_uploaded_file($tmp, $destino);    
                    }
                    else{
                        $destino = $dir_img . basename($nome_original);
                        $tmp  = $_FILES['arquivo']['tmp_name'][$key];
                        move_uploaded_file($tmp, $destino);    
                    }    
                }
            }
        }
    

        //get form data
        $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
        $desc = mysqli_real_escape_string($conn, $_POST['desc']);
        $texto = mysqli_real_escape_string($conn, $_POST['texto']);
        $textoIn = mysqli_real_escape_string($conn, $_POST['textoIn']);
        $pdf = mysqli_real_escape_string($conn, $_FILES['arquivo']['name'][1]);
        $img = mysqli_real_escape_string($conn, $_FILES['arquivo']['name'][0]);

        $query = "insert into `historias` (`titulo`, `img_capa`, `desc`, `texto`, `textoIngles`, `pdf`) values ('$titulo', '$img', '$desc', '$texto', '$textoIn', '$pdf')";

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
    elseif(isset($_POST['atualizar']) && !empty($_FILES["arquivo"]["name"]) && isset($_GET['ed'])){

        $dir_img = '../resources/src/';
        $dir_pdf = '../resources/pdf/';
    
        if( isset($_FILES['arquivo']['name'])) {
              
            $total = count($_FILES['arquivo']['name']);
          
            for($key = 0; $key < $total; $key++) {
            
                // Check if file is selected
                if(isset($_FILES['arquivo']['name'][$key]) && $_FILES['arquivo']['size'][$key] > 0) {
                
                    $nome_original = $_FILES['arquivo']['name'][$key];
                    $destino = $dir_pdf . basename($nome_original);
                    $fileType = pathinfo($destino,PATHINFO_EXTENSION);
    
    
                    if($fileType === 'pdf'){
                        $tmp  = $_FILES['arquivo']['tmp_name'][$key];
                        move_uploaded_file($tmp, $destino);    
                    }
                    else{
                        $destino = $dir_img . basename($nome_original);
                        $tmp  = $_FILES['arquivo']['tmp_name'][$key];
                        move_uploaded_file($tmp, $destino);    
                    }    
                }
            }
        }
        //checar se nome do arquivo está vazio e recolocar o existente se estiver
        if($_FILES['arquivo']['name'][1] === ''){
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $query = 'select * from historias where id ='.$id;
            $result = mysqli_query($conn, $query);
            $historia = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            mysqli_close($conn);
            $_FILES['arquivo']['name'][1] === $historia['id'];
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

    if(isset($_GET['id'])){
        //get id
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        $query = 'select * from historias where id ='.$id;

        $result = mysqli_query($conn, $query);

        //fetch data
        $historia = mysqli_fetch_assoc($result);
        //var_dump($posts);

        mysqli_free_result($result);

        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nova história</title>
    <!--CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../resources/css/style.css">
</head>
<body>
    
    <?php

        if (isset($_SESSION['userid']) && $_SESSION['isadmin'] === 1 || $_SESSION['isadmin'] === 2) {
            if(!isset($_GET['id'])){
                echo '<h1>Postar nova história</h1>
                <form method="POST" action="edicao.php"  enctype="multipart/form-data" style="background-color: #95a5a6; padding: 10px;">

                <input type="file" name="arquivo[]">
                <label>Titulo</label>
                <div type="text"  id="titulo"></div>

                <label>Descrição</label>
                <div type="text"  id="desc"></div>

                <label>Texto</label>
                <div type="text" id="texto"></div>

                <label>Texto Inglês</label>
                <div type="text" id="textoIn"></div>


                <input type="file" name="arquivo[]">
                    
                <center>

                <input type="submit" name="submit" id="criar" value="Criar" class="btn btn-primary hidden"></center>
                </form>
                <button id="salvar" class="btn btn-primary">Salvar</button>';
            }
            elseif(isset($_GET['id'])){
                echo '<h1>Editando - '.$historia['titulo'] .'</h1>

                    <form method="POST" action="edicao.php?ed=true?id='.$historia['id'].'" enctype="multipart/form-data" style="background-color: #95a5a6; padding: 10px;">

                    <input type="file" name="arquivo[]">
                    <label>Titulo</label>
                    <div type="text" id="titulo">'.$historia['titulo'].'</div>
        
                    <label>Descrição</label>
                    <div type="text"  id="desc">'.$historia['desc'].'</div>
        
                    <label>Texto</label>
                    <div type="text" id="texto">'.$historia['texto'].'</div>
        
                    <label>Texto Inglês</label>
                    <div type="text" id="textoIn">'.$historia['textoIngles'].'</div>
        
                    <label>Pdf</label>
                    <input type="file" name="arquivo[]">
                    <center>
        
        
                    <input type="hidden" name="update_id" value="'.$historia['id'].'">
                    <input type="submit" name="atualizar" id="criar" value="Atualizar" class="btn btn-primary hidden"></center>
                
                </form>
                <button id="salvar" class="btn btn-primary">Salvar</button>';
            }
        }
    ?>
    

    <!--editor de texto tinymce-->
    <script src='https://cdn.tiny.cloud/1/m5k5p2iwalfnp6bt442au68lhsqaurzbdaqlt6a3pgkf7f38/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
    <script>
    tinymce.init({
        selector: '#titulo, #desc, #texto, #textoIn'
    });

    const salvar = document.querySelector('#salvar');
    const criar = document.querySelector('#criar');
    salvar.addEventListener('click', e => {
        criar.style.display = "block";
    });
    </script>

    <!--bootstrap-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
