// tela do primeiro carregamento do app
// Todo - começar com tela e depois do primeiro carregamento tirar ela
const load_page = document.querySelector('#load_page');
//load_page.normalize
//load_page.remove()
load_page.classList.replace('load_page', 'load_page_off');

function verificarUsuario(){
    const usuarioId = localStorage.getItem('usuarioNome')//TESTE-MUDAR DEPOIS
    if(usuarioId){
        const usuarioNome = localStorage.getItem('usuarioNome');
        const usuarioEmail = localStorage.getItem('usuarioEmail');
    
        const mensagem = document.querySelector('.ini-bar p')
        console.log(mensagem);
        mensagem.innerHTML = usuarioNome
        const btnEntrar = document.querySelector('.ini-bar .login')
        const btnSair = document.querySelector('.ini-bar .logout')
        console.log(btnEntrar);
        btnEntrar.classList.add('hidden')
        btnSair.classList.remove('hidden')
        btnSair.onclick = () => logout()
    }
    else{
        document.querySelector('.ini-bar .login').onclick = () => window.location.href = 'login.html'
    }
}
verificarUsuario();

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
                break;
            case 'configuracao':
                view[4].style.display = 'block'
                sessionStorage.setItem('estado', item_id)
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

    document.querySelector('.secao-container').onclick = event =>{
        if(event.target.id == 'cardVideo'){
            for (const item of nav_items) {
                nav_items.forEach(item => {
                    item.classList.remove('active');
                    if(item.id === 'nav_'+estado){
                        item.classList.add('active');
                    }
                });
                for(i = 0; i <= 4; i++){
                    view[i].style.display = 'none';
                }
            }
            navegacaoMudar('videos');
        }
        else if(event.target.id == 'cardMem') window.location.href = 'jogo-da-memoria.html';
        else if(event.target.id == 'cardQuiz') window.location.href = 'quiz.html';
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
function logout(){
    localStorage.removeItem('usuarioId');
    localStorage.removeItem('usuarioNome');
    localStorage.removeItem('usuarioEmail');
    localStorage.removeItem('usuarioImg');
    sessionStorage.removeItem('estado');

    window.location.href = '?';
}
let quantidadeVideos = 0;
function carregarVideos(){
    if(quantidadeVideos !== 0) quantidadeVideos + 4
    let url = 'buscar-dados.php?get=videos&quantidade='+quantidadeVideos
    console.log(url)
    let xmlreq = CriaRequest();
    xmlreq.open("GET", url, true);
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                console.log(xmlreq.response);
            }else{

            }
        }
    };
    xmlreq.send(null);
}

document.querySelector('#buscarTudo').onclick = () => {
    window.location.href = 'buscar-tudo.html';
}