var id
const skincolor2 = document.querySelector('#skincolor2')
skincolor2.addEventListener('click', () =>{
    id = skincolor2.id
    menu()
})
const eyes2 = document.querySelector('#eyes2')
eyes2.addEventListener('click', () =>{
    id = eyes2.id
    menu()
})
const eyebrows2 = document.querySelector('#eyebrows2')
eyebrows2.addEventListener('click', () =>{
    id = eyebrows2.id
    menu()
})
const mouths2 = document.querySelector('#mouths2')
mouths2.addEventListener('click', () =>{
    id = mouths2.id
    menu()
})
const hairstyles2 = document.querySelector('#hairstyles2')
hairstyles2.addEventListener('click', () =>{
    id = hairstyles2.id
    menu()
})
const haircolors2 = document.querySelector('#haircolors2')
haircolors2.addEventListener('click', () =>{
    id = haircolors2.id
    menu()
})
const facialhairs2 = document.querySelector('#facialhairs2')
facialhairs2.addEventListener('click', () =>{
    id = facialhairs2.id
    menu()
})
const clothes2 = document.querySelector('#clothes2')
clothes2.addEventListener('click', () =>{
    id = clothes2.id
    menu()
})
const fabriccolors2 = document.querySelector('#fabriccolors2')
fabriccolors2.addEventListener('click', () =>{
    id = fabriccolors2.id
    menu()
})
const glasses2 = document.querySelector('#glasses2')
glasses2.addEventListener('click', () =>{
    id = glasses2.id
    menu()
})
const glassopacity2 = document.querySelector('#glassopacity2')
glassopacity2.addEventListener('click', () =>{
    id = glassopacity2.id
    menu()
})
const accesories2  = document.querySelector('#accesories2')
accesories2.addEventListener('click', () =>{
    id = accesories2.id
    menu()
})
const tattoos2 = document.querySelector('#tattoos2')
tattoos2.addEventListener('click', () =>{
    id = tattoos2.id
    menu()
})
const backgroundcolors2 = document.querySelector('#backgroundcolors2')
backgroundcolors2.addEventListener('click', () =>{
    id = backgroundcolors2.id
    menu()
})
const download2 = document.querySelector('#download2')
download2.addEventListener('click', () =>{
    id = download2.id
    menu()
})

const menu_lines = document.querySelector('#menu_lines')
menu_lines.addEventListener('click', () =>{
    console.log(menu_lines)
    abrirMenu()
})
function abrirMenu(){
    const menu_class = document.querySelector('#menu')
    const menu_class_name = document.querySelector('#menu').className
    console.log(menu_class_name)

    if (menu_class_name==="") {
        menu_class.classList.add('active')
        menu_class.style.border = '0px'
        menu_class.style.width = '315px',
        menu_class.style.height = '460px'
    } else {
        menu_class.classList.remove('active')
        menu_class.style.borderRight = '1px solid #707070'
        menu_class.style.width = '60px',
        menu_class.style.height = '100%'
    }
}

