<?php session_start();
    require('../config/db.php');

    if(isset($_POST['delete'])){
        //get form data
        $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

        $query = "delete from historias where id = {$delete_id}";
        if(mysqli_query($conn, $query)){
            header('Location: https://stories-br.000webhostapp.com/biblioteca/livros');
        }else{
            header("Location: livro.php?error=sqlerror");
            exit();
        }
    }
?>

<nav id="nav" class="navbar sticky-top  navbar-dark bg-ligh">
    <button class="btn" id="sideMenu" type="button" onclick="openNav()">
      <span class="navbar-toggler-icon"></span>
    </button>

    <a href="index.html">Stories <img src="https://stories-br.000webhostapp.com/img/br.svg" alt="Stores BR" id="logo" style="width: 60px"></a>
    <div>
      <form class="my-2 my-lg-0" method="POST" action="https://stories-br.000webhostapp.com/biblioteca/pesquisa">
        <input class="form-controls mr-sm-2 float-right" type="text" placeholder="Pesquisar" aria-label="Pesquisar" name="search_title" id="search_title">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit" name="search" id="search">Pesquisar</button>

      </form>
    </div>
</nav>

<div id="mySidenav" class="sidenav" style="margin-top: 20px;">
    
    <?php

      if (isset($_SESSION['userid'])) {
        echo  '<form action="https://stories-br.000webhostapp.com/config/logout.inc.php" method="post">
        <button type="submit" name="logout" class="btn btn-clsm" style="margin-left: 32px;">Logout</button>
        </form>';
        echo  '<a href="https://stories-br.000webhostapp.com/usuario/perfil">Perfil</a>';


        echo  '<a href="#">Favoritos</a>';
        echo  '<a href="#">Histórico</a>';

        if ($_SESSION['userid'] == 7) {//checar admin
          echo  '<a href="https://stories-br.000webhostapp.com/admin/criar">Criar</a>';
        }  
      }
      else{
        echo  '<a href="https://stories-br.000webhostapp.com/login">Login</a>';
      }
    ?>
    <a href="#"></a><br><br><br><br><br><br><br><br><br><hr>
    <a href="#">Compartilhe</a>
</div>
<div id="overl" class="sidenavb" onclick="closeNav()"></div>

<?php

    //A quantidade de valor a ser exibida
    $quantidade = 9;
    //a pagina atual
    $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
    //Calcula a pagina de qual valor será exibido
    $inicio = ($quantidade * $pagina) - $quantidade;

    //Monta o SQL com LIMIT para exibição dos dados  
    $sql = "select * from historias order by created_at desc limit $inicio, $quantidade";
    //Executa o SQL
    $query = mysqli_query($conn, $sql);

?>

<div id="main">
    <div class="rows padding-xl">

    <?php while($historia = mysqli_fetch_assoc($query)){?>
        <div class="col-sm-4" onclick="abrirLivro()" style="cursor:pointer;">
            <div class="hidden" id="idid"><?php echo $historia['id']; ?></div>
                <div class="card-b mb-5">
                    <img src="https://stories-br.000webhostapp.com/resources/src/caravela.jpg" class="card-img-top" width="300px">
                    <div class="card-body">
                        <div class="card-title formatar-titulo"><p><?php echo $historia['titulo']; ?></p></div>
                        <div class="card-title formatar-desc"><p><?php echo $historia['desc']; ?></p></div>
                        <div class="card-title formatar-data"><p><?php echo $historia['created_at']; ?></p></div>
                    </div>
                </div>
            </div>

    <?php }?>
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
        echo '<a href="?pagina=1">primeira</a> | ';
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
    ?>
    </div>

</div>