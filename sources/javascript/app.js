// tela do primeiro carregamento do app
// Todo - começar com tela e depois do primeiro carregamento tirar ela
const load_page = document.querySelector('#load_page');
//load_page.normalize
//load_page.remove()
load_page.classList.replace('load_page', 'load_page_off');

const usuarioId = localStorage.getItem('usuarioId');
function verificarUsuario(){
    if(usuarioId){
        const usuarioNome = localStorage.getItem('usuarioNome');
        const usuarioEmail = localStorage.getItem('usuarioEmail');
    
        document.querySelector('#inicio .ini-bar p').innerHTML = usuarioNome;
        document.querySelector('.conta-container .usuario-container p').innerHTML = usuarioNome;
        document.querySelector('.conta-container .usuario-container .email').innerHTML = usuarioEmail;

        document.querySelector('.conta-container .sugestao-container #nomeTitulo').style.display = 'none';
        document.querySelector('.conta-container .sugestao-container #nome').style.display = 'none';
        document.querySelector('.conta-container .sugestao-container #emailTitulo').style.display = 'none';
        document.querySelector('.conta-container .sugestao-container #email').style.display = 'none';

        const btnEntrar = document.querySelector('.ini-bar .login');
        const btnSair = document.querySelector('.ini-bar .logout');
        btnEntrar.classList.add('hidden');
        btnSair.classList.remove('hidden');
        btnSair.onclick = () => logout();
    }
    else{
        document.querySelector('.ini-bar .login').onclick = () => window.location.href = 'login.html';
        document.querySelector('.conta-container .usuario-container p').innerHTML = 'Você está offline';
        document.querySelector('.conta-container .senha-container').style.display = 'none';
    }
}
verificarUsuario();
function logout(){
    localStorage.removeItem('usuarioId');
    localStorage.removeItem('usuarioNome');
    localStorage.removeItem('usuarioEmail');
    localStorage.removeItem('usuarioImg');
    sessionStorage.removeItem('estado');

    window.location.href = '?';
}

// seleção de temas
function mudarTema(){
    tema = localStorage.getItem('tema')
    const temaSelect = document.querySelector('#tema');
    this.definirTema = () => {
        if(tema === 'escuro'){
            document.querySelector('body').classList.replace('claro', 'escuro');
            temaSelect.value = tema;
        }
    }
    temaSelect.onchange = () =>{
        localStorage.setItem('tema', temaSelect.value);
        if(temaSelect.value === 'escuro') document.querySelector('body').classList.replace('claro', 'escuro');
        else document.querySelector('body').classList.replace('escuro', 'claro');
    }
}
mudarTema()

