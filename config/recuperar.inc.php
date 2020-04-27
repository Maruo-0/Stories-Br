<?php
    require 'db.php';

    if(isset($_POST['recuperar'])){

        $senha = $_GET['rec'];

        $querySenha = "select * from usuarios where senha=?;";
    
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $querySenha);
        mysqli_stmt_bind_param($stmt, "s", $senha);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $senha = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
    
        if(!empty($senha['senha'])){
            echo $senha['senha'];
            recuperar();
            header("Location: ../login");
            exit();
        }
        else{
            mysqli_close($conn);
            exit();
        }
    }
    function recuperar(){
        global $conn;

        $senha = $_GET['rec'];
        $novaSenha = mysqli_real_escape_string($conn, $_POST['novaSenha']);
        $hashedSenha = password_hash($novaSenha, PASSWORD_DEFAULT);

        $queryAut = "update `usuarios` set `senha`='".$hashedSenha."' where senha='".$senha."';";
        $result = mysqli_query($conn, $queryAut);
        mysqli_close($conn);
        echo 'sucesso';
        if (session_status()!==PHP_SESSION_ACTIVE)session_start();
        $_SESSION['RECUPERAR'] = 'recuperado';
    }   
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha</title>
</head>
<body>
    <link rel="stylesheet" type="text/css" href="../resources/css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
	<img class="wave" src="../resources/src/wave.png">
	<div class="container">
		<div class="img">
			<img src="../resources/src/bg.svg">
		</div>
		<div class="login-content">

            <form action="" method="post">
                <img src="../resources/src/brazil-.png">
                <h2	 class="title">Digite sua nova senha</h2>
                <div class="input-div one">
                    <div class="i">
                            <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                            <h5>Senha</h5>
                            <input type="password" class="input" name="novaSenha" id="inputPassword">
                    </div>
                </div>
                <input type="submit" class="btn" value="confirmar" type="submit" name="recuperar">
                <label class="subline"> <a href="../login">Eu sei minha senha.</a></label>
            </form>
        </div>
    </div>
    <script defer type="text/javascript" src="../resources/js/main.js"></script>
</body>
</html>