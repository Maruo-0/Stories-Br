function openNav() {
    document.getElementById("sideMenu").style.marginLeft = "150px";
    document.getElementById("mySidenav").style.width = "220px";
    document.getElementById("overl").style.width = "100%";
    if(document.getElementById('nav').offsetWidth < "460"){
        document.getElementById("logo").style.display = "none";
        document.getElementById("search_title").style.display = "none";
        document.getElementById("search").style.display = "none";
    }
}
function closeNav() {
    document.getElementById("sideMenu").style.marginLeft = "0";
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("overl").style.width = "0%";
    document.getElementById("logo").style.display = "";
    document.getElementById("search_title").style.display = "block";
    document.getElementById("search").style.display = "block";
}
const side = document.querySelector('#sideMenu');
side.addEventListener('click touchstart', e => {
    document.getElementById("sideMenu").style.marginLeft = "150px";
    document.getElementById("mySidenav").style.width = "220px";
    document.getElementById("overl").style.width = "100%";
    if(document.getElementById('nav').offsetWidth < "460"){
        document.getElementById("logo").style.display = "none";
        document.getElementById("search_title").style.display = "none";
        document.getElementById("search").style.display = "none";
    }
});

function favoritar() {
    favorito = document.querySelector('#favorito');
    if(this.favorito.innerText === 'favorite'){
        this.favorito.innerText = 'favorite_border';
    }else{
    this.favorito.innerText = 'favorite';
    }
}