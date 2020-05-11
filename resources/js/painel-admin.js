let navOpen = false
const sideMenu = document.getElementById("sideMenu")
const mySidenav = document.getElementById("mySidenav")
const overl = document.getElementById("overl")
const painel = document.getElementById("painel")
const botoes = document.querySelectorAll('.botao')
let botao_id

for (const botao of botoes) { botao.addEventListener('click', () =>{
    botao_id = botao.id //salva o id do botao
    const botoes_ativos = document.querySelectorAll('#mySidenav .botao')
    // remove a class de todos e coloca no clicado
    botoes_ativos.forEach(botao_ativo => { 
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

function fecharModal(){
    modal1.forEach(modal => {
        modal.style.display = "none";
    })
}

const parent_modal = document.querySelectorAll("#parent-modal");
const modal1 = document.querySelectorAll("#modal");
const modalopen = document.querySelectorAll("#modalopen");
const spans = document.querySelectorAll(".close");
for (const modal of modalopen) { modal.addEventListener('click', () =>{
    parent_modal.forEach(parent => {
        if(parent.contains(modal)){
            for(i = 0; i < modal1.length; i++){
                if(parent.contains(modal1[i])){
                    console.log(modal1[i])
                    modal1[i].style.display = "block";
                }
            }
        }
    });
})}
for (const span of spans) { span.addEventListener('click', () =>{
    fecharModal()
})}

function ordenarTabela(n, tabela) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    //table = document.getElementById("tabela");
    switching = true;
    //Set the sorting direction to ascending:
    dir = "asc"; 
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
      //start by saying: no switching is done:
      switching = false;
      rows = tabela.rows;
      /*Loop through all table rows (except the
      first, which contains table headers):*/
      for (i = 1; i < (rows.length - 1); i++) {
        //start by saying there should be no switching:
        shouldSwitch = false;
        /*Get the two elements you want to compare,
        one from current row and one from the next:*/
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
        /*check if the two rows should switch place,
        based on the direction, asc or desc:*/
        if (dir == "asc") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            //if so, mark as a switch and break the loop:
            shouldSwitch= true;
            break;
          }
        } else if (dir == "desc") {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            //if so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
      }
      if (shouldSwitch) {
        /*If a switch has been marked, make the switch
        and mark that a switch has been done:*/
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        //Each time a switch is done, increase this count by 1:
        switchcount ++;      
      } else {
        /*If no switching has been done AND the direction is "asc",
        set the direction to "desc" and run the while loop again.*/
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
    if(id.id === 'procurarUser'){
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