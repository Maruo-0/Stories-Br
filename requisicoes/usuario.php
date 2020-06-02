<?php
session_start();

if(isset($_POST['login'])){
    login();
}
elseif(isset($_POST['cadastrar'])){
    cadastrar();
}

function login(){
    require 'config/db.php';

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (empty($email) || empty($senha)) {
        echo 'erro';
        exit();                
    }
    else {
        $sql = "select * from usuarios where email=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'erro';
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
                    echo 'erro';
                    exit();                    
                }
                elseif ($checaSenha == true && $checaautent == 1) {
                    $array = array(
                        "usuarioId" => "{$row['id']}",
                        "usuarioNome" => "{$row['nome']}",
                        "usuarioEmail" => "{$row['email']}",
                        "usuarioImg" => "{$row['img_user']}",
                    );
                    $array = json_encode($array);
                    echo $array;
                    exit();                    
                }
                elseif($checaSenha == true && $checaautent != 1){
                    echo 'erro';
                    exit();                    
                }
                else {
                    echo 'erro';
                    exit();                    
                }
            }
            else {
                echo 'erro';
                exit();                    
            }
        }
    }
}
function cadastrar(){
    require 'config/db.php';

}