// todas funções de navegação da pag inicial estão aqui 
function navegacao(){
    // carrega as ultimas atualizações de artigos na pesquisa
    let quantidade = 7;
    let inicio = 0;
    this.procurarConteudo = () =>{
        url = 'requisicoes/buscar-dados.php?get=true&livros=todos&inicio='+inicio+'&quantidade='+quantidade

        console.log(url)
        const xmlreq = CriaRequest();
        xmlreq.open("GET", url, true);
        xmlreq.onreadystatechange = function(){
            if (xmlreq.readyState == 4) {
                if (xmlreq.status == 200) {
                    let tag = ''
                    document.querySelector('#buscaArtigosBox').classList.remove('hidden')

                    let resposta = xmlreq.response
                    resposta = JSON.parse(resposta)
                    console.log(resposta);
                    for (let key in resposta) {
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
                    document.querySelector('#buscaArtigosBox').innerHTML = tag
                }
                else{
                    console.log('erro');
                }
            }
        };
        xmlreq.send(null)

        // eventos de clique que direciona pra url adequada
        const artigos = document.querySelector('#buscaArtigosBox')
        artigos.onclick = event =>{
            //console.log(event.target.parentNode.parentNode.parentNode);
            if(event.target.parentNode.classList.value == 'livro-card'){
                sessionStorage.setItem('id', event.target.parentNode.id)
                window.location.href = 'buscar-tudo.html?artigo='+event.target.parentNode.id
            }
            else if(event.target.parentNode.parentNode.parentNode.classList.value == 'livro-card'){
                sessionStorage.setItem('id', event.target.parentNode.parentNode.parentNode.id)
                window.location.href = 'buscar-tudo.html?artigo='+event.target.parentNode.parentNode.parentNode.id
            }
        }
    }

    const view = document.querySelectorAll('.view')
    const nav_items = document.querySelectorAll('.nav_items')
    // função que trocar a view exibida
    this.navegacaoMudar = (item_id) =>{
        switch(item_id){
            case 'inicio':
                view[2].style.display = 'block'
                sessionStorage.setItem('estado', item_id)
                break;
            case 'videos':
                view[3].style.display = 'block'
                sessionStorage.setItem('estado', item_id)
                carregarVideos()
                break;
            case 'configuracao':
                view[4].style.display = 'block'
                sessionStorage.setItem('estado', item_id)
                definirTema();
                break;
            case 'jogos':
                view[1].style.display = 'block'
                sessionStorage.setItem('estado', item_id)
                break;
            case 'pesquisar':
                view[0].style.display = 'block'
                sessionStorage.setItem('estado', item_id)
                procurarConteudo()
                break;
        }
    }

    // retem estado da página
    let estado = sessionStorage.getItem('estado')
    if(estado){
        console.log(estado)
        for (const item of nav_items) {
            nav_items.forEach(item => {
                item.classList.remove('active');
                if(item.id === 'nav_'+estado){
                    item.classList.add('active');
                }
            });
            for(i = 0; i <= 4; i++){
                view[i].style.display = 'none'
            }
        }
        navegacaoMudar(estado)
    }
    // navegação de páginas
    for (const item of nav_items) { item.addEventListener('click', () =>{
            nav_items.forEach(item => {
                item.classList.remove('active');
            });
            item.classList.add('active');
    
            for(i = 0; i <= 4; i++){
                view[i].style.display = 'none'
            }
            let item_id = item.id.substr(4)
            navegacaoMudar(item_id)
        })
    }

    document.querySelector('#inicio .playground-container').onclick = event =>{
        if(event.target.id == 'cardVideo' || event.target.parentNode.id == 'cardVideo'){
            for (const item of nav_items) {
                nav_items.forEach(item => {
                    item.classList.remove('active');
                    if(item.id === 'nav_videos'){
                        item.classList.add('active');
                    }
                });
                for(i = 0; i <= 4; i++){
                    view[i].style.display = 'none';
                }
            }
            navegacaoMudar('videos');
        }
        else if(event.target.id == 'cardArt' || event.target.parentNode.id == 'cardArt') window.location.href = 'buscar-tudo.html';
        else if(event.target.id == 'cardAvat' || event.target.parentNode.id == 'cardAvat') window.location.href = 'avatar.html';
        else if(event.target.id == 'cardMem' || event.target.parentNode.id == 'cardMem') window.location.href = 'jogo-da-memoria.html';
        else if(event.target.id == 'cardQuiz' || event.target.parentNode.id == 'cardQuiz') window.location.href = 'quiz.html';
        else if(event.target.id == 'cardDig' || event.target.parentNode.id == 'cardDig') window.location.href = 'jogo-digitacao.html';
    }
    document.querySelector('#jogos .playground-container').onclick = event =>{
        if(event.target.id == 'cardAvat' || event.target.parentNode.id == 'cardAvat') window.location.href = 'avatar.html';
        else if(event.target.id == 'cardMem' || event.target.parentNode.id == 'cardMem') window.location.href = 'jogo-da-memoria.html';
        else if(event.target.id == 'cardQuiz' || event.target.parentNode.id == 'cardQuiz') window.location.href = 'quiz.html';
        else if(event.target.id == 'cardDig' || event.target.parentNode.id == 'cardDig') window.location.href = 'jogo-digitacao.html';
    }
}
navegacao();

function CriaRequest(){
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
function carregaInicio(){

}
let quantidadeVideos = 0;
function carregarVideos(){
    //if(quantidadeVideos !== 0) quantidadeVideos + 4
    //let url = 'buscar-dados.php?get=videos&quantidade='+quantidadeVideos
    let url = 'requisicoes/buscar-dados.php?get=videos';
    console.log(url)
    let xmlreq = CriaRequest();
    xmlreq.open("GET", url, true);
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                let tag = '';
                let resposta = xmlreq.response;
                resposta = JSON.parse(resposta);
                respostaLength = Object.keys(resposta).length
                for (let key in resposta) {
                        for (let contador = 0; contador < respostaLength; contador++) {                            
                            if(key === 'id'+contador){
                                tag += `<div id="${resposta[key]}" class="video-card">`
                            }
                            else if(key === 'iframe'+contador){
                                tag += `<div class="video-frame">${resposta[key]}</div>`
                            }
                            else if(key === 'titulo'+contador){
                                tag += `<div class="video-card-titulo"><p>${resposta[key]}</p></div></div>`
                            }
                        }
                }                
                document.querySelector('#videos .videos-container').innerHTML = tag
                const iframes = document.querySelectorAll('iframe');
                iframes.forEach(iframe => {
                    iframe.style.width = '100%';
                    iframe.style.height = '100%';
                });

                document.querySelector('.videos-container').onclick = event => {
                    if(event.target.parentNode.parentNode.classList.contains('video-card')){
                        sessionStorage.setItem('videoId', event.target.parentNode.parentNode.id);
                        window.location.href = 'videos.html?id='+event.target.parentNode.parentNode.id;
                    }
                }
                
            }else{
                alert('Houve uma falha no sistema, tente novamente mais tarde!')
            }
        }
    };
    xmlreq.send(null);
}

