<?php session_start(); require '../config/db.php'?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="../resources/favicon.png"/>
    <link rel="manifest" href="../manifest.json"> 
    <title>Atividades - Stories BR</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="stylesheet" href="../resources/css/playground.css">
    <style>
        a{
            color: white;
            text-decoration: none;
        }
        a:hover{
            color: #4caf50;
        }
    </style>
</head>
<body class="bg-play">
    <a href="../" class="btn btn-cl">Voltar</a>
    <?php
        if (isset($_SESSION['userid']) && $_SESSION['isadmin'] === 2){
            echo '<a href="postar-video.php" class="btn btn-cl float-right">Postar</a>';
        }               
    ?>
    <center>
    <div class="container">
        <h1 class="float-right" style="color: #263e73;">Playground</h1>
    </div>
    <div class="cartao">
        <div class="title">
            <h4>Divirta-se com diversos jogos e quadrinhos enquanto aprende sobre a história do Brasil.</h4>
        </div>
        <div class="body">
            <p>Nós temos uma divertida coleção de quadrinhos para você que dificuldade em aprender história.</p>
            <p>Já leu nossos quadrinhos? <br> Então jogue também nossos jogos.</p>
        </div>
    </div>

    <div class="cartao-jogos" style="padding-bottom: 20px">
        <div class="title">
            <h3>Vídeos</h3>
        </div>
        <div class="jogos">
            <?php
                $query_videos = 'select * from videos order by created_at desc limit 0, 3';
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
        <div><a href="videos" class="btn btn-cl">Todos vídeos</a></div>
    </div>
    <!-- <div class="cartao-jogos">
        <div class="title">
            <h3>Quadrinhos</h3>
        </div>
        <div class="jogos">
            <div class="jogo">
                <img src="../resources/src/bandeira.png" width="100%">
                <h4>Turminha do Seu Cabral</h4>
            </div>
            <div class="jogo">
                <img src="../resources/src/bandeira.png" width="100%">
                <h4>Turminha do Seu Cabral</h4>
            </div>
            <div class="jogo">
                <img src="../resources/src/bandeira.png" width="100%">
                <h4>Turminha do Seu Cabral</h4>
            </div>
        </div>
    </div> -->
    <div class="cartao-jogos" style="padding-bottom: 20px">
        <div class="title">
            <h3>Jogos</h3>
        </div>
        <div class="jogos">
            <div class="jogo"><a href="jogomemoria-js/index.html">
                <img src="../resources/src/bandeira.png" width="100%">
                <h4>Jogo da Memória</h4>
            </div></a>
            <div class="jogo"><a href="descobrimento.html">
                <img src="../resources/src/bandeira.png" width="100%">
                <h4>Quiz</h4>
            </div></a>
        </div>
        <div><a href="jogos" class="btn btn-cl">Todos jogos</a></div>
    </div>
</body>
</html>