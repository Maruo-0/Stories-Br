function navegacao(){
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

//navigator.onLine  if false botar tela "você está offline"
/* const load_page = document.querySelector('#load_page')
    const tela_app = document.querySelector('#tela_app')
    tela_app.style.display = 'none'
    load_page.classList.remove('load_page_off')
    load_page.className +=('load_page') */

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
    const email = document.querySelector('')
    const senha = document.querySelector('')
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
function carregarPesquisa(){
    var url = ''
    console.log(url)    
    var xmlreq = CriaRequest();
    xmlreq.open("GET", url, true);
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                console.log('carregado');
            }else{

            }
        }
    };
    xmlreq.send(null);
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
let usuarioId = localStorage.getItem('usuarioId')
let usuarioNome = localStorage.getItem('usuarioNome')
let usuarioEmail = localStorage.getItem('usuarioEmail')
let usuarioImg = localStorage.getItem('usuarioImg')
function carregarDadosFavoritos(){
    var url = 'buscar-dados.php?get=favoritos&usuarioId='+usuarioId
    console.log(url)    
    var xmlreq = CriaRequest();
    xmlreq.open("GET", url, true);
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                console.log('carregado');
            }else{
                console.log('error');
            }
        }
    };
    xmlreq.send(null);
}
function carregarPaginaFavoritos(){
    if(usuarioId) carregarDadosFavoritos()
    else{
        const paginaFavoritos = document.querySelector('#')
    }
}
/* const a = new URL(window.location.href)
get = a.searchParams.get('pesquisar')
console.log(get) */


const buscarTudo = document.querySelector('#buscarTudo')
.onclick = () => {
    window.location.href = 'buscar-tudo.html';
}