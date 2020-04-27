<?php

if (isset($_POST['registrar'])) {
    
    require('db.php');
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senhaRep = $_POST['senha-rep'];
    $admin = 0;
    $autenticado = 0;

    if (empty($nome) || empty($email) || empty($senha) || empty($senhaRep)) {
        header("Location: ../inscricao.php?error=camposvazios&nome=".$nome."&email=".$email);
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../inscricao.php?error=emailinvalido&nome=".$nome);
        exit();
    }
    elseif ($senha !== $senhaRep) {
        header("Location: ../inscricao.php?error=senhasdiferentes&nome=".$nome."&email=".$email);
        exit();
    }
    else {
        $sql = "select email from usuarios where email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../inscricao.php?error=sqlerror1");
            exit();    
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../inscricao.php?error=emailjautilizado&nome=".$nome);
                exit();        
            }
            else {
                $sql = "insert into usuarios (nome, email, senha, admin, autenticado) values (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../inscricao.php?error=sqlerror");
                    exit();    
                }
                else {
                    $hashedSenha = password_hash($senha, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sssss", $nome, $email, $hashedSenha, $admin, $autenticado);
                    mysqli_stmt_execute($stmt);

                    
                    if (session_status()!==PHP_SESSION_ACTIVE){
                        session_start();
                        $_SESSION['POST'] = $_POST;///////direcionar pra pagina 
                    }


                    //header("Location: login.inc.php");
                    //header("Location: ../inscricao");//confirme através do seu email
                    header("Location: email.inc.php?processo=autenticacao");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
    header("Location: ../inscricao");
    exit();            
}