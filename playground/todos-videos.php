<?php session_start(); require '../config/db.php'?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/StoriesBr/resources/favicon.png"/>
    <link rel="manifest" href="/StoriesBr/manifest.json"> 
    <title>Videos animados - Stories Br</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/StoriesBr/resources/css/style.css">
    <link rel="stylesheet" href="/StoriesBr/resources/css/playground.css">
</head>
<body class="bg-play">
    <a href="/StoriesBr/playground/atividades" class="btn btn-cl">Voltar</a>
    <?php
        if (isset($_SESSION['userid']) && $_SESSION['isadmin'] === 2){
            echo '<a href="/StoriesBr/playground/postar-video.php" class="btn btn-cl float-right">Postar</a>';
        }               
    ?>
    <center>    
    <?php if(!isset($_GET['id'])){ ?>
    <div class="cartao-jogos">
        <div class="title">
            <h1>Vídeos</h1>
        </div>
        <div class="jogos">
            <?php
                $query_videos = 'select * from videos order by created_at desc';
                $videos = mysqli_query($conn, $query_videos);
                if(mysqli_num_rows($videos)){
                    while($videos_resultado = mysqli_fetch_assoc($videos)){
                        echo '<div class="jogo"><a href="video/'.$videos_resultado['id'].'">
                            <img src="../resources/src/brazil.png" width="100%">
                            <h4>'.trim($videos_resultado['titulo'], '<p></p>').'</h4></a>
                        </div>';
                    }
                }else echo '<h3>Nenhum video encontrado.</h3>';
            ?>            
        </div>
    </div>
    <?php } elseif(isset($_GET['id'])){?>
        <div style="height: 700px;">
            <?php
                $id = mysqli_real_escape_string($conn, $_GET['id']);
                $query_video = "select * from videos where id = {$id} order  by created_at desc";
                $video = mysqli_query($conn, $query_video);
                $video_resultado = mysqli_fetch_assoc($video);
                echo '<h2>'.trim($video_resultado['titulo'], '<p></p>').'</h2>
                    <div style="height: 100%;">'.$video_resultado['url'].'</div>';
            ?>
        </div>
    <?php } ?>
</body>
</html>