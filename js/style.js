function openNav() {
    document.getElementById("sideMenu").style.marginLeft = "150px";
    document.getElementById("mySidenav").style.width = "220px";
    document.getElementById("overl").style.width = "100%";
    if(document.getElementById('nav').offsetWidth < "431"){
        document.getElementById("logo").style.width = "0%";
        document.getElementById("logo").style.height = "0%";
    }
}
function closeNav() {
    document.getElementById("sideMenu").style.marginLeft = "0";
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("overl").style.width = "0%";
    document.getElementById("logo").style.width = "";
}
