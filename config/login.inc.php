<?php 
if (session_status()!==PHP_SESSION_ACTIVE)session_start();

if(isset($_GET['sair']) && $_GET['sair'] === 'true'){
    sair();
    exit();
}
if (isset($_POST['login'])) {
    $_SESSION['visitou'] = true;
    login();
    exit();
}
else {
    header("Location: ../login");
    exit();            
}


function login(){
    require 'db.php';

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (empty($email) || empty($senha)) {
        header("Location: ../login.php?error=emptyfields");
        exit();                
    }
    else {
        $sql = "select * from usuarios where email=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqlerror");
            exit();                    
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $checaSenha = password_verify($senha, $row['senha']);
                $checaautent = $row['autenticado'];
                if ($checaSenha == false) {
                    header("Location: ../login.php?error=senhaerrada");
                    exit();                    
                }
                elseif ($checaSenha == true && $checaautent == 1) {
                    session_start();
                    $_SESSION['userid'] = $row['id'];
                    $_SESSION['useremail'] = $row['email'];
                    $_SESSION['isadmin'] = $row['admin'];

                    header("Location: ../index.php?login=sucedido");
                    exit();                    
                }
                elseif($checaSenha == true && $checaautent != 1){
                    header("Location: ../login.php?error=contanaoautenticada");
                    exit();                    
                }
                else {
                    header("Location: ../login.php?error=senhaerrada");
                    exit();                    
                }
            }
            else {
                header("Location: ../login.php?error=usuarionaoexiste");
                exit();                    
    
            }
        }
    }
}

function sair(){
    session_unset();
    session_destroy();
    header("Location: /StoriesBr/");
    exit();
}