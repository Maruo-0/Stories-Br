<?php
    session_start();

    require '../config/db.php';

    if(isset($_GET['buscarTexto'])){
        $id = mysqli_escape_string($conn, $_GET['id']);
        $lingua = mysqli_escape_string($conn, $_GET['lingua']);

        if($lingua === 'Brazilian Portuguese Female'){
            $query = "select texto from historias where id = {$id}";
            $result = mysqli_query($conn, $query);
            $result_final = mysqli_fetch_assoc($result);
            mysqli_close($conn);
            echo $result_final['texto'];
            exit();
        }else{
            $query = "select textoIngles from historias where id = {$id}";
            $result = mysqli_query($conn, $query);
            $result_final = mysqli_fetch_assoc($result);
            mysqli_close($conn);
            echo $result_final['textoIngles'];
            exit();
        }
    }
    elseif(isset($_GET['favoritar'])){
        $id = mysqli_escape_string($conn, $_GET['id']);
        $id_usuario = $_SESSION['userid'];
        $query = "insert into ler_depois (`id_historia`, `id_usuario`) VALUES ({$id}, {$id_usuario})";
        mysqli_query($conn, $query);
        exit();
    }
    elseif(isset($_GET['desfavoritar'])){
        $id = mysqli_escape_string($conn, $_GET['id']);
        $id_usuario = $_SESSION['userid'];
        $query = "delete from ler_depois where id_historia = {$id} and id_usuario = {$id_usuario}";
        mysqli_query($conn, $query);
        exit();
    }