<?php
	session_start();
    if (isset($_SESSION['userid'])) {
        header("Location: /StoriesBr/");
        exit();                    
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Entrar</title>
	<link rel="stylesheet" type="text/css" href="resources/css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
	<img class="wave" src="resources/src/wave.png">
	<div class="container">
		<div class="img">
			<img src="resources/src/bg.svg">
		</div>
		<div class="login-content">
			<form action="config/login.inc.php" method="post">
				<img src="resources/src/brazil-.png">
				<h2	 class="title">Bem vindo ao Stories Br</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>E-mail</h5>
           		   		<input type="email" class="input" name="email" id="inputEmail">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Senha</h5>
           		    	<input type="password" class="input" name="senha" id="inputPassword">
            	   </div>
            	</div>
            	<a href="#">Esqueceu a senha?</a>
				<input type="submit" class="btn" value="entrar" type="submit" name="login">
				<label class="subline"> <a href="inscricao">Não tem uma conta? Inscreva-se</a></label>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="resources/js/main.js"></script>
</body>
</html>