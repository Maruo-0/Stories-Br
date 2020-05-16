<?php session_start();
    if(!isset($_SESSION['userid'])){
        header("Location: /StoriesBr/");
        exit();
    }

    require('../config/db.php'); 

    //A quantidade de valor a ser exibida
    $quantidade = 9;
    //a pagina atual
    $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
    //Calcula a pagina de qual valor será exibido
    $inicio = ($quantidade * $pagina) - $quantidade;


    $sql = "select * from ler_depois where id_usuario = {$_SESSION['userid']}  order by created_at desc limit $inicio, $quantidade";
    $query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="manifest.json">
    <link rel="shortcut icon" type="image/png" href="resources/favicon.png"/>
    <title>Favoritos - Stories Br</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="resources/css/style.css">
</head>
<body class="bg-img">
    <nav id="nav" class="navbar sticky-top  navbar-dark bg-ligh">
        <button class="btn" id="sideMenu" type="button" onclick="openNav()">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a href="/StoriesBr/" id="logo">Stories <img src="resources/src/br.svg" alt="Stories BR" style="width: 60px"></a>
        <div>
            <form class=" my-lg-0" method="POST" action="livros">
            <input class="form-controls mr-sm-2 float-right" type="text" placeholder="..." aria-label="Pesquisar" name="search_title" id="search_title">
            <button class="btn btn-secondary my-sm-0" type="submit" name="search" id="search">Pesquisar</button>
            </form>
        </div>
    </nav>

    <div id="mySidenav" class="sidenav" style="margin-top: 20px;">
        <?php
            echo  '<form action="config/login.inc.php?sair=true" method="post">
            <button type="submit" name="logout" class="btn btn-danger" style="margin-left: 32px;">Logout</button>
            </form>
            <a href="perfil">Perfil</a>
            <a href="livros">Biblioteca</a>';

            if ($_SESSION['isadmin'] === 2 || $_SESSION['isadmin'] === 1) {//checar admin
                if ($_SESSION['isadmin'] === 2) echo  '<a href="admin/paineladmin">Painel Admin</a>';

                echo  '<a href="admin/edicao">Criar</a>';
            }  
        ?>
        <br><br><br><hr>
        <a href="#">Compartilhe</a><br><br>
    </div>
    <div id="overl" class="sidenavb" onclick="closeNav()"></div>


    <div id="main">
        <div class="rows padding-xl">

        <?php while($favorito = mysqli_fetch_assoc($query)){            
            $sql_historia = "select * from historias where id = {$favorito['id_historia']}";
            $query_historia = mysqli_query($conn, $sql_historia);
            $historia = mysqli_fetch_assoc($query_historia)?>
            
            <div class="col-sm-4">
                <a href="livro/<?php echo $historia['id']; ?>">
                    <div class="card-b mb-5">
                        <img src="resources/src/<?php echo $historia['img_capa']; ?>" class="card-img-top" width="300px">
                        <div class="card-body">
                            <div class="card-title formatar-titulo"><p><?php echo $historia['titulo']; ?></p></div>
                            <div class="card-title formatar-desc"><p><?php echo $historia['desc']; ?></p></div>
                            <div class="card-title formatar-data"><p><?php $data = $historia['created_at']; echo 'Postado em: '.date('d/m/Y',strtotime($data)) ?></p></div>
                        </div>
                    </div>
                </a>
            </div>
        <?php }
            if(mysqli_num_rows($query) === 0){
                echo '<h2>Nenhum favorito encrontado...</h2>';
            }
        ?>
        </div><br><center>
        <?php
            //SQL para saber o total
            $sqlTotal   = "select id from historias";
            //Executa o SQL
            $qrTotal    = mysqli_query($conn, $sqlTotal);
            //Total de Registro na tabela
            $numTotal   = mysqli_num_rows($qrTotal);
            //O calculo do Total de página ser exibido
            $totalPagina= ceil($numTotal/$quantidade);

            if($totalPagina>1){
                //Defini o valor máximo a ser exibida na página tanto para direita quando para esquerda
                $exibir = 3;
                /**
                    * Aqui montará o link que voltará uma pagina
                    * Caso o valor seja zero, por padrão ficará o valor 1
                    */
                $anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
                /**
                    * Aqui montará o link que ir para proxima pagina
                    * Caso pagina +1 for maior ou igual ao total, ele terá o valor do total
                    * caso contrario, ele pegar o valor da página + 1
                    */
                $posterior = (($pagina + 1) >= $totalPagina) ? $totalPagina : $pagina + 1;?>

                <div id="navegacao" style="background-color: white; font-size: 18px; padding: 5px 0 25px 0" class="container">
                <?php //links da primeira página e da anterior
                    echo '<a href="livros">primeira</a> | ';
                    echo "<a href=\"?pagina=$anterior\">anterior</a> | ";

                    //O loop para exibir os valores à esquerda
                    for($i = $pagina - $exibir; $i <= $pagina - 1; $i++){
                        if($i > 0)
                            echo '<a href="?pagina='.$i.'"> '.$i.' </a>';
                    }

                    //Link da página atual
                    echo '<a href="?pagina='.$pagina.'" style="background-color: black; color: white"><strong>'.$pagina.'</strong></a>';

                    //O loop para exibir os valores à direita
                    for($i = $pagina + 1; $i < $pagina + $exibir; $i++){
                        if($i <= $totalPagina)
                            echo '<a href="?pagina='.$i.'"> '.$i.' </a>';
                    }

                    //links da proxima e ultima página
                    echo " | <a href=\"?pagina=$posterior\">próxima</a> | ";
                    echo "  <a href=\"?pagina=$totalPagina\">última</a>";
            }
        ?>
        </div>
    </div>    
    
    <script defer src="resources/js/style.js"></script>
</body>
</html>