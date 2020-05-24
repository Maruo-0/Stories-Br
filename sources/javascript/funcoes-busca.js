/// a ordem é importante 
/// qualquer mudança pode quebrar o código
const urlFinal = 'https://stories-br.000webhostapp.com/'

let quantidade = 9;
if(document.documentElement.clientHeight > 700){
    quantidade = 12;
}
let pagina = 1;   /// dados a ser enviado na busca dos artigos
let inicio = null;

let valorProcurar = undefined ///usado no procurarConteudo()
const usuarioId = localStorage.getItem('usuarioId') ///usado no procurarFavoritos()

//checa a url por parametros e prepara as seguintes ações
const urlParams = new URLSearchParams(window.location.search)
if(!urlParams.has('artigo') && !urlParams.has('favoritos')){
    window.onscroll = () =>{
        const { clientHeight, scrollHeight, scrollTop } = document.documentElement
        let progresso = Math.abs((scrollTop / (clientHeight - scrollHeight)) * 100)
        if(progresso > 99.999){
            procurarConteudo(undefined)
        }                
    }
    procurarConteudo(undefined)
}
else if(urlParams.has('artigo')){
    procurarArtigo()
    /// funcao da barra de progresso
    window.onscroll = () =>{
        const { clientHeight, scrollHeight, scrollTop } = document.documentElement

        let progresso = Math.abs((scrollTop / (clientHeight - scrollHeight)) * 100)
        //console.log(progresso);
        document.querySelector('.barra-progresso').style.width = progresso+'%'
    }
    mudarLingua()
}
else if(urlParams.has('favoritos')) procurarConteudo('favoritos', null)


// eventos que leva de volta pra pag correta
document.querySelector('#voltar').onclick = () => {
    const urlParams = new URLSearchParams(window.location.search)
    if(urlParams.has('favoritos') && urlParams.has('artigo')) window.location.href = '?favoritos=true'
    else if(urlParams.has('artigo')) window.location.href = '?'
    else if(urlParams.has('favoritos')) window.location.href = '?'
    else window.location.href = 'app.html'
}


// abre a barra de pesquisa e depois pesquisa
let procurar = false
const botaoProcurar = document.querySelector('#botaoProcurar').onclick = () =>{
    if(urlParams.has('artigo')){
        window.location.href = '?'
    }

    const inputProcurar = document.querySelector('#inputProcurar')
    console.log()
    if(!procurar){
        inputProcurar.classList.remove('hidden')
        inputProcurar.focus()
        procurar = true
    }
    else {
        console.log(inputProcurar.value)
        valorProcurar = inputProcurar.value
        pagina = 1
        procurarConteudo(null, valorProcurar)
    }
}
function limparPesquisa(){
    window.location.href = '?'
}

// eventos de clique que direciona pra url adequada
const artigos = document.querySelector('#artigos')
artigos.onclick = event =>{
    //console.log(event.target.parentNode.parentNode.parentNode.classList.value);
    
    if(event.target.parentNode.parentNode.id === 'favoritosBox' && event.target.parentNode.classList.value == 'livro-card'){
        sessionStorage.setItem('id', event.target.parentNode.id)
        window.location.href = '?favoritos=true&artigo='+event.target.parentNode.id
    }
    else if(event.target.parentNode.parentNode.parentNode.classList.value == 'livro-card'){
        sessionStorage.setItem('id', event.target.parentNode.parentNode.parentNode.id)
        window.location.href = '?artigo='+event.target.parentNode.parentNode.parentNode.id
    }
    else if(event.target.parentNode.classList.value == 'livro-card'){
        sessionStorage.setItem('id', event.target.parentNode.id)
        window.location.href = '?artigo='+event.target.parentNode.id
    }

}


// traz os favoritos se o usuario estiver logado
const botaoFavoritos = document.querySelector('.buscar-favoritos')
/////
if(usuarioId){
    if(!urlParams.has('favoritos')){
        botaoFavoritos.classList.remove('hidden')
        botaoFavoritos.onclick = () =>{
            window.location.href = '?favoritos=true'
        }
    } 
}

// define o tema a ser mostrado na tela de leitura
function mudarTema(){
    const tema = localStorage.getItem('tema')
    const temaSelect = document.querySelector('#tema')
    if(tema){
        document.querySelector('body').classList.add(tema)
        temaSelect.value = tema
    }
    else{
        document.querySelector('body').classList.add('claro')
        temaSelect.value = tema 
    }
    temaSelect.onchange = () =>{
        localStorage.setItem('tema', temaSelect.value)
    }
}
mudarTema()


