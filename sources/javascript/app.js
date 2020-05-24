function navegacao(){
    // carrega as ultimas atualizações de artigos na pesquisa
    let quantidade = 7;
    let inicio = 3;
    this.procurarConteudo = () =>{
        url = 'requisicoes/buscar-dados.php?get=true&livros=todos&inicio='+inicio+'&quantidade='+quantidade

        console.log(url)
        const xmlreq = CriaRequest();
        xmlreq.open("GET", url, true);
        xmlreq.onreadystatechange = function(){
            if (xmlreq.readyState == 4) {
                if (xmlreq.status == 200) {
                    let tag = ''
                    document.querySelector('#appArtigosBox').classList.remove('hidden')

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
                    document.querySelector('#appArtigosBox').innerHTML += tag
                }
                else{
                    console.log('erro');
                }
            }
        };
        xmlreq.send(null)

        // eventos de clique que direciona pra url adequada
        const artigos = document.querySelector('#appArtigosBox')
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
}
navegacao()

// tela do primeiro carregamento do app
// Todo - começar com tela e depois do primeiro carregamento tirar ela
const load_page = document.querySelector('#load_page')
load_page.classList.replace('load_page', 'load_page_off')

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
function login(){
    const email = document.querySelector('').value
    const senha = document.querySelector('').value
    var xmlreq = CriaRequest();
    xmlreq.open("POST", 'buscar-dados.php', true);
    xmlreq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                //retornar json com dados
                //salvar no localStorage ou sessionStorage
                localStorage.setItem('usuarioId', usuarioId)
                localStorage.setItem('usuarioNome', usuarioNome)
                localStorage.setItem('usuarioEmail', usuarioEmail)
                localStorage.setItem('usuarioImg', usuarioImg)
                console.log('carregado');
            }else{

            }
        }
    };
    xmlreq.send('email='+email+'&senha='+senha);
}
function logout(){
    localStorage.removeItem('usuarioId')
    localStorage.removeItem('usuarioNome')
    localStorage.removeItem('usuarioEmail')
    localStorage.removeItem('usuarioImg')
    sessionStorage.removeItem('estado')

    window.location.href = '?';
}
let quantidadeVideos = 0
function carregarVideos(){
    if(quantidadeVideos !== 0) quantidadeVideos + 4
    var url = 'buscar-dados.php?get=videos&quantidade='+quantidadeVideos
    console.log(url)
    var xmlreq = CriaRequest();
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

const buscarTudo = document.querySelector('#buscarTudo')
.onclick = () => {
    window.location.href = 'buscar-tudo.html';
}