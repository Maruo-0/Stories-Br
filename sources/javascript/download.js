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
    
    if (!request) 
        alert("Seu Navegador não suporta Ajax!");
    else
        return request;
}
function carregarPag(){
    var url = "requisicoes/renderizar.php?skincolor="+now_skin;
    url += "&hairstyle="+now_hairstyles;
    url += "&haircolor="+now_haircolors;
    url += "&fabriccolors="+now_fabriccolors;
    url += "&eyes="+now_eyes;
    url += "&eyebrows="+now_eyebrows;
    url += "&mouth="+now_mouths;
    url += "&facialhair="+now_facialhairs;
    url += "&clothe="+now_clothes;
    url += "&backgroundcolor="+now_backgrounds;
    url += "&glasses="+now_glasses;
    url += "&glassopacity="+now_glassopacity;
    url += "&tattoos="+now_tattoos;
    url += "&accesories="+now_accesories;
    console.log(url)

    const result = document.querySelector('#result');
    
    var xmlreq = CriaRequest();
    xmlreq.open("GET", url, true);
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            result.style.display = 'block';
            if (xmlreq.status == 200) {
                result.innerHTML = xmlreq.responseText;
                console.log('carregado');
            }else{
                result.innerHTML = "Erro: " + xmlreq.statusText;
            }
        }
    };
    xmlreq.send(null);
}
const renderizar = document.querySelector('#download2').addEventListener('click', () =>{
    carregarPag()
})