function menu(){
    const menu_list = document.querySelector('#menu_list #'+id)
    const options_title = document.querySelector('#options_title')
    const options_div = document.querySelector('#options_div')
    console.log(menu_list)
    console.log(id)

    var idx = id;
    var selected = menu_list.textContent
    options_title.innerHTML = 'SELECT '+selected
    options_div.innerHTML = ''
    var html = "";
    switch (idx) {
        case "skincolor2":
            for (var i=0;i<array_skins.length; i++) {
                skin = array_skins[i];
                html += "<div class='skins' id='s_"+skin+"' onclick=mudarAparencia('s_"+skin+"') style='background-color:#"+skin+";'></div>";
            }
            break;
        case "eyes2":
            for (i=0;i<array_eyes.length; i++) {
                eye = array_eyes[i];
                html += "<div class='eyes' id='e_"+eye+"' onclick=mudarAparencia('e_"+eye+"') style='background-color:#"+array_current_skincolor+";background-position:"+(i*-53)+"px 0px;'></div>";
            }
            break;
        case "eyebrows2":
            for (i=0;i<array_eyebrows.length; i++) {
                eyebrow = array_eyebrows[i];
                html += "<div class='eyebrows' id='eb_"+eyebrow+"' onclick=mudarAparencia('eb_"+eyebrow+"') style='background-color:#"+array_current_skincolor+";background-position:"+(i*-53)+"px -53px;'></div>";
            }
            break;
        case "mouths2":
            for (i=0;i<array_mouths.length; i++) {
                mouth = array_mouths[i];
                html += "<div class='mouths' id='m_"+mouth+"' onclick=mudarAparencia('m_"+mouth+"') style='background-color:#"+array_current_skincolor+";background-position:"+(i*-53)+"px -106px;'></div>";
            }
            break;
        case "hairstyles2":
            for (i=0;i<array_hairstyles.length; i++) {
                hairstyle = array_hairstyles[i];
                html += "<div class='hairstyles' id='h_"+hairstyle+"' onclick=mudarAparencia('h_"+hairstyle+"') style='background-color:#ffffff;background-position:"+(i*-53)+"px -159px;'></div>";
            }
            break;
        case "haircolors2":
            for (i=0;i<array_haircolors.length; i++) {
                haircolor = array_haircolors[i];
                haircolor_front = haircolor.split("_");
                html += "<div class='haircolors' id='hc_"+haircolor+"' onclick=mudarAparencia('hc_"+haircolor+"') style='background-color:#"+haircolor_front[0]+";'></div>";
            }
            break;
        case "facialhairs2":
            for (i=0;i<array_facialhairs.length; i++) {
                facialhair = array_facialhairs[i];
                haircolor_front = facialhair.split("_");
                html += "<div class='facialhairs' id='f_"+facialhair+"' onclick=mudarAparencia('f_"+facialhair+"') style='background-color:#ffffff;background-position:"+(i*-53)+"px -212px;'></div>";
            }
            break;
        case "clothes2":
            for (var i=0;i<array_clothes.length; i++) {
                clothe = array_clothes[i];
                html += "<div class='clothes' id='c_"+clothe+"' onclick=mudarAparencia('c_"+clothe+"') style='background-color:#ffffff;background-position:"+(i*-53)+"px -265px;'></div>";
            }
            break;
        case "fabriccolors2":
            for (var i=0;i<array_fabriccolors.length; i++) {
                fabriccolor = array_fabriccolors[i];
                html += "<div class='fabriccolors' id='c_f"+fabriccolor+"' onclick=mudarAparencia('c_f"+fabriccolor+"') style='background-color:#"+fabriccolor+";'></div>";
            }
            break;
        case "backgroundcolors2":
            for (var i=0;i<array_backgroundcolors.length; i++) {
                backgroundcolor = array_backgroundcolors[i];
                html += "<div class='backgroundcolors' id='"+backgroundcolor+"' onclick=mudarAparencia('"+backgroundcolor+"') style='background-color:#"+backgroundcolor+";'></div>";
            }
            break;
        case "glasses2":
            for (var i=0;i<array_glasses.length; i++) {
                glass = array_glasses[i];
                html += "<div class='glasses' id='g_"+glass+"' onclick=mudarAparencia('g_"+glass+"') style='background-color:#ffffff;background-position:"+(i*-53)+"px -313px;'></div>";
            }
            break;
        case "glassopacity2":
            for (var i=0;i<array_glassopacities.length; i++) {
                glassopacity = array_glassopacities[i];
                html += "<div class='glassopacity' id='o_"+glassopacity+"' onclick=mudarAparencia('o_"+glassopacity+"') style='background-color:#ffffff;'>"+glassopacity+"%</div>";
            }
            break;
        case "tattoos2":
            for (var i=0;i<array_tattoos.length; i++) {
                tattoo = array_tattoos[i];
                html += "<div class='tattoos' id='t_"+tattoo+"' onclick=mudarAparencia('t_"+tattoo+"') style='background-color:#ffffff;background-position:"+(i*-53)+"px -419px;'></div>";
            }
            break;
        case "accesories2":
            for (var i=0;i<array_accesories.length; i++) {
                accesory = array_accesories[i];
                html += "<div class='accesories' id='a_"+accesory+"' onclick=mudarAparencia('a_"+accesory+"') style='background-color:#ffffff;background-position:"+(i*-53)+"px -369px;'></div>";
            }
            break;
    }
    options_div.innerHTML = html
    abrirMenu()   
}