document.querySelector('#buscarTudo').onclick = () => {
    window.location.href = 'buscar-tudo.html';
}

// altera senha de um usuario logado
function alterarSenha(senhaAtual, senhaNova){
    let xmlreq = CriaRequest();
    xmlreq.open("POST", 'requisicoes/usuario.php', true);
    xmlreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                console.log(xmlreq.responseText);
                
                if(xmlreq.response === 'sucesso') alert('Alterado com sucesso!');
                else if(xmlreq.response === 'erro') alert('Houve um erro, cheque sua senha e tente novamente!');
            }else{
                alert('Houve um erro no sistema tente novamente mais tarde!');
            }
        }
    };
    xmlreq.send('mudar_senha=true&senha_atual='+senhaAtual+'&senha_nova='+senhaNova+'&userid='+usuarioId);
}
document.querySelector('.senha-container button').onclick = () =>{
    const senhaAtual = document.querySelector('#senhaAtual');
    const senhaNova = document.querySelector('#senhaNova');
    if(senhaAtual.value && senhaNova.value) alterarSenha(senhaAtual.value, senhaNova.value);
    else alert('Preencha os dois campos');
    senhaAtual.value = '';
    senhaNova.value = '';
}

// envia mensagens de qualquer usuario
function enviarFeedback(){
    let usuarioNome = null;
    let usuarioEmail = null
    if(usuarioId){
        usuarioNome = localStorage.getItem('usuarioNome');
        usuarioEmail = localStorage.getItem('usuarioEmail');
    }
    else{
        usuarioNome = document.querySelector('.conta-container .sugestao-container #nome').value;
        usuarioEmail = document.querySelector('.conta-container .sugestao-container #email').value;
        console.log(usuarioNome);
        console.log(usuarioEmail);
        
    }
    let mens = document.querySelector('.conta-container .sugestao-container #reporte').value;
    if(mens === ''){
        alert('Escreva uma mensagem para enviar primeiro!')
    }
    else{
        let xmlreq = CriaRequest();
        xmlreq.open("POST", 'requisicoes/usuario.php', true);
        xmlreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlreq.onreadystatechange = function(){
            if (xmlreq.readyState == 4) {
                if (xmlreq.status == 200) {                
                    if(xmlreq.response === 'enviado') alert('Obrigado por nos enviar esta mensagem!');
                    else if(xmlreq.response === 'erro') alert('Houve um erro no envio, tente novamente!');
                }else{
                    alert('Houve um erro no sistema tente novamente mais tarde!');
                }
            }
        };
        xmlreq.send('mensagem=true&nome='+usuarioNome+'&email='+usuarioEmail+'&mens='+mens);
    }
}
document.querySelector('.sugestao-container button').onclick = () =>{
    const textArea = document.querySelector('#reporte');
    const nome = document.querySelector('.conta-container .sugestao-container #nome');
    const email = document.querySelector('.conta-container .sugestao-container #email');

    enviarFeedback();
    nome.value = '';
    email.value = '';
    textArea.value = '';
}

// envia avaliação de qualquer usuario
function enviarAvaliação(mudar, avaliacao){
    let xmlreq = CriaRequest();
    xmlreq.open("POST", 'requisicoes/usuario.php', true);
    xmlreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {                
                if(xmlreq.response === 'enviado'){
                    alert('Obrigado por avaliar nosso app, reporte algum erro e poderemos melhorar sua expeciência ainda mais!');
                    if(usuarioId) localStorage.setItem('avaliado', 'true');
                }
                else if(xmlreq.response === 'erro') alert('Houve um erro no envio, tente novamente!');
            }else{
                alert('Houve um erro no sistema tente novamente mais tarde!');
            }
        }
    };
    xmlreq.send('avaliar=true&avaliacao='+avaliacao+'&userid='+usuarioId+'&mudar='+mudar);
}
document.querySelector('.sugestao-container').onclick = event =>{
    const avaliado = localStorage.getItem('avaliado')
    if(!avaliado){
        if(event.target.classList.contains('thumbs-up')) enviarAvaliação(null, 'gostei');
        else if(event.target.classList.contains('thumbs-down')) enviarAvaliação(null, 'naoGostei');
    }
    else if(avaliado && event.target.classList.contains('thumbs-up') || event.target.classList.contains('thumbs-down')){
        let confirmar = confirm('Gostaria de mudar sua avaliação?')
        if(confirmar === true){
            if(event.target.classList.contains('thumbs-up')) enviarAvaliação(true, 'gostei');
            else if(event.target.classList.contains('thumbs-down')) enviarAvaliação(true, 'naoGostei');    
        }
    }
}