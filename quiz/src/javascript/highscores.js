let highScoresList = document.getElementById("highScoresList");
let highScores = JSON.parse(localStorage.getItem("highScores")) || [];


function printUniqueResults (highScores, name) {
    return highScores.filter((item, index, array) => {
      return array.map((mapItem) => mapItem[name]).indexOf(item[name]) === index
    })
  }
  highScores = printUniqueResults(highScores, 'name')


highScoresList.innerHTML = highScores
    .map(score => {
       
        return `<li class="high-score">${score.name} = ${score.score}</li>`;
    })