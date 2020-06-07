<?php
session_start();
require 'config/db.php';

if(isset($_POST['login'])){
    login();
    exit();
}
elseif(isset($_POST['cadastrar'])){
    cadastrar();
    exit();
}
elseif(isset($_POST['mudar_senha'])){
    mudarSenha();
    exit();
}
else if(isset($_POST['mensagem'])){
    enviarFeedback();
    exit();
}
else if(isset($_POST['avaliar'])){
    enviarAvaliação();
    exit();
}

function login(){
    global $conn;

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
                    echo 'autenticar';
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
    global $conn;

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senhaRep = $_POST['senha-rep'];
    $admin = 0;
    $autenticado = 1;

    if (empty($nome) || empty($email) || empty($senha) || empty($senhaRep)) {
        echo 'erro';
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'erro';
        exit();
    }
    elseif ($senha !== $senhaRep) {
        echo 'erro';
        exit();
    }
    else {
        $sql = "select email from usuarios where email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'erro';
            exit();    
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                echo 'erro';
                exit();        
            }
            else {
                $sql = "insert into usuarios (nome, email, senha, admin, autenticado) values (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo 'erro';
                    exit();    
                }
                else {
                    $hashedSenha = password_hash($senha, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sssss", $nome, $email, $hashedSenha, $admin, $autenticado);
                    mysqli_stmt_execute($stmt);

                    
                    if (session_status()!==PHP_SESSION_ACTIVE){
                        session_start();
                        $_SESSION['POST'] = $_POST;
                    }
                    echo 'cadastrado';
                    //header("Location: https://stories-br.000webhostapp.com/config/email.inc.php?processo=autenticacao");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
function mudarSenha(){
    global $conn;

    $senha_atual = $_POST['senha_atual'];
    $senha_nova = $_POST['senha_nova'];
    $id = $_POST['userid'];

    $sql = "select * from usuarios where id=?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        if(password_verify($senha_atual, $row['senha'])){
            $hashedSenha = password_hash($senha_nova, PASSWORD_DEFAULT);
            $queryAut = "update `usuarios` set `senha`='".$hashedSenha."' where id=".$id.";";
            $result = mysqli_query($conn, $queryAut);
            echo 'sucesso';
            exit();
        }
        else echo 'erro';
        exit();
    }
    else{
        echo 'erro';
        exit();
    } 
}
function enviarFeedback(){
    global $conn;
    $assunto = 'app';
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mensagem = mysqli_real_escape_string($conn, $_POST['mens']);
    $query = "insert into `mensagens` (`assunto`, `nome`, `email`, `mens`, `salvar`) values ('$assunto', '$nome', '$email', '$mensagem', '0')";
    if(mysqli_query($conn, $query)){
        echo 'enviado';
        mysqli_close($conn);
        exit();
    }else{
        echo 'erro';
        exit();
    }
}
function enviarAvaliação(){
    global $conn;

    $avaliacao = $_POST['avaliacao'];
    if($avaliacao === 'gostei') $avaliacao = 1;
    else $avaliacao = 0;
    $userid = $_POST['userid'];

    if($_POST['mudar'] === 'true'){
        $query = "update `app_avaliacao` set `avaliacao`='$avaliacao' where `id_usuario`='$userid'";
        if(mysqli_query($conn, $query)){
            echo 'enviado';
            mysqli_close($conn);
            exit();
        }else{
            echo 'erro';
            exit();
        }
    }
    else if($userid === 'null'){
        $query = "insert into `app_avaliacao` (`avaliacao`) values ('$avaliacao')";
        if(mysqli_query($conn, $query)){
            echo 'enviado';
            mysqli_close($conn);
            exit();
        }else{
            echo 'erro';
            exit();
        }
    }
    else{
        $query = "insert into `app_avaliacao` (`avaliacao`, `id_usuario`) values ('$avaliacao', '$userid')";
        if(mysqli_query($conn, $query)){
            echo 'enviado';
            mysqli_close($conn);
            exit();
        }else{
            echo 'erro';
            exit();
        }
    }
}