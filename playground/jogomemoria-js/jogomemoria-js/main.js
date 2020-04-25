const cardBoard = document.querySelector("#cardboard");
const imgs = [
'dJoão-jm.png',
'dpedro1-jm.png',
'goulart-jm.png',
'gvargas-jm.png',
'machadoassis-jm.png',
'maua-jm.png',
'pedroac-jm.png',
'princesaisabel-jm.png',
];

let cardHTML = "";

imgs.forEach(img => {
  cardHTML += `<div class="memory-card" data-card="${img}">
    <img class="front-face" src="img/${img}"/>
    <img class="back-face" src="img/br-logo.svg">
  </div>`;
});

cardBoard.innerHTML = cardHTML + cardHTML;

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

    (function shuffle(){
        cards.forEach( card=> {
            let rand = Math.floor(Math.random()*12);
            card.style.order = rand;
        }) 
    })

}
  /*  Abaixo reseta as cartas */ 
  function resetCards(isMatch = false) {
    if (isMatch) {
      firstCard.removeEventListener("click", flipCard);
      secondCard.removeEventListener("click", flipCard);
    }
  
    [firstCard, secondCard, lockCards] = [null, null, false];
  }
  
  cards.forEach(card => card.addEventListener("click", flipCard));