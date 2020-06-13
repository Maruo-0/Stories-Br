var array_skins = ["ffdbb4","edb98a","fd9841","fcee93","d08b5b","ae5d29","614335"];
var array_eyes = ["default","dizzy","eyeroll","happy","close","hearts","side","wink","squint","surprised","winkwacky","cry"];
var array_eyebrows = ["default","default2","raised","sad","sad2","unibrow","updown","updown2","angry","angry2"];
var array_mouths = ["default","twinkle","tongue","smile","serious","scream","sad","grimace","eating","disbelief","concerned","vomit"];
var array_hairstyles = ["bold","longhair","longhairbob","hairbun","longhaircurly","longhaircurvy","longhairdread","nottoolong","miawallace","longhairstraight","longhairstraight2","shorthairdreads","shorthairdreads2","shorthairfrizzle","shorthairshaggy","shorthaircurly","shorthairflat","shorthairround","shorthairwaved","shorthairsides"];
var array_haircolors = ["bb7748_9a4f2b_6f2912","404040_262626_101010","c79d63_ab733e_844713","e1c68e_d0a964_b88339","906253_663d32_3b1d16","f8afaf_f48a8a_ed5e5e","f1e6cf_e9d8b6_dec393","d75324_c13215_a31608","59a0ff_3777ff_194bff"];
var array_facialhairs = ["none","magnum","fancy","magestic","light"];
var array_clothes = ["vneck","sweater","hoodie","overall","blazer"];
var array_fabriccolors = ["545454","65c9ff","5199e4","25557c","e6e6e6","929598","a7ffc4","ffdeb5","ffafb9","ffffb1","ff5c5c","e3adff"];
var array_backgroundcolors = ["ffffff","f5f6eb","e5fde2","d5effd","d1d0fc","f7d0fc","d0d0d0"];
var array_glasses = ["none","rambo","fancy","old","nerd","fancy2","harry"];
var array_glassopacities = ["0.10","0.25","0.50","0.75","1.00"];
var array_tattoos = ["none","harry","airbender","krilin","front","tribal","tribal2","throat"];
var array_accesories = ["none","earphones","earring1","earring2","earring3"];
var array_current_skincolor = "edb98a";
var array_current_hairstyle = "longhair";
var array_current_haircolor = "bb7748_9a4f2b_6f2912";
var array_current_fabriccolors = "545454";
var array_current_backgroundcolors = "ffffff";
var array_current_glassopacity = 0.5;

  
var now_skin
var now_eyes
var now_eyebrows
var now_mouths
var now_hairstyles
var now_haircolors
var now_facialhairs
var now_clothes
var now_fabriccolors
var now_backgrounds
var now_glasses
var now_glassopacity
var now_tattoos
var now_accesories

function random() {
	var rand_skins = array_skins[Math.floor(Math.random()*array_skins.length)];
	var rand_eyes = array_eyes[Math.floor(Math.random()*array_eyes.length)];
	var rand_eyebrows = array_eyebrows[Math.floor(Math.random()*array_eyebrows.length)];
	var rand_mouths = array_mouths[Math.floor(Math.random()*array_mouths.length)];
	var rand_hairstyles = array_hairstyles[Math.floor(Math.random()*array_hairstyles.length)];
	var rand_haircolors = array_haircolors[Math.floor(Math.random()*array_haircolors.length)];
	var rand_facialhairs = array_facialhairs[Math.floor(Math.random()*array_facialhairs.length)];
	var rand_clothes = array_clothes[Math.floor(Math.random()*array_clothes.length)];
	var rand_fabriccolors = array_fabriccolors[Math.floor(Math.random()*array_fabriccolors.length)];
	var rand_backgroundcolors = array_backgroundcolors[Math.floor(Math.random()*array_backgroundcolors.length)];
	var rand_glasses = array_glasses[Math.floor(Math.random()*array_glasses.length)];
	var rand_glassopacities = array_glassopacities[Math.floor(Math.random()*array_glassopacities.length)];
	var rand_tattoos = array_tattoos[Math.floor(Math.random()*array_tattoos.length)];
	var rand_accesories = array_accesories[Math.floor(Math.random()*array_accesories.length)];
	array_current_skincolor = rand_skins;
	array_current_fabriccolors = rand_fabriccolors;
	array_current_backgroundcolors = rand_backgroundcolors;
    array_current_glassopacity = rand_glassopacities;

    now_skin = rand_skins
    now_eyes = rand_eyes
    now_eyebrows = rand_eyebrows
    now_mouths = rand_mouths
    now_hairstyles = rand_hairstyles
    now_haircolors = rand_haircolors
    now_facialhairs = rand_facialhairs
    now_clothes = rand_clothes
    now_fabriccolors = rand_fabriccolors
    now_backgrounds = rand_backgroundcolors
    now_glasses = rand_glasses
    now_glassopacity = rand_glassopacities
    now_tattoos = rand_tattoos
    now_accesories = rand_accesories

    const skins_body = document.querySelector('#skincolor #skin #body')
    const eyes_antes = document.querySelector('#eyes  g')
    const eyebrows_antes = document.querySelector('#eyebrows  g')
    const mouths_antes = document.querySelector('#mouths  g')

    skins_body.removeAttribute('fill')
    skins_body.setAttribute('fill', '#'+rand_skins)



    const eyes_depois = document.querySelector('#eyes  #e_'+rand_eyes)
    eyes_antes.style.display = 'none'
    eyes_depois.style.display = 'block'

    const eyebrows_depois = document.querySelector('#eyebrows  #eb_'+rand_eyebrows)
    eyebrows_antes.style.display = 'none'
    eyebrows_depois.style.display = 'block'

    const mouths_depois = document.querySelector('#mouths  #m_'+rand_mouths)
    mouths_antes.style.display = 'none'
    mouths_depois.style.display = 'block'

    array_current_hairstyle = rand_hairstyles;
    const hair_front_depois = document.querySelector('#hair_front  #h_'+rand_hairstyles)
    if(hair_front_depois !== null){
        hair_front_depois.style.display = 'block'
    }
    const hair_back_depois = document.querySelector('#hair_back  #h_'+rand_hairstyles)
    if(hair_back_depois !== null){
        hair_back_depois.style.display = 'block'
    }

	var color = rand_haircolors
    color = color.split("_");
    const hair_front_color = document.querySelector('#hair_front #h_'+array_current_hairstyle+' .tinted')
    if(hair_front_color !== null){
        hair_front_color.removeAttribute('fill')
        hair_front_color.setAttribute('fill', '#'+color[0])
    }
    const hair_back_color = document.querySelector('#hair_back #h_'+array_current_hairstyle+' .tinted')
    if(hair_back_color !== null){
        hair_back_color.removeAttribute('fill')
        hair_back_color.setAttribute('fill', '#'+color[1])

    }

    const facialhair = document.querySelector('#facialhair #f_'+rand_facialhairs)
    const facialhair_color = document.querySelector('#facialhair #f_'+rand_facialhairs+' .tinted')
    if(facialhair_color !== null){
        facialhair_color.removeAttribute('fill')
        facialhair_color.setAttribute('fill', '#'+color[2])    
        facialhair.style.display = 'block'
    }

    const clothes = document.querySelector('#clothes #c_'+rand_clothes)
    clothes.style.display = 'block'
    const clothes_color = document.querySelector('#clothes #c_'+rand_clothes+' .tinted')
    clothes_color.removeAttribute('fill')
    clothes_color.setAttribute('fill', '#'+rand_fabriccolors)    


    const glasses = document.querySelector('#glasses #g_'+rand_glasses)
    if(glasses !== null){
        glasses.style.display = 'block'
        const glasses_opacity = document.querySelector('#g_'+rand_glasses+' .glass')
        glasses_opacity.removeAttribute('fill-opacity')
        glasses_opacity.setAttribute('fill-opacity', rand_glassopacities)    
    }

    const background = document.querySelector('#background')
    background.removeAttribute('fill')
    background.setAttribute('fill', '#'+rand_backgroundcolors)    

    const tattoos = document.querySelector('#tattoos #t_'+rand_tattoos)
    if(tattoos !== null){
        tattoos.style.display = 'block'
    }

    const accesories = document.querySelector('#accesories #a_'+rand_accesories)
    if(accesories !== null){
        accesories.style.display = 'block'
    }
}

