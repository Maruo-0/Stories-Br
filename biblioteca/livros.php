<?php include('navbarbib.php'); 

    //A quantidade de valor a ser exibida
    $quantidade = 9;
    //a pagina atual
    $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
    //Calcula a pagina de qual valor será exibido
    $inicio = ($quantidade * $pagina) - $quantidade;


    if(isset($_POST['search'])){  //PESQUISA
        $search_title = mysqli_real_escape_string($conn, $_POST['search_title']);

        $sql = "select * from historias where titulo like '%".$search_title."%' order by created_at desc limit $inicio, $quantidade";

        $query = mysqli_query($conn, $sql);
    }
    else{
        //Monta o SQL com LIMIT para exibição dos dados  
        $sql = "select * from historias where aprovado like '1' order by created_at desc limit $inicio, $quantidade";
        //Executa o SQL
        $query = mysqli_query($conn, $sql);
    }
?>



<div id="main">
    <div class="rows padding-xl">

    <?php while($historia = mysqli_fetch_assoc($query)){?>
        <div class="col-sm-4">
                <a href="livro/<?php echo $historia['id']; ?>">
                <div class="card-b mb-5">
                    <img src="resources/src/<?php echo $historia['img_capa']; ?>" class="card-img-top" width="300px">
                    <div class="card-body">
                        <div class="card-title formatar-titulo"><p><?php echo $historia['titulo']; ?></p></div>
                        <div class="card-title formatar-desc"><p><?php echo $historia['desc']; ?></p></div>
                        <div class="card-title formatar-data"><p><?php $data = $historia['created_at']; echo 'Postado em: '.date('d/m/Y',strtotime($data)) ?></p></div>
                    </div>
                </div></a>
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

<script>
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('/StoriesBr/service-worker.js')
        .then(function () {
          console.log('service worker registered');
        })
        .catch(function () {
          console.warn('service worker failed');
        });
    }
</script>

<script defer src="/StoriesBr/resources/js/style.js"></script>
</body>
</html>