function mudarAparencia(id){
    const op_appearence = document.querySelector('#options_div')
    var array_op_appearence = op_appearence.children.namedItem(id).id
    var array_op_appearence2 = op_appearence.children.namedItem(id).id
    fbcolor = array_op_appearence.substr(0, 3)
    fbcolor2 = array_op_appearence
    if(fbcolor !== 'c_f'){
        fbcolor = ''
    }
    array_op_appearence = array_op_appearence.substr(0, 2)
    //console.log(fbcolor)
    //console.log(array_op_appearence)

    if(array_op_appearence  === 's_'){
        const skins_body = document.querySelector('#skincolor #skin #body')
        array_op_appearence2 = array_op_appearence2.substr(2)
        skins_body.removeAttribute('fill')
        skins_body.setAttribute('fill', '#'+array_op_appearence2)
        now_skin = array_op_appearence2
    }
    else if(array_op_appearence  === 'e_'){
        array_op_appearence2 = array_op_appearence2.substr(2)
        const eyes_antes = document.querySelector('#eyes #e_'+now_eyes)
        const eyes = document.querySelector('#eyes #e_'+array_op_appearence2)
        eyes_antes.style.display = 'none'
        eyes.style.display = 'block'    
        now_eyes = array_op_appearence2
    }
    else if(array_op_appearence  === 'eb'){
        array_op_appearence2 = array_op_appearence2.substr(3)
        const eyebrows_antes = document.querySelector('#eyebrows #eb_'+now_eyebrows)
        const eyebrows = document.querySelector('#eyebrows #eb_'+array_op_appearence2)
        eyebrows_antes.style.display = 'none'
        eyebrows.style.display = 'block'    
        now_eyebrows = array_op_appearence2
    }
    else if(array_op_appearence  === 'm_'){
        array_op_appearence2 = array_op_appearence2.substr(2)
        const mouths_antes = document.querySelector('#mouths  #m_'+now_mouths)
        const mouths = document.querySelector('#mouths  #m_'+array_op_appearence2)
        mouths_antes.style.display = 'none'
        mouths.style.display = 'block'
        now_mouths = array_op_appearence2
    }
    else if(array_op_appearence  === 'h_'){
        array_op_appearence2 = array_op_appearence2.substr(2)
        const hair_front_color = document.querySelector('#hair_front #h_'+array_op_appearence2+' .tinted')
        const hair_back_color = document.querySelector('#hair_back #h_'+array_op_appearence2+' .tinted')

        var color = now_haircolors
        now_haircolors = color
        color = color.split('_')

        const hair_front_antes = document.querySelector('#hair_front  #h_'+now_hairstyles)
        const hair_front = document.querySelector('#hair_front  #h_'+array_op_appearence2)
        console.log(array_op_appearence2)
        if(hair_front_antes !== null){
            hair_front_antes.style.display = 'none'
            hair_front.style.display = 'block'
            if(hair_front_color !== null){
                hair_front_color.removeAttribute('fill')
                hair_front_color.setAttribute('fill', '#'+color[0])
            }
        }
        else{
            hair_front.style.display = 'block'
            hair_front_color.removeAttribute('fill')
            hair_front_color.setAttribute('fill', '#'+color[0])
        }

        const hair_back_antes = document.querySelector('#hair_back  #h_'+now_hairstyles)
        const hair_back = document.querySelector('#hair_back  #h_'+array_op_appearence2)
        if(hair_back_antes !== null){
            hair_back_antes.style.display = 'none'
            hair_back.style.display = 'block'
            if(hair_back_color !== null){
                hair_back_color.removeAttribute('fill')
                hair_back_color.setAttribute('fill', '#'+color[1])    
            }
        }
        else{
            hair_back.style.display = 'block'
            hair_back_color.removeAttribute('fill')
            hair_back_color.setAttribute('fill', '#'+color[1])
        }
        now_hairstyles = array_op_appearence2
    }
    else if(array_op_appearence  === 'hc'){
        now_haircolors = array_op_appearence2.substr(3)
        console.log(now_haircolors)
        array_op_appearence2 = array_op_appearence2.substr(3)
        array_op_appearence2 = array_op_appearence2.split("_")
        const hair_front_color = document.querySelector('#hair_front #h_'+now_hairstyles+' .tinted')
        if(hair_front_color !== null){
            hair_front_color.removeAttribute('fill')
            hair_front_color.setAttribute('fill', '#'+array_op_appearence2[0])    
        }
        const hair_back_color = document.querySelector('#hair_back #h_'+now_hairstyles+' .tinted')
        if(hair_back_color !== null){
            hair_back_color.removeAttribute('fill')
            hair_back_color.setAttribute('fill', '#'+array_op_appearence2[1])   
        }
        const facialhair_color = document.querySelector('#facialhair #f_'+now_facialhairs+' .tinted')
        if(facialhair_color !== null){
            facialhair_color.removeAttribute('fill')
            facialhair_color.setAttribute('fill', '#'+array_op_appearence2[2])    
        }        
    }
    else if(array_op_appearence  === 'f_'){
        array_op_appearence2 = array_op_appearence2.substr(2)
        const facialhair_antes = document.querySelector('#facialhair #f_'+now_facialhairs)
        const facialhair = document.querySelector('#facialhair #f_'+array_op_appearence2)
        const facialhair_color = document.querySelector('#facialhair #f_'+array_op_appearence2+' .tinted')
        facialhair_antes.style.display = 'none'
        facialhair.style.display = 'block'
       
        color = now_haircolors.split("_");
        if(facialhair_color !== null){
            facialhair_color.removeAttribute('fill')
            facialhair_color.setAttribute('fill', '#'+color[2])    
        }
        now_facialhairs = array_op_appearence2

    }
    else if(array_op_appearence  === 'c_' && fbcolor === ''){
        array_op_appearence2 = array_op_appearence2.substr(2)
        const clothes_antes = document.querySelector('#clothes #c_'+now_clothes)
        const fabriccolors_color = document.querySelector('#clothes #c_'+array_op_appearence2+' .tinted')

        const clothes = document.querySelector('#clothes #c_'+array_op_appearence2)
        if(array_op_appearence2 !== null){
            clothes_antes.style.display = 'none'
            clothes.style.display = 'block'
            fabriccolors_color.removeAttribute('fill')
            fabriccolors_color.setAttribute('fill', '#'+now_fabriccolors)
  
            now_clothes = array_op_appearence2
        }
    }
    else if(fbcolor === 'c_f'){
        fbcolor2 = fbcolor2.substr(3)
        console.log(fbcolor2)
        const fabriccolors_color = document.querySelector('#clothes #c_'+now_clothes+' .tinted')
        console.log(fabriccolors_color)
        if(fbcolor2 !== null){
            fabriccolors_color.removeAttribute('fill')
            fabriccolors_color.setAttribute('fill', '#'+fbcolor2)    
            now_fabriccolors = fbcolor2
        }

    }
    else if(array_op_appearence  === 'g_'){
        array_op_appearence2 = array_op_appearence2.substr(2)
        const glasses_antes = document.querySelector('#glasses #g_'+now_glasses)
        const glasses = document.querySelector('#glasses #g_'+array_op_appearence2)
        glasses_antes.style.display = 'none'
        glasses.style.display = 'block'
        now_glasses = array_op_appearence2
    }
    else if(array_op_appearence  === 'o_'){
        array_op_appearence2 = array_op_appearence2.substr(2)
        console.log(array_op_appearence2)
        const glassopacity = document.querySelector('#glasses #g_'+now_glasses+' .glass')
        console.log(glassopacity)
        if(glassopacity !== null){
            console.log(glassopacity)
            glassopacity.removeAttribute('fill-opacity')
            glassopacity.setAttribute('fill-opacity', array_op_appearence2)  
            now_glassopacity = array_op_appearence2  
        }

    }
    else if(array_op_appearence  === 't_'){
        array_op_appearence2 = array_op_appearence2.substr(2)
        const tattoos_antes = document.querySelector('#tattoos #t_'+now_tattoos)
        const tattoos = document.querySelector('#tattoos #t_'+array_op_appearence2)
        tattoos_antes.style.display = 'none'
        tattoos.style.display = 'block'
        now_tattoos = array_op_appearence2
    }
    else if(array_op_appearence  === 'a_'){
        array_op_appearence2 = array_op_appearence2.substr(2)
        const accesories_antes = document.querySelector('#accesories #a_'+now_accesories)
        const accesories = document.querySelector('#accesories #a_'+array_op_appearence2)
        accesories_antes.style.display = 'none'
        accesories.style.display = 'block'
        now_accesories = array_op_appearence2
    }
    else{
        array_op_appearence2 = array_op_appearence2
        const background = document.querySelector('#background')
        background.removeAttribute('fill')
        background.setAttribute('fill', '#'+array_op_appearence2)
        now_backgrounds = array_op_appearence2   
    }
}

function primeiroLoad(){
    const options_title = document.querySelector('#options_title')
    const options_div = document.querySelector('#options_div')

    options_title.innerHTML = 'SELECT SKIN COLOR'
    options_div.innerHTML = ''
    var html = "";
    for (var i=0;i<array_skins.length; i++) {
        skin = array_skins[i];
        html += "<div class='skins' id='s_"+skin+"' onclick=mudarAparencia('s_"+skin+"') style='background-color:#"+skin+";'></div>";
    }
    options_div.innerHTML = html
}
primeiroLoad();