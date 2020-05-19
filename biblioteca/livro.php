<?php include('navbarbib.php'); 
if(isset($_SESSION['userid'])){
    $query_favorito = "select count(*) from ler_depois where id_historia = {$historia['id']} and id_usuario = {$_SESSION['userid']}";
    $resultado_favorito = mysqli_query($conn, $query_favorito);
    $result_final = mysqli_fetch_assoc($resultado_favorito);
}
mysqli_close($conn); ?>

<section class="container-fluid cont-all">
    <div class="row cont-wrap">
        <div class="col-md-3 cont-in">
            <div class="cont-img">
                <img src="../resources/src/<?php echo $historia['img_capa'] ?>" class="cont-i-img">
            </div>
            <div class="row cont-row">
                <a href="../resources/pdf/<?php echo $historia['pdf'] ?>" target="_blank"><button class="btn btn-clsm3">Leve o PDF</button></a>
                <?php if(isset($_SESSION['userid'])){
                    echo '<i title="Favoritar" class="small material-icons cont-r-f" id="favorito" onclick="favoritar()">';
                    if($result_final['count(*)'] > 0) echo '<div id="0"></div>star';
                    else echo '<div id="'.$historia['id'].'"></div>star_border';
                    echo '</i>';
                }?>
                <button class="btn btn-clsm3" type="button" value="Play" id="play">Escutar</button>
                <select id="voiceSelection" class="selection">
                    <option value="Brazilian Portuguese Female">Português</option>
                    <option value="US English Male">Inglês</option>
                </select>
                <select id="themeSelection" class="selection">
                    <option value="light">Claro</option>
                    <option value="dark">Escuro</option>
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
            <div class="fonte">
                <i title="Diminuir" class="small material-icons" id="diminuir">remove</i>
                <div>Fonte</div>
                <i title="Aumentar" class="small material-icons" id="aumentar">add</i>
            </div>
        </div>
         <div class="col-md-9 cont-card">
            <div class="id" id="<?php echo $historia['id']; ?>"></div>
            <div id="texto"></div>
            <button class="btn btn-danger" type="button" value="<?php echo $historia['id']; ?>" id="reportar">Reportar erro</button>
        </div>
    </div>
</section>

<script>
    const reportarBtn = document.querySelector('#reportar')
    const titulo = '<?php echo trim($historia['titulo'], '<p></p>'); ?>'
    reportarBtn.addEventListener('click', () =>{
        localStorage.setItem("id", reportarBtn.value);
        localStorage.setItem("titulo", titulo);
        window.location.href = '../fale-conosco'
    })

    const diminuir = document.querySelector('#diminuir')
    const aumentar = document.querySelector('#aumentar')
    let fontSize = 15
    let size = 3
    diminuir.onclick = () => {
        const fonte = document.querySelectorAll('#texto p')
        fontSize = fontSize-size
        fonte.forEach(font => {
            font.style.fontSize = fontSize+'px'
        });
    }
    aumentar.onclick = () => {
        const fonte = document.querySelectorAll('#texto p')
        fontSize = fontSize+size
        fonte.forEach(font => {
            font.style.fontSize = fontSize+'px'
        });
    }
</script>

<!--Texto para voz-->
<script src="https://code.responsivevoice.org/responsivevoice.js?key=QXQuGGcR"></script>

<script>
    //pega todos os campos que serão usados
    const texto = document.querySelector('#texto');//texto exibido
    const id = document.querySelector('.id').id
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
            buscarTexto(id, voice.value)
        }
        else{
            buscarTexto(id, voice.value)
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

    function CriaRequest() {
        try{
            request = new XMLHttpRequest();        
        }catch (IEAtual){
            
            try{
                request = new ActiveXObject("Msxml2.XMLHTTP");       
            }catch(IEAntigo){
            
                try{
                    request = new ActiveXObject("Microsoft.XMLHTTP");          
                }catch(falha){
                    request = false;
                }
            }
        }
        
        if (!request) {
            alert("Seu Navegador não suporta Ajax!");
        }
        else return request;
    }
    function buscarTexto(id, lingua){
        url = '../biblioteca/funcoes-leitura.php?buscarTexto=true&id='+id+'&lingua='+lingua
        const xmlreq = CriaRequest();
        xmlreq.open("GET", url, true);
        xmlreq.onreadystatechange = function(){
            if (xmlreq.readyState == 4) {
                if (xmlreq.status == 200) {
                    texto.innerHTML =  xmlreq.responseText
                }else{
                    console.log('erro')
                }
            }
        }
        xmlreq.send(null);
    }

</script>
<script>
    const themeSelection = document.querySelector('#themeSelection')
    const body = document.body
    themeSelection.addEventListener('change', salvarTema)
    const theme = localStorage.getItem('theme');
    if (theme) {
        body.classList.add(theme);
        if(theme === 'light'){
            themeSelection.selectedIndex = [0]
        }
        else{
            themeSelection.selectedIndex = [1]
        }
    }

    function salvarTema(){
        if(themeSelection.value === 'light'){
            body.classList.replace('dark', 'light');
            localStorage.setItem('theme', 'light');
        }
        else{
            body.classList.replace('light', 'dark');
            localStorage.setItem('theme', 'dark');
        }
    }
</script>
<!--Texto para voz-->

<script defer src="../resources/js/style.js"></script>
</body>
</html>