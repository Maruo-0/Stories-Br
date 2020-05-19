<?php
	session_start();
    if (isset($_SESSION['userid'])) {
        header("Location: /StoriesBr/");
        exit();                    
    }
?>

<!DOCTYPE html>
<html  lang="pt-BR">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" type="image/png" href="resources/favicon.png"/>
  <link rel="manifest" href="manifest.json"> 
	<title>Entrar - Stories Br</title>
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

			<?php
				if(isset($_SESSION['POST'])){
					$_POST = $_SESSION['POST'];
					echo '<form>
						<img src="resources/src/brazil-.png">
						<h4 class="title">Email de recuperação enviado enviado para '.$_POST['email'].' Pode demorar alguns minutos</h4>
						<input type="submit" href"login" class="btn" value="voltar">
						</form>
						</div>
						</div>
						<script defer type="text/javascript" src="resources/js/main.js"></script>
					</body>
					</html>';
					session_unset();
					session_destroy();				
					exit();
				}

				if(isset($_GET['senha'])){
					echo '<form action="config/email.inc.php?processo=recuperar" method="post">
						<img src="resources/src/brazil-.png">
						<h2	 class="title">Recuperar senha?</h2>
						<div class="input-div one">
						<div class="i">
								<i class="fas fa-user"></i>
						</div>
						<div class="div">
								<h5>E-mail</h5>
								<input type="email" class="input" name="email" id="inputEmail">
						</div>
						</div>
						<input type="submit" class="btn" value="enviar" name="recuperar">
						<label class="subline"> <a href="login">Eu sei minha senha.</a></label>
						</form>
						</div>
						</div>
						<script defer type="text/javascript" src="resources/js/main.js"></script>
					</body>
					</html>';
					exit();
				}
			?>

			<form action="config/login.inc.php" method="post">
				<img src="resources/src/brazil-.png">
				<h2	 class="title">Bem vindo ao Stories Br</h2>
				<?php
					if (session_status()!==PHP_SESSION_ACTIVE)session_start();
					if(isset($_SESSION['RECUPERAR'])){
						echo '<h4>Senha recuperada</h4>';
					}
					session_unset();
					session_destroy();
				?>
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
            	<a href="?senha=esqueceu">Esqueceu a senha?</a>
				<input type="submit" class="btn" value="entrar" name="login">
				<label class="subline"> <a href="inscricao">Não tem uma conta? Inscreva-se</a></label>
            </form>
        </div>
    </div>
    <script defer type="text/javascript" src="resources/js/main.js"></script>
</body>
</html>