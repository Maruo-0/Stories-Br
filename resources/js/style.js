let navOpen = false
const sideMenu = document.getElementById("sideMenu")
const mySidenav = document.getElementById("mySidenav")
const overl = document.getElementById("overl")
const logo = document.getElementById("logo")
const search_title = document.getElementById("search_title")
const search = document.getElementById("search")
function openNav() {
    sideMenu.style.marginLeft = "150px";
    mySidenav.style.width = "220px";
    overl.style.width = "100%";
    if(document.getElementById('nav').offsetWidth < "460"){
        logo.style.display = "none";
        search_title.style.display = "none";
        search.style.display = "none";
    }
    if(navOpen === false)navOpen = true
    else closeNav()
}
function closeNav() {
    sideMenu.style.marginLeft = "0";
    mySidenav.style.width = "0";
    overl.style.width = "0%";
    logo.style.display = "";
    search_title.style.display = "block";
    search.style.display = "block";
    navOpen = false
}
function favoritar() {
    favorito = document.querySelector('#favorito');
    if(this.favorito.innerText === 'star'){
        this.favorito.innerText = 'star_border';
        desfavoritarConteudo(id)
    }else{
        this.favorito.innerText = 'star';
        favoritarConteudo(id)
    }
}

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
function favoritarConteudo(id){
    url = '../biblioteca/funcoes-leitura.php?favoritar=true&id='+id
    const xmlreq = CriaRequest();
    xmlreq.open("GET", url, true);
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                alert('Favoritado')
            }else{
                console.log('erro')
            }
        }
    }
    xmlreq.send(null);
}
function desfavoritarConteudo(id){
    url = '../biblioteca/funcoes-leitura.php?desfavoritar=true&id='+id
    const xmlreq = CriaRequest();
    xmlreq.open("GET", url, true);
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                alert('Desfavoritado')
            }else{
                console.log('erro')
            }
        }
    }
    xmlreq.send(null);
}