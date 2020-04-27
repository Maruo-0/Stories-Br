<?php //composer phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;//smtp nao funciona/ bloquio de autenticacao
use PHPMailer\PHPMailer\Exception;
// Load Composer's autoloader
require __DIR__ ."/vendor/autoload.php";

define("MAIL", [
    "host" => "smtp.gmail.com",
    "port" => "587",
    "user" => "zeronsama5@gmail.com",
    "passwd" => "159+357456",
    "from_name" => "marcelo",
    "from_email" => "zeronsama5@gmail.com",
]);

///passar as varieaveis dentro da () da função
function enviar(string $autsenha){
    if($_GET["processo"] === 'autenticacao'){
        $_POST = $_SESSION['POST'];
        $endereço = $_POST['email'];
        //$endereço = 'marceloescobarjunior@gmail.com';
        $assunto = 'Ative sua conta';
        $corpo = '<h2>link de ativação de conta</h2> <a href="http://localhost/StoriesBr/config/autenticar.inc.php?aut='.$autsenha.'">autenticar</a>';
        $corpoAlt = 'link de ativação de conta';
        }
    elseif($_GET["processo"] === 'recuperar'){
        $endereço = $_POST["email"];
        $assunto = 'Faça sua nova senha aqui';
        $corpo = '<h2>link de nova senha</h2> <a href="http://localhost/StoriesBr/config/recuperar.inc.php?rec='.$autsenha.'">trocar senha</a>';
        $corpoAlt = 'Link de nova senha';
    }
    
    $mail = new PHPMailer(true);

    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Enable verbose debug output
    $mail->isSMTP();     // Send using SMTP
    $mail->Host       = MAIL["host"]; // Set the SMTP server to send through
    $mail->Port       = MAIL["port"];   // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->SMTPAuth   = true;   // Enable SMTP authentication
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->SMTPSecure = 'tls';
    $mail->CharSet = 'UTF-8';
    $mail->Username   = MAIL["user"];     // SMTP username
    $mail->Password   = MAIL["passwd"];  // SMTP password

    try {
        // From email address and name
        $mail->setFrom(MAIL["from_email"], MAIL["from_name"]);
    
        // To email addresss
        $mail->addAddress($endereço);   // Add a recipient
        $mail->addReplyTo(MAIL["from_email"], 'Reply'); // Recipent reply address
    
        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = $assunto;
        $mail->Body    = $corpo;
        $mail->AltBody = $corpoAlt;
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

$senha;
function criarLinkAutent(){
    require 'db.php';
    global $senha;
    if(isset($_GET["processo"]) && !isset($_POST['recuperar'])){
        $_POST = $_SESSION['POST'];
    }
    $email = $_POST['email'];

    $sql = "select * from usuarios where email=?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $senha = mysqli_fetch_assoc($result);
    mysqli_close($conn);
}
//criarLinkAutent();
//echo $senha['senha'] .'<br>';
//$autsenha =  $senha['senha'];
//echo $autsenha;

if(isset($_GET["processo"]) && $_GET["processo"] === 'autenticacao'){
    if (session_status()!==PHP_SESSION_ACTIVE)session_start();
    criarLinkAutent();
    $autsenha =  $senha['senha'];
    enviar($autsenha);
    header("Location: ../inscricao");//confirme através do seu email
    exit();
}
elseif(isset($_GET["processo"]) && $_GET["processo"] === 'recuperar'){
    if (session_status()!==PHP_SESSION_ACTIVE)session_start();
    $_SESSION['POST'] = $_POST;
    criarLinkAutent();
    $autsenha =  $senha['senha'];
    enviar($autsenha);
    header("Location: ../login?senha=esqueceu");//confirme através do seu email
    exit();
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="email.inc.php?processo=autenticacao" method="post">
        <button type="submit" name="autenticacao" >autenticacao</button>
    </form>
    <form action="email.inc.php?processo=recuperar" method="post">
        <button type="submit" name="recuperar" >recuperar</button>
    </form>
</body>
</html>