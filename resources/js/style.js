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
    if(this.favorito.innerText === 'favorite'){
        this.favorito.innerText = 'favorite_border';
    }else{
    this.favorito.innerText = 'favorite';
    }
}