//envia os dados do artigo a ser favoritado ou desfavoritado
document.querySelector('#favoritar').onclick = () =>{
    let artigoId = sessionStorage.getItem('id')
    let favoritos = localStorage.getItem('favoritos')
    if(favoritos){
        let favoritosArray = favoritos.split(",")
        //console.log(favoritosArray);

        if(!favoritosArray.includes(artigoId)){
            favoritosArray.push(artigoId)
            console.log(favoritosArray+' adicionar');
            enviarDadosFavoritos('favoritar')
            document.querySelector('#favoritar').classList.replace('far', 'fas')
        }
        else{
            favoritosArray.splice(favoritosArray.indexOf(artigoId), 1)
            console.log(favoritosArray+' remover');
            enviarDadosFavoritos('desfavoritar')
            document.querySelector('#favoritar').classList.replace('fas', 'far')
        }
        let favoritosString = favoritosArray.toString()
        localStorage.setItem('favoritos', favoritosString)
    }
}
function enviarDadosFavoritos(estado){
    const artigoId = sessionStorage.getItem('id')
    const xmlreq = CriaRequest();
    xmlreq.open("POST", 'requisicoes/buscar-dados.php', true);
    xmlreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                if(estado === 'favoritar') alert('favoritado');
                else alert('desfavoritado')
            }else{
                console.log('erro');
            }
        }
    };
    xmlreq.send('estado='+estado+'&artigoId='+artigoId+'&usuarioId='+usuarioId)
}

// requisita os dados da lingua escolhida e muda
function mudarLingua(){
    this.requisitarLingua = (lingua, id) =>{
        url = 'requisicoes/buscar-dados.php?get=true&id='+id+'&lingua='+lingua
        console.log(url)
        var xmlreq = CriaRequest();
        xmlreq.open("GET", url, true);
        xmlreq.onreadystatechange = function(){
            if (xmlreq.readyState == 4) {
                if (xmlreq.status == 200) {
                    //retornar json com dados
                    document.querySelector('#secaoTexto')
                    .innerHTML = xmlreq.response
                    console.log('carregado');
                }else{
                    console.log('erro');
                }
            }
        };
        xmlreq.send(null)
    }
    let primeiraReproducao = false
    responsiveVoice.enableEstimationTimeout = false;
    const play = document.querySelector('#tocar')
    const texto = document.querySelector('#secaoTexto')
    this.tocarTexto = () => {
        if(responsiveVoice.isPlaying()){
            responsiveVoice.pause();
            play.classList.replace('fa-pause', 'fa-play')
        }
        else if(!responsiveVoice.isPlaying() && primeiraReproducao == false){
            setTimeout(responsiveVoice.speak(texto.textContent, linguaSelect.value), 200);
            play.classList.replace('fa-play', 'fa-pause')
            primeiraReproducao = true
        }
        else if(play.classList.contains('fa-play') && !responsiveVoice.isPlaying()){
            responsiveVoice.resume();
            play.classList.replace('fa-play', 'fa-pause')
        }
    }

    play.addEventListener('click', e => {
        tocarTexto();
    });
    let linguaSelect = document.querySelector('#linguaSelecao')
    linguaSelect.onchange = () =>{
        requisitarLingua(linguaSelect.value, urlParams.get('artigo'))
        linguaSelect = document.querySelector('#linguaSelecao')
        //console.log(linguaSelect.value, urlParams.get('artigo'))

        responsiveVoice.cancel()
        primeiraReproducao = false
        if(play.classList.contains('fa-pause')) play.classList.replace('fa-pause', 'fa-play')
    }
}

// funções que fazem a requisição dos dados do servidor
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
    if (!request) alert("Seu Navegador não suporta Ajax!");
    else return request;
}

