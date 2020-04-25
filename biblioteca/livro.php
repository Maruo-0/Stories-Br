<?php include('navbarbib.php'); ?>
   
<?php

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


<section class="container-fluid cont-all">
    <div class="row cont-wrap">
        <div class="col-md-3 cont-in">
            <div class="cont-img">
                <img src="../resources/src/<?php echo $historia['img_capa']; ?>" class="cont-i-img">
            </div><br>
            <div class="row cont-row">
                <a href="../resources/pdf/<?php echo $historia['pdf']; ?>" target="_blank"><button class="btn btn-clsm3">Leve o PDF</button></a>
                <i class="small material-icons cont-r-f" id="favorito" onclick="favoritar()">favorite_border</i>
                <!--favorite-->
                <button class="btn btn-clsm3" type="button" value="Play" id="play">Escutar</button>
                <select id="voiceSelection">
                    <option value="Brazilian Portuguese Female">Português</option>
                    <option value="US English Male">Inglês</option>
                </select>
                <a href="../livros" class="btn btn-clsm3 float-right">Voltar</a>
                <?php
                    if (isset($_SESSION['userid'])) {
                        if($_SESSION['isadmin'] == 2 || $_SESSION['userid'] === $historia['criador_id']){
                            echo '<a href="../admin/edicao.php?id='.$historia['id'].'" class="btn btn-clsm3 float-right">Editar</a>
                            
                            <form method="POST" action="" class="float-right">
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
            <p id="texto"></p>
        </div>
    </div>
</section>
<div id="text-ptbr" class="hidden select"><?php echo $historia['texto']; ?></div>
<div id="text-en" class="hidden select"><?php echo $historia['textoIngles']; ?></div>

<!--Texto para voz-->
<script src="https://code.responsivevoice.org/responsivevoice.js?key=QXQuGGcR"></script>

<script>
    //pega todos os campos que serão usados
    const texto = document.querySelector('#texto');//texto exibido
    const ingles = document.querySelector('#text-en');//texto inglês
    const pt = document.querySelector('#text-ptbr');//texto português
    const voice = document.querySelector('#voiceSelection');//seleção de lingua
    const play = document.querySelector('#play');//botão escutar
    
    //checa o estado da reprodução atual e realiza sua ação
    function tocarTexto(){
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

<!--Texto para voz-->

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

<script src="/StoriesBr/resources/js/style.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>