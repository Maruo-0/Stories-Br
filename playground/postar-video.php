<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("Location: /StoriesBr/");
        exit();
    }
    require '../config/db.php';
    if(isset($_POST['submit'])){
        $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
        $iframe = mysqli_real_escape_string($conn, $_POST['iframe']);
        echo $titulo;
        echo $iframe;
        $query = "insert into videos (titulo, url) values ('{$titulo}', '{$iframe}')";

        if(empty($titulo) || empty($iframe)){
            header("Location: video.php?error=camposvazios");
            exit();
        }
        else{
            if(mysqli_query($conn, $query)){
                header("Location: atividades");
                exit();
            }else{
                header("Location: video.php?error=sqlerror");
                exit();
            }
        }
        mysqli_close($conn);
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="../resources/favicon.png"/>
    <title>Postar vídeo - Stories Br</title>
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
        input[type="text"] {
            width: 100%;
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
            echo '<h1>Postar novo vídeo</h1>
            <form method="POST" action="postar-video.php">
                <h2>Titulo:</h2>
                <input type="text" name="titulo" id="titulo"></input>

                <h2>Vídeo incorporado (iframe):</h2>
                <input type="text" name="iframe" id="iframe"></input>
                <center>
                <input type="submit" name="submit" value="Postar" class="btn"></center>
            </form>';
        ?>
    </div>
    <!--editor de texto tinymce-->
    <script src='https://cdn.tiny.cloud/1/m5k5p2iwalfnp6bt442au68lhsqaurzbdaqlt6a3pgkf7f38/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#titulo',
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
