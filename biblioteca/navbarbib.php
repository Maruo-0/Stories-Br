<?php session_start();
    require('../config/db.php');

    if(isset($_POST['delete'])){
        //get form data
        $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

        $query = "delete from historias where id = {$delete_id}";
        if(mysqli_query($conn, $query)){
            header('Location: /StoriesBr/livros');
        }else{
            header("Location: livro.php?error=sqlerror");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biblioteca</title>
    <link rel="shortcut icon" type="image/png" href="/StoriesBr/resources/favicon.png"/>
    <!--CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/StoriesBr/resources/css/style.css">
    
    <link rel="manifest" href="/StoriesBr/manifest.json">
</head>
<body class="bg-img">

<nav id="nav" class="navbar sticky-top  navbar-dark bg-ligh">
    <button class="btn" id="sideMenu" type="button" onclick="openNav()">
      <span class="navbar-toggler-icon"></span>
    </button>

    <a href="/StoriesBr/">Stories <img src="/StoriesBr/img/br.svg" alt="Stores BR" id="logo" style="width: 60px"></a>
    <div>
      <form class="my-2 my-lg-0" method="POST" action="/StoriesBr/livros">
        <input class="form-controls mr-sm-2 float-right" type="text" placeholder="Pesquisar" aria-label="Pesquisar" name="search_title" id="search_title">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit" name="search" id="search">Pesquisar</button>

      </form>
    </div>
</nav>

<div id="mySidenav" class="sidenav" style="margin-top: 20px;">
    
    <?php

      if (isset($_SESSION['userid'])) {
        echo  '<form action="/StoriesBr/config/login.inc.php?sair=true" method="post">
        <button type="submit" name="logout" class="btn btn-clsm" style="margin-left: 32px;">Logout</button>
        </form>';
        echo  '<a href="/StoriesBr/usuario/perfil">Perfil</a>';


        echo  '<a href="#">Favoritos</a>';
        echo  '<a href="#">Histórico</a>';

        if ($_SESSION['isadmin'] == 2 || $_SESSION['isadmin'] === 1) {//checar admin
          echo  '<a href="/StoriesBr/admin/edicao">Criar</a>';
        }  
      }
      else{
        echo  '<a href="/StoriesBr/login">Login</a>';
      }
    ?>
    <a href="#"></a><br><br><br><br><br><br><br><br><br><hr>
    <a href="#">Compartilhe</a>
</div>
<div id="overl" class="sidenavb" onclick="closeNav()"></div>