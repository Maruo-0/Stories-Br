<?php

if (isset($_POST['login'])) {
    
    require 'config/db.php';

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (empty($email) || empty($senha)) {
        header("Location: login.php?error=camposvazios");
        exit();                
    }
    else {
        $sql = "select * from usuarios where email=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: login.php?error=sqlerror");
            exit();                    
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $checaSenha = password_verify($senha, $row['senha']);
                if ($checaSenha == false) {
                    header("Location: login.php?error=senhaerrada");
                    exit();                    
                }
                elseif ($checaSenha == true) {
                    session_start();
                    $_SESSION['userid'] = $row['id'];
                    $_SESSION['useremail'] = $row['email'];

                    header("Location: perfil.php?login=sucedido");
                    exit();                    
                }
                else {
                    header("Location: login.php?error=senhaerrada");
                    exit();                    
                }
            }
            else {
                header("Location: login.php?error=usuarionaoexiste");
                exit();                    
    
            }
        }
    }

}
else {
    header("Location: login.html");
    exit();            
}