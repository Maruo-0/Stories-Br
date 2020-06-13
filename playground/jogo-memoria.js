const cardBoard = document.querySelector("#cardboard");
const tema = document.querySelector(".tema");
const imgs = [
  'dJoão-jm.png',
  'dpedro1-jm.png',
  'princesaisabel-jm.png',
  'martimafonso-jm.png',
  'dummont-jm.png',
  'goulart-jm.png',
  'gvargas-jm.png',
  'machadoassis-jm.png',
  'goulart-jm.png',
  'gvargas-jm.png',
  'pedroac-jm.png',
  'princesaisabel-jm.png',
  'martimafonso-jm.png',
  'machadoassis-jm.png',
  'maua-jm.png',
  'dJoão-jm.png',
  'dpedro1-jm.png',
  'maua-jm.png',
  'dummont-jm.png',
  'pedroac-jm.png'
];

embaralhar(imgs)
embaralhar(imgs)
embaralhar(imgs)
let cardHTML = "";


imgs.forEach(img => {
  cardHTML += `<div class="memory-card" data-card="${img}">
      <img class="front-face" src="img/${img}"/>
      <img class="back-face" src="img/br-logo.svg">
  </div>`;
});

cardBoard.innerHTML = cardHTML;

/* Fim renderização html */

const cards = document.querySelectorAll(".memory-card");

let firstCard, secondCard;
let lockCards = false;

function flipCard() {
    if (lockCards) return false;
    this.classList.add("flip");
    if (!firstCard) {
        firstCard = this;
        return false;
    }    
    secondCard = this;
    if(firstCard === secondCard) return false
    checkForMatch();
}
/*checagem*/
function checkForMatch() {
    let isMatch = firstCard.dataset.card === secondCard.dataset.card;
    !isMatch ? unFlipCards() : resetCards(isMatch);
}
/*Proíbe mais de duas cartas mostradas*/
function unFlipCards() {
    lockCards = true;
    setTimeout(() => {
        firstCard.classList.remove("flip");
        secondCard.classList.remove("flip");

        resetCards();
    }, 1000);

    (function shuffle() {
        cards.forEach(card => {
            let rand = Math.floor(Math.random() * 12);
            card.style.order = rand;
        })
    })
}
/*  Abaixo reseta as cartas */
function resetCards(isMatch = false) {
    if (isMatch) {
        firstCard.removeEventListener("click", flipCard);
        secondCard.removeEventListener("click", flipCard);
        checknames();
        ponto();
    }
    [firstCard, secondCard, lockCards] = [null, null, false];
}

cards.forEach(card => card.addEventListener("click", flipCard));
const name = document.querySelector(".names");
const pontos = document.querySelector(".soma");

function checknames() {
    if (secondCard.dataset.card == 'gvargas-jm.png') {
      name.innerHTML += `<span>Getúlio Vargas</span><br>`
    } else if (secondCard.dataset.card == 'princesaisabel-jm.png') {
      name.innerHTML += `<span>Princesa Isabel</span><br>`
    } else if (secondCard.dataset.card == 'dJoão-jm.png') {
      name.innerHTML += `<span>Dom João</span><br>`

    } else if (secondCard.dataset.card == 'maua-jm.png') {
      name.innerHTML += `<span>Barão de Maua</span><br>`

    } else if (secondCard.dataset.card == 'goulart-jm.png') {
      name.innerHTML += `<span>João Goulart</span><br>`

    } else if (secondCard.dataset.card == 'dpedro1-jm.png') {
      name.innerHTML += `<span>Dom Pedro I</span><br>`

    } else if (secondCard.dataset.card == 'machadoassis-jm.png') {
      name.innerHTML += `<span>Machado de Assis</span><br>`

    } else if (secondCard.dataset.card == 'pedroac-jm.png') {
      name.innerHTML += `<span>Pedro Álvares Cabral</span><br>`
    }
    else if (secondCard.dataset.card == 'martimafonso-jm.png') {
      name.innerHTML += `<span>Martim Afonso de Souza</span><br>`
    
    } else if (secondCard.dataset.card == 'dummont-jm.png') {
      name.innerHTML += `<span>Santos Dumont</span><br>`
    }
}

function embaralhar(imgs) {
    for (var i = imgs.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [imgs[i], imgs[j]] = [imgs[j], imgs[i]];
    }
    return imgs;
}

var acertos=0;
function ponto(){
    acertos = acertos+10 ; 
    pontos.innerHTML=`<h3>Pontos: ${Number(acertos)}</h3>`;
}

function Refresh(){
    window.location.reload();
}