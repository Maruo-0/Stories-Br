<?php
    include '../config/db.php';
    //get id
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $query = 'select * from historias where id ='.$id;

    $result = mysqli_query($conn, $query);

    //fetch data
    $historia = mysqli_fetch_assoc($result);
    //var_dump($posts);

    mysqli_free_result($result);

    mysqli_close($conn);
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

<div id="mySidenav" class="sidenav" style="margin-top: 20px;"></div>


<section class="container-fluid cont-all">
    <div class="row cont-wrap">
        <div class="col-md-3 cont-in">
            <div class="cont-img">
                <img src="https://stories-br.000webhostapp.com/resources/src/caravela.jpg" class="cont-i-img">
            </div><br>
            <div class="row cont-row">
                <a href="https://stories-br.000webhostapp.com/resources/pdf/<?php echo $historia['pdf']; ?>.pdf" target="_blank"><button class="btn btn-clsm3">Leve o PDF</button></a>
                <i class="small material-icons cont-r-f" id="favorito" onclick="favoritar()">favorite_border</i>
                <!--favorite-->
                <button class="btn btn-clsm3" type="button" value="Play" id="playO">Escutar</button>
                <select id="voiceSelectionO">
                    <option value="Brazilian Portuguese Female">Português</option>
                    <!--<option value="US English Male">Inglês</option>-->
                </select>
                <a href="biblioteca.html" class="btn btn-clsm3 float-right">Voltar</a>
                <?php
                    if (isset($_SESSION['userid'])) {
                        if ($_SESSION['userid'] == 7) {//checar admin
                            echo '<a href="https://stories-br.000webhostapp.com/admin/editar.php?id='.$historia['id'].'" class="btn btn-clsm3 float-right">Editar</a>
                            
                            <form method="POST" action="https://stories-br.000webhostapp.com/biblioteca/livro.php" class="float-right">
                                <input type="hidden" name="delete_id" value='.$historia['id'].'>
                                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
                            </form>';
                        }
                    }
                    
                ?>
            </div>
        </div>
         <div class="col-md-9 cont-card">
            <h3><?php echo $historia['titulo']; ?></h3>
            <p id="textoO"><?php echo $historia['texto']; ?></p>
        </div>
    </div>
</section>
<div id="text-ptbrO" class="hidden select"><?php echo $historia['texto']; ?></div>
<div id="text-enO" class="hidden select"><?php echo $historia['textoIngles']; ?></div>


<!--Texto para voz-->
<script src="https://code.responsivevoice.org/responsivevoice.js?key=QXQuGGcR"></script>


<!--Texto para voz-->

<script>
    const texto = document.querySelector('#textoO');//texto exibido
    const ingles = document.querySelector('#text-enO');//texto inglês
    const pt = document.querySelector('#text-ptbrO');//texto português
    const voice = document.querySelector('#voiceSelectionO');//seleção de lingua
    const play = document.querySelector('#playO');//botão escutar

    //checa o estado da reprodução atual e realiza sua ação
    function tocarTexto(){
            //pega todos os campos que serão usados
    const texto = document.querySelector('#texto');//texto exibido
    const ingles = document.querySelector('#text-en');//texto inglês
    const pt = document.querySelector('#text-ptbr');//texto português
    const voice = document.querySelector('#voiceSelection');//seleção de lingua
    const play = document.querySelector('#play');//botão escutar

        if(responsiveVoice.isPlaying()){
            responsiveVoice.pause();
            play.textContent = 'Reproduzir';
        }
        else if(play.textContent === 'Reproduzir'){
            responsiveVoice.resume();
            play.textContent = 'Pausar';
        }
        else{
            setTimeout(responsiveVoice.speak(texto.textContent, voice.value), 200);
            play.textContent = 'Pausar';
        }
    }

    function trocarLingua(){
            //pega todos os campos que serão usados
    const texto = document.querySelector('#texto');//texto exibido
    const ingles = document.querySelector('#text-en');//texto inglês
    const pt = document.querySelector('#text-ptbr');//texto português
    const voice = document.querySelector('#voiceSelection');//seleção de lingua
    const play = document.querySelector('#play');//botão escutar

        if(voice.value === 'Brazilian Portuguese Female'){
            texto.innerHTML = pt.innerHTML;
        }
        else{
            texto.innerHTML = ingles.innerHTML;
        }
    }
    trocarLingua();
    
    play.addEventListener('click', e => {
        tocarTexto();
    });

    voice.addEventListener('change', e => {
        responsiveVoice.cancel();
        play.textContent = 'Escutar';

        trocarLingua();
    });
</script>
<script src="js/style.js"></script>
