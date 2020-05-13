let navOpen = false
const sideMenu = document.getElementById("sideMenu")
const mySidenav = document.getElementById("mySidenav")
const overl = document.getElementById("overl")
const painel = document.getElementById("painel")
const botoes = document.querySelectorAll('.botao')
let botao_id

for (const botao of botoes) { botao.addEventListener('click', () =>{
    carregarPags(botao.id)

    botao_id = botao.id //salva o id do botao
    const botoes_ativar = document.querySelectorAll('#mySidenav .botao')
    // remove a class de todos e coloca no clicado
    botoes_ativar.forEach(botao_ativo => { 
        botao_ativo.classList.remove('active');
        if(botao_ativo.id === botao.id){
            botao_ativo.classList.add('active');
        }
    })
    mudarJanela()
})}

function openNav() {
    sideMenu.style.marginLeft = "150px";
    mySidenav.style.width = "220px";
    overl.style.width = "100%";
    if(document.getElementById('nav').offsetWidth < "460"){
        painel.style.display = "none";
    }
    if(navOpen === false)navOpen = true
    else closeNav()
}
function closeNav() {
    sideMenu.style.marginLeft = "0";
    mySidenav.style.width = "0";
    overl.style.width = "0%";
    navOpen = false
    painel.style.display = "block";
}
function mudarJanela(){
    const view = document.querySelectorAll('.view')      
    for(i = 0; i <= 5; i++){
        view[i].style.display = 'none'
    }
    switch(botao_id){
        case 'inicio':
            view[0].style.display = 'block'
            break;
        case 'usuarios':
            view[1].style.display = 'block'        
            break;
        case 'conteudo':
            view[2].style.display = 'block'
            break;
        case 'revisao':
            view[3].style.display = 'block'
            break;
        case 'reportes':
            view[4].style.display = 'block'
            break;
        case 'sugestoes':
            view[5].style.display = 'block'
            break;
    }
    closeNav()
}
function showTime(){
    var date = new Date();
    var d = date.getDate()
    var me = date.getMonth()
    var a = date.getFullYear()
    var h = date.getHours();
    var mi = date.getMinutes();
    var s = date.getSeconds();
    var session = "AM";
    if(h > 12){
        session = "PM";
    }
    h = (h < 10) ? "0" + h : h;
    mi = (mi < 10) ? "0" + mi : mi;
    s = (s < 10) ? "0" + s : s;
    var time = d+'/'+me+'/'+a+' '+ h + ":" + mi + ":" + s + " " + session;
    document.getElementById("relogio").innerText = time;
    document.getElementById("relogio").textContent = time;
    setTimeout(showTime, 1000);
}
showTime();
///funções do modal, ordenarTabela, procurarNome ficavam aqui
//dar um jeito de funcionar depois
function ordenarTabela(n, tabela) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    switching = true;
    dir = "asc"; 
    while (switching) {
      switching = false;
      rows = tabela.rows;
      for (i = 1; i < (rows.length - 1); i++) {
        shouldSwitch = false;
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
        if (dir == "asc") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            shouldSwitch= true;
            break;
          }
        } else if (dir == "desc") {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            shouldSwitch = true;
            break;
          }
        }
      }
      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        switchcount ++;      
      } else {
        if (switchcount == 0 && dir == "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
}

function procurarNome(id, tabelaId) {
    var procurar, filter, tabela, tr, td, i, txtValue;
    filter = id.value.toUpperCase();
    tr = tabelaId.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    if(id.id === 'procurarUser' || id.id === 'procurar2' || id.id === 'procurar'){
        for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    else{
        for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
}

//refaz a seleção para adicionar funções de clique aos elementos novos
function bindCliques(){
    this.fecharModal = function(){
        modal1.forEach(modal => {
            modal.style.display = "none";
        })
    }
    let parent_modal = document.querySelectorAll("#parent-modal");
    let modal1 = document.querySelectorAll("#modal");
    let modalopen = document.querySelectorAll("#modalopen");
    let spans = document.querySelectorAll(".close");
    //abrir modal
    for (const modal of modalopen) { modal.addEventListener('click', () =>{
        parent_modal.forEach(parent => {
            if(parent.contains(modal)){
                for(i = 0; i < modal1.length; i++){
                    if(parent.contains(modal1[i])){
                        //console.log(modal1[i])
                        modal1[i].style.display = "block";
                    }
                }
            }
        });
    })}
    //fechar modal
    for (const span of spans) { span.addEventListener('click', () =>{
        this.fecharModal()
    })}
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
    
    if (!request) 
        alert("Seu Navegador não suporta Ajax!");
    else
        return request;
}
function carregarPags(id){
    url = 'servicosadmin.php?'+id+'='+id
    const xmlreq = CriaRequest();
    xmlreq.open("GET", url, true);
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                switch (id) {
                    case 'usuarios':
                            const tabelaUsuarios = document.querySelector('#quadrousuarios tbody')
                            tabelaUsuarios.innerHTML = xmlreq.responseText
                        break;
                    case 'conteudo':
                            const tabelaConteudos = document.querySelector('#tabelaUser tbody')
                            tabelaConteudos.innerHTML = xmlreq.responseText
                        break;
                    case 'revisao':
                            const quadroRevisao = document.querySelector('#quadro-conteudo')
                            quadroRevisao.innerHTML = xmlreq.responseText    
                        break;
                    case 'reportes':
                            const tabelaReportes = document.querySelector('#tabela tbody')
                            tabelaReportes.innerHTML = xmlreq.responseText
                        break;
                    case 'sugestoes':
                        const tabelaSugestoes = document.querySelector('#tabela2 tbody')
                        tabelaSugestoes.innerHTML = xmlreq.responseText
                        break;
                }
                bindCliques() //refaz a seleção para adicionar funções de clique aos elementos novos
            }else{
                console.log(erro)
            }
        }
    };
    xmlreq.send(null);
}

function aprovar(id){
    url = 'servicosadmin.php?negar=true&id='+id
    const xmlreq = CriaRequest();
    xmlreq.open("GET", url, true);
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                console.log('aprovado')
                new bindCliques().fecharModal()
            }else{
                console.log(erro)
            }
        }
    }
    xmlreq.send(null);
}
function negar(id){
    url = 'servicosadmin.php?aprovar=true&id='+id
    const xmlreq = CriaRequest();
    xmlreq.open("GET", url, true);
    xmlreq.onreadystatechange = function(){
        if (xmlreq.readyState == 4) {
            if (xmlreq.status == 200) {
                console.log('negado')
                new bindCliques().fecharModal()
            }else{
                console.log(erro)
            }
        }
    }
    xmlreq.send(null);
}