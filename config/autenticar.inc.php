<?php
    require 'db.php';
    $senha = $_GET['aut'];

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
        autenticar();
        header("Location: ../login");
        exit();
    }
    else{
        mysqli_close($conn);
        exit();
    }

    function autenticar(){
        $senha = $_GET['aut'];
        global $conn;
        $queryAut = "update `usuarios` set `autenticado`='1' where senha='".$senha."';";
        $result = mysqli_query($conn, $queryAut);
        mysqli_close($conn);
        echo 'autenticado';
    }