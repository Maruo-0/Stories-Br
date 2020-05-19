<?php //composer phpmailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;//smtp nao funciona/ bloqueio de autenticacao
    use PHPMailer\PHPMailer\Exception;
    // Load Composer's autoloader
    require __DIR__ ."/vendor/autoload.php";

    define("MAIL", [
        "host" => "smtp.gmail.com",
        "port" => "587",
        "user" => "storesbrazil@gmail.com",
        "passwd" => "carolyny01",
        "from_name" => "Stories Br",
        "from_email" => "storesbrazil@gmail.com",
    ]);

    function enviar($autsenha, $nome){
        if($_GET["processo"] === 'autenticacao'){
            $_POST = $_SESSION['POST'];
            $endereço = $_POST['email'];
            $assunto = 'Ative sua conta';
            $corpo = '<div>
                    <div style="display: flex; justify-content: center; align-items: center; padding: 20px; background: #263e73;">
                        <a href="https://stories-br.000webhostapp.com/" style="display: flex; align-items: center; font-size:40px; text-decoration:none; color:white">Stories<img  width="50px" src="https://stories-br.000webhostapp.com/img/br.svg" alt="Br"></a>
                    </div>
                    <div style="margin:0 20px; padding: 25px; font-size: 1.3em; background: #f1f1f1; border-left: solid 2px; border-right: solid 2px;">
                        <p>Olá '.$nome.'</p>
                        <p>Você solicitou a autenticação da sua conta, clique no link abaixo para 
                            autenticar sua conta e poder utilizar todas as funcionalidades do Stories Br.</p>
                        <a href="http://localhost/StoriesBr/config/autenticar.inc.php?aut='.$autsenha.'"><h3>Autenticar Conta</h3></a>
                    </div>
                    <div style="padding: 10px 40px; color:white; background: #263e73;">
                        <p style="font-size: 1.1em;">Atenção: Não responda a esta mensagem. 
                            Este e-mail foi enviado por um sistema automático que não processa respostas. 
                            Para obter ajuda acesse nossa página de <a href="http://localhost/StoriesBr/fale-conosco" style="color:rgb(247, 244, 75)">Contato</a>
                            e nos deixe uma mensagem.
                        </p>
                    </div>
                </div>';
            $corpoAlt = 'link de ativação de conta http://localhost/StoriesBr/config/autenticar.inc.php?aut='.$autsenha;
            }
        elseif($_GET["processo"] === 'recuperar'){
            $endereço = $_POST["email"];
            $assunto = 'Faça sua nova senha aqui';
            $corpo = '<div>
                    <div style="display: flex; justify-content: center; align-items: center; padding: 20px; background: #263e73;">
                        <a href="https://stories-br.000webhostapp.com/" style="display: flex; align-items: center; font-size:40px; text-decoration:none; color:white">Stories<img  width="50px" src="https://stories-br.000webhostapp.com/img/br.svg" alt="Br"></a>
                    </div>
                    <div style="margin:0 20px; padding: 25px; font-size: 1.3em; background: #f1f1f1; border-left: solid 2px; border-right: solid 2px;">
                        <p>Olá '.$nome.'</p>
                        <p>Você solicitou a recuperação de senha da sua conta, clique no link abaixo para 
                            mudar sua senha e poder voltar a utilizar todas as funcionalidades do Stories Br.</p>
                        <a href="http://localhost/StoriesBr/config/recuperar.inc.php?rec='.$autsenha.'"><h3>Recuperar Senha</h3></a>
                    </div>
                    <div style="padding: 10px 40px; color:white; background: #263e73;">
                        <p style="font-size: 1.1em;">Atenção: Não responda a esta mensagem. 
                            Este e-mail foi enviado por um sistema automático que não processa respostas. 
                            Para obter ajuda acesse nossa página de <a href="http://localhost/StoriesBr/fale-conosco" style="color:rgb(247, 244, 75)">Contato</a>
                            e nos deixe uma mensagem.
                        </p>
                    </div>
                </div>';
            $corpoAlt = 'Link de nova senha http://localhost/StoriesBr/config/recuperar.inc.php?rec='.$autsenha;
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

    $usuario;
    function criarLinkAutent(){
        require 'db.php';
        global $usuario;
        if(isset($_GET["processo"]) && !isset($_POST['recuperar'])){
            $_POST = $_SESSION['POST'];
        }
        $email = $_POST['email'];

        $sql_senha = "select * from usuarios where email=?;";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql_senha);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $usuario = mysqli_fetch_assoc($result);
        mysqli_close($conn);
    }

    if(isset($_GET["processo"]) && $_GET["processo"] === 'autenticacao'){
        if (session_status()!==PHP_SESSION_ACTIVE)session_start();
        criarLinkAutent();
        $autsenha =  $usuario['senha'];
        $nome =  $usuario['nome'];
        enviar($autsenha, $nome);
        header("Location: ../inscricao");//confirme através do seu email
        exit();
    }
    elseif(isset($_GET["processo"]) && $_GET["processo"] === 'recuperar'){
        if (session_status()!==PHP_SESSION_ACTIVE)session_start();
        $_SESSION['POST'] = $_POST;
        criarLinkAutent();
        $autsenha =  $usuario['senha'];
        $nome =  $usuario['nome'];
        enviar($autsenha, $nome);
        header("Location: ../login?senha=esqueceu");//confirme através do seu email
        exit();
    }?>