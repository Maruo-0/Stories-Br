const container = document.getElementById('container')
const quoteDisplayElement = document.getElementById('quoteDisplay')
const quoteInputElement = document.getElementById('quoteInput')
const timerElement = document.getElementById('timer')
const comecar = document.getElementById('comecar')
const continuar = document.getElementById('continuar')
const tema = document.getElementById('tema')
const explicacao = document.getElementById('explicacao')
const modal = document.querySelector('.modal-back')
const detalhes = document.getElementById('detalhes')
const detalhesFechar = document.querySelector('.modal span')
const reiniciar = document.getElementById('reiniciar')

quoteInputElement.addEventListener('input', () =>{
    const arrayQuote = quoteDisplayElement.querySelectorAll('span')
    const arrayValue = quoteInputElement.value.split('')
    let correct = true

    arrayQuote.forEach((characterSpan, index) =>{
        const character = arrayValue[index]
        if (character == null){
            characterSpan.classList.remove('correct')
            characterSpan.classList.remove('incorrect')
            correct = false
        }
        else if (character === characterSpan.innerText){
            characterSpan.classList.add('correct')
            characterSpan.classList.remove('incorrect')
        } 
        else{
            characterSpan.classList.remove('correct')
            characterSpan.classList.add('incorrect')
            correct = false
        }
    })
    if (correct) stopTimer()
})

comecar.addEventListener('click', () =>{
    timerElement.style.display = 'block'
    container.style.display = 'block'
    comecar.style.display = 'none'
    document.querySelector('.tema').style.display = 'none'
    reiniciar.style.display = 'block'
    confirm()
})
continuar.addEventListener('click', () =>{
    continuar.style.display = 'none'
    explicacao.style.display = 'none'
    confirm()
})
explicacao.onclick = () =>{
    modalOpen()
}
detalhesFechar.onclick = () =>{
    modal.style.display = 'none'
}
reiniciar.onclick = () =>{
    location.href = '?'
}

function confirm(){
    startTimer()
    renderNewQuote()
}

function getRandomQuote(){
    let random = null
    let detalhesMandar = null
    let contentMandar = null
    if(tema.value === 'personagens'){
        random = dados.Personagens.length
        let id = Math.floor(Math.random() * random)
        console.log(dados.Personagens[id].detalhes);
        
        detalhesMandar = dados.Personagens[id].detalhes
        contentMandar = dados.Personagens[id].content
    }
    else{
        random = dados.Chave.length
        let id = Math.floor(Math.random() * random)
        detalhesMandar = dados.Chave[id].detalhes
        contentMandar = dados.Chave[id].content
    }


    modalLoad(detalhesMandar)
    return contentMandar
}

async function renderNewQuote(){
    let quote = await getRandomQuote()
    quoteDisplayElement.innerText = ''
    quote.split('').forEach(character => {
        const characterSpan = document.createElement('span')
        characterSpan.innerText = character
        quoteDisplayElement.appendChild(characterSpan)
    })
    quoteInputElement.value = null
}

function modalLoad(detalhe){
    detalhes.innerHTML = detalhe
}
function modalOpen(){
    modal.style.display = 'block'
}

function startTimer(){
    timerElement.innerText = 0
    startTime = new Date()
    gameTimer = setInterval(() =>{
        timer.innerText = getTimerTime()
    }, 1000)
}

function getTimerTime(){
    return Math.floor((new Date() - startTime) / 1000)
}

function stopTimer(){
    clearInterval(gameTimer);
    continuar.style.display = 'block'
    explicacao.style.display = 'block'
}