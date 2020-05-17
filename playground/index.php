<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="../resources/favicon.png"/>
    <link rel="manifest" href="../manifest.json"> 
    <title>Stores BR</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="stylesheet" href="../resources/css/playground.css">
</head>
<body class="bg-play">
    <a href="../" class="btn btn-cl">Voltar</a>
    <?php
        if (isset($_SESSION['userid']) && $_SESSION['isadmin'] === 2){
            echo '<a href="video.php" class="btn btn-cl float-right">Postar</a>';
        }               
    ?>
    <center>
    <div class="container">
        <h1 class="float-right" style="color: #263e73;">Playground</h1>
    </div>
    <div class="cartao">
        <div class="title">
            <h5>Divirta-se com diversos jogos e quadrinhos enquanto aprende sobre a história do Brasil.</h5>
        </div>
        <div class="body">
            <p>Nós temos uma divertida coleção de quadrinhos para você que dificuldade em aprender história.</p>
            <p>Já leu nossos quadrinhos? <br> Então jogue também nossos jogos.</p>
        </div>
    </div>

    <div class="cartao-jogos">
        <div class="title">
            <h3>Videos</h3>
        </div>
        <div class="jogos">
            <div class="jogo"><a href="https://www.youtube.com/watch?v=8ola10-AzV4" target="_blank">
                <img src="../resources/src/bandeira.png" width="100%">
                <h4>Turminha do Seu Cabral</h4></a>
            </div>
        </div>
    </div>
    <div class="cartao-jogos">
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
    </div>
    <div class="cartao-jogos">
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
    </div>
    <!--JAVASCRIPT PARA FUNCIONAMENTO DO BOOTSTRAP-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
</body>
</html>