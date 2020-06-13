<?php include('navbarbib.php'); 
    
    $quantidade = 9;
    $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
    $inicio = ($quantidade * $pagina) - $quantidade;

    if(isset($_POST['search'])){  //PESQUISA
        $search_title = mysqli_real_escape_string($conn, $_POST['search_title']);
        $sql = "select * from historias where titulo like '%".$search_title."%' order by created_at desc limit $inicio, $quantidade";
        $query = mysqli_query($conn, $sql);
    }
    else{
        $sql = "select * from historias where aprovado like '1' order by created_at desc limit $inicio, $quantidade";
        $query = mysqli_query($conn, $sql);
    }
?>

<div id="main">
    <div class="rows padding-xl">

    <?php while($historia = mysqli_fetch_assoc($query)){?>
        <div class="col-sm-4">
                <a href="livro/<?php echo $historia['id']; ?>">
                <div class="card-b mb-5">
                    <div class="card-img-top" style="background: url(resources/src/<?php echo $historia['img_capa']; ?>) center;"></div>
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
        $sqlTotal   = "select id from historias";
        $qrTotal    = mysqli_query($conn, $sqlTotal);
        $numTotal   = mysqli_num_rows($qrTotal);
        $totalPagina= ceil($numTotal/$quantidade);

        if($totalPagina>1){
            $exibir = 3;
            $anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
            $posterior = (($pagina + 1) >= $totalPagina) ? $totalPagina : $pagina + 1;?>

    <div id="navegacao" style="background-color: white; font-size: 18px; padding: 5px 0 25px 0" class="container">
        <?php
            echo '<a href="livros">primeira</a> | ';
            echo "<a href=\"?pagina=$anterior\">anterior</a> | ";
            for($i = $pagina - $exibir; $i <= $pagina - 1; $i++){
                if($i > 0) echo '<a href="?pagina='.$i.'"> '.$i.' </a>';
            }
            echo '<a href="?pagina='.$pagina.'" style="background-color: black; color: white"><strong>'.$pagina.'</strong></a>';
            for($i = $pagina + 1; $i < $pagina + $exibir; $i++){
                if($i <= $totalPagina)
                    echo '<a href="?pagina='.$i.'"> '.$i.' </a>';
            }
            echo " | <a href=\"?pagina=$posterior\">próxima</a> | ";
            echo "  <a href=\"?pagina=$totalPagina\">última</a>";
        }
        ?>
    </div>
</div>

<script defer src="resources/js/style.js"></script>
</body>
</html>