<?php
    session_start();
    if(isset($_GET['error'])){
        if($_GET['error'] == 'emailjautilizado' || $_GET['error'] == 'emailinvalido' || $_GET['error'] == 'senhasdiferentes' || $_GET['error'] == 'camposvazios'){
        $nome = $_GET['nome'];
        }
    }
    if (isset($_SESSION['userid'])) {
        header("Location: /StoriesBr/");
        exit();                    
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stores BR</title>
    <!--CSS-->
    <link rel="shortcut icon" type="image/png" href="resources/favicon.png"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="resources/css/inscricao.css">
</head>
<body></body>
<nav class="navbar sticky-top navbar-expand-md bg-light">
    <a class="navbar-brand" href="/StoriesBr/">Stories <img src="resources/src/br.svg" alt="Stores BR" id="logo2" style="width: 60px"></a>
</nav>
    
<form action="config/inscricao.inc.php" method="post">

    <?php
        if (isset($_SESSION['POST'])){
            $_POST = $_SESSION['POST'];
            $email = $_POST['email'];
            unset($_SESSION['POST']);  
            echo '<div class="container" style="margin-top:30px">
            <center>
            <h1>Um email de ativação foi enviado para '.$email.'</h1>
            <h3>Para usar sua conta no StoriesBr, localize o e-mail de ativação</h3>
            <h3>na sua caixa de entrada e use o link de autenticação.</h3>

            <footer class="container signin fixed-bottom">
                <p>Já tem uma conta? <a href="login">Faça o Login</a>.</p>
            </footer>';
            exit();
        }
    ?>

    <div class="container">
        <h1>Crie sua conta</h1>
        <p>Preencha os campos para se registrar.</p>
        <hr>
    
        <label for="nome"><b>Nome</b></label>
        <input type="text" name="nome" placeholder="Nome" required value="<?php 
        if(isset($_GET['error'])){
            if ($_GET['error'] == 'emailjautilizado' || $_GET['error'] == 'emailinvalido' || $_GET['error'] == 'senhasdiferentes') {
                    echo $nome;
            }
        }?>">

        <label for="email"><b>Email</b></label>
        <input type="text" name="email" placeholder="exemplo@exemplo.com" required>
    
        <label for="psw"><b>Senha</b></label>
        <input type="password" name="senha" placeholder="******" required>
    
        <label for="psw-repeat"><b>Confirme a senha</b></label>
        <input type="password" name="senha-rep" placeholder="******" required>
        <hr>
    
        <p>Ao criar uma conta você está concordando com nossos <a href="#">Termos de uso</a>.</p>
        <button type="submit" name="registrar" class="registerbtn">Registrar</button>
    </div>
    
</form>
    <div class="container signin">
        <p>Já tem uma conta? <a href="login">Faça o Login</a>.</p>
    </div>

</body>
</html>