function procurarConteudo(requisicao, pesquisa){
    if(!requisicao){
        if(pesquisa) url = 'requisicoes/buscar-dados.php?get=true&livrosNomes='+valorProcurar
        else{
            inicio = (quantidade * pagina) - quantidade;
            url = 'requisicoes/buscar-dados.php?get=true&livros=todos&inicio='+inicio+'&quantidade='+quantidade                    
        }
    }
    else if(requisicao === 'favoritos') url = 'requisicoes/buscar-dados.php?get=true&favoritos=true&usuarioId='+usuarioId

    console.log(url)
    const xmlreq = CriaRequest();
    xmlreq.open("GET", url, true);
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                //retornar json com dados
                let resposta = ''
                let tag = ''
                switch (requisicao) {
                    case 'favoritos':
                            const favoritos = document.querySelector('#favoritosBox')
                            favoritos.classList.remove('hidden')

                            resposta = xmlreq.response
                            resposta = JSON.parse(resposta)
                            console.log(resposta);
                            for (const key in resposta) {
                                if (resposta.hasOwnProperty(key)) {
                                    for (let contador = 0; contador < quantidade+1; contador++) {
                                        if(key === 'id'+contador){
                                            //console.log(resposta[key]);
                                            tag += `<div id="${resposta[key]}" class="livro-card">`
                                        }
                                        else if(key === 'imagem'+contador){
                                            //console.log(resposta[key]);
                                            tag += `<div style="background: url(http://localhost/storiesbr/resources/src/${resposta[key]}) center;background-size: cover;height: 100%;">`
                                        }
                                        else if(key === 'titulo'+contador){
                                            //console.log(resposta[key]);
                                            tag += `<div class="card-titulo"><p>${resposta[key]}</p></div></div></div>`
                                        }
                                    }
                                }
                            }                          
                            favoritos.innerHTML += tag                     

                            console.log('carregado');
                        break;
                
                    case undefined:
                            pagina++
                            document.querySelector('#artigosBox').classList.remove('hidden')

                            resposta = xmlreq.response
                            resposta = JSON.parse(resposta)
                            console.log(resposta);
                            for (const key in resposta) {
                                if (resposta.hasOwnProperty(key)) {
                                    for (let contador = 0; contador < quantidade+1; contador++) {
                                        if(key === 'id'+contador){
                                            //console.log(resposta[key]);
                                            tag += `<div id="${resposta[key]}" class="livro-card">`
                                        }
                                        else if(key === 'imagem'+contador){
                                            //console.log(resposta[key]);
                                            tag += `<div style="background: url(http://localhost/storiesbr/resources/src/${resposta[key]}) center;background-size: cover;height: 100%;">`
                                        }
                                        else if(key === 'titulo'+contador){
                                            //console.log(resposta[key]);
                                            tag += `<div class="card-titulo"><p>${resposta[key]}</p></div></div></div>`
                                        }
                                    }
                                }
                            }                          
                            document.querySelector('#artigosBox').innerHTML += tag                     
                        break;
                        
                    case null:
                            document.querySelector('#favoritosBox').classList.add('hidden')
                            document.querySelector('.buscar-favoritos').classList.add('hidden')
                            document.querySelector('#artigosBox').classList.remove('hidden')
                            document.querySelector('#btnLimpar').classList.remove('hidden')
                            resposta = xmlreq.response
                            resposta = JSON.parse(resposta)
                            console.log(resposta);
                            for (const key in resposta) {
                                if (resposta.hasOwnProperty(key)) {
                                    for (let contador = 0; contador < quantidade+1; contador++) {
                                        if(key === 'id'+contador){
                                            //console.log(resposta[key]);
                                            tag += `<div id="${resposta[key]}" class="livro-card">`
                                        }
                                        else if(key === 'imagem'+contador){
                                            //console.log(resposta[key]);
                                            tag += `<div style="background: url(http://localhost/storiesbr/resources/src/${resposta[key]}) center;background-size: cover;height: 100%;">`
                                        }
                                        else if(key === 'titulo'+contador){
                                            //console.log(resposta[key]);
                                            tag += `<div class="card-titulo"><p>${resposta[key]}</p></div></div></div>`
                                        }
                                    }                                            
                                }
                            }
                            document.querySelector('#artigosBox').innerHTML = tag                     
                            console.log(resposta);
                        break;
                }
            }
            else{
                console.log('erro');
            }
        }
    };
    xmlreq.send(null)
}
function procurarArtigo(){
    artigoId = sessionStorage.getItem('id')
    url = 'requisicoes/buscar-dados.php?get=true&artigo='+artigoId
    const xmlreq = CriaRequest();
    xmlreq.open("GET", url, true);
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                //retornar json com dados
                artigos.style.display = 'none'
                document.querySelector('#artigo').classList.remove('hidden')

                resposta = xmlreq.response
                resposta = JSON.parse(resposta)

                document.querySelector('.img-capa').style.backgroundImage = "url(http://localhost/storiesbr/resources/src/"+resposta.imagem+")";
                document.querySelector('#secaoTexto').innerHTML = resposta.texto

                console.log('carregado');
            }else{
                console.log('erro');
            }
        }
    };
    xmlreq.send(null)
}