function resetar(){
    const eyes_depois = document.querySelector('#eyes  #e_'+now_eyes)
    eyes_depois.style.display = 'none'

    const eyebrows_depois = document.querySelector('#eyebrows  #eb_'+now_eyebrows)
    eyebrows_depois.style.display = 'none'

    const mouths_depois = document.querySelector('#mouths  #m_'+now_mouths)
    mouths_depois.style.display = 'none'

    const hair_front_depois = document.querySelector('#hair_front  #h_'+now_hairstyles)
    if(hair_front_depois !== null){
        hair_front_depois.style.display = 'none'
    }
    const hair_back_depois = document.querySelector('#hair_back  #h_'+now_hairstyles)
    if(hair_back_depois !== null){
        hair_back_depois.style.display = 'none'
    }

	var color = now_haircolors
    color = color.split("_");
    const hair_front_color = document.querySelector('#hair_front #h_'+array_current_hairstyle+' .tinted')
    if(hair_front_color !== null){
        hair_front_color.removeAttribute('fill')
        hair_front_color.setAttribute('fill', '#'+color[0])
    }
    const hair_back_color = document.querySelector('#hair_back #h_'+array_current_hairstyle+' .tinted')
    if(hair_back_color !== null){
        hair_back_color.removeAttribute('fill')
        hair_back_color.setAttribute('fill', '#'+color[1])
    }

    const facialhair = document.querySelector('#facialhair #f_'+now_facialhairs)
    const facialhair_color = document.querySelector('#facialhair #f_'+now_facialhairs+' .tinted')
    if(facialhair_color !== null){
        facialhair_color.removeAttribute('fill')
        facialhair_color.setAttribute('fill', '#'+color[2])    
        facialhair.style.display = 'none'
    }

    const clothes = document.querySelector('#clothes #c_'+now_clothes)
    clothes.style.display = 'none'
    const clothes_color = document.querySelector('#clothes #c_'+now_clothes+' .tinted')
    clothes_color.removeAttribute('fill')
    clothes_color.setAttribute('fill', '#'+now_fabriccolors)    


    const glasses = document.querySelector('#glasses #g_'+now_glasses)
    if(glasses !== null){
        glasses.style.display = 'none'
        const glasses_opacity = document.querySelector('#g_'+now_glasses+' .glass')
        glasses_opacity.removeAttribute('fill-opacity')
        glasses_opacity.setAttribute('fill-opacity', now_glassopacity)    
    }

    const background = document.querySelector('#background')
    background.removeAttribute('fill')
    background.setAttribute('fill', '#'+now_backgrounds)    

    const tattoos = document.querySelector('#tattoos #t_'+now_tattoos)
    if(tattoos !== null){
        tattoos.style.display = 'none'
    }

    const accesories = document.querySelector('#accesories #a_'+now_accesories)
    if(accesories !== null){
        accesories.style.display = 'none'
    }
}

random();

const randomBtn = document.querySelector('#random')
randomBtn.addEventListener('click', () =>{
    resetar()
    random()
})