
// função de inicialização dos valores do questionário 
function Quiz(questions) {
    this.score = 0;
    this.questions = questions;
    this.questionIndex = 0;
}
 //definido o atributo de index do array
Quiz.prototype.getQuestionIndex = function() {
    return this.questions[this.questionIndex];
}
 //definito função ao atributo somando 1 ponto  na pontuação caso a resposta correta 
Quiz.prototype.guess = function(answer) {
    if(this.getQuestionIndex().isCorrectAnswer(answer)) {
        this.score++;
    } 
    this.questionIndex++;
}
 //definindo ao atributo de última questão  comparando e
Quiz.prototype.isEnded = function() {
    return this.questionIndex === this.questions.length;
}
 
 //definido 3 atributos da pergunta a função que recebe texto escolha e resposta 
function Question(text, choices, answer) {
    this.text = text;
    this.choices = choices;
    this.answer = answer;
}
 
Question.prototype.isCorrectAnswer = function(choice) {
    return this.answer === choice;
}
 
 //função para preencher os elementos do questionário
function populate() {
    if(quiz.isEnded()) {
        showScores();//  Renderizar a pontuação total
    }
    else {
        // mostrar questão
        var element = document.getElementById("question");
        element.innerHTML = quiz.getQuestionIndex().text;
 
        //Mostrar opções
        var choices = quiz.getQuestionIndex().choices;
        for(var i = 0; i < choices.length; i++) {
            var element = document.getElementById("choice" + i);
            element.innerHTML = choices[i];
            guess("btn" + i, choices[i]);
        }
 
        showProgress();
    }
};
 // Colentando atravéz do clique no botão a escolha do usuário
function guess(id, guess) {
    var button = document.getElementById(id);
    button.onclick = function() {
        quiz.guess(guess);
        populate();
    }
};
 
 // Mostrando o progresso atual entre total de perguntas 
function showProgress() {
    var currentQuestionNumber = quiz.questionIndex + 1;
    var element = document.getElementById("progress");
    element.innerHTML = "Questão " + currentQuestionNumber + " de " + quiz.questions.length;
};
 
//  função para Renderizar a pontuação total
function showScores() {
    var gameOverHTML = "<h1>Resultado</h1>";
    gameOverHTML += "<h2 id='score'> Sua Pontuação: " + quiz.score + " acertos </h2>";
    var element = document.getElementById("quiz");
    element.innerHTML = gameOverHTML;
};
 
// Criando as questões aqui, atravéz de um array de funções 
var questions = [
    new Question("Em que mês e ano D.Pedro I invadiu Portugal no comando de um exército?", ["Julho de 1832 ", "Maio de 1833","Julho de 1833", "Junho de 1832"], "Julho de 1832 "),   
    new Question("Em 1817, Dom Pedro I casou-se com Maria Leopoldina Josefa Carolina de Habsburgo, arquiduquesa da Áustria, filha do Imperador da Áustria. Quantos filhos tiveram ?", ["5", "7","9", "4"], "9"),   
    new Question("Em 7 de abril de ____  Dom Pedro I abdicou do trono de Imperador do Brasil?", ["1841", "1831","1822", "1833"], "1831"),   
    new Question("Que doença D.Pedro I contraiu na Cidade do Porto?", ["Tuberculose", "Pneumonia","Câncer", "Hipertensão"], "Tuberculose"),   
    new Question("Em 1821, antes da Independência, D. Pedro I era o quê?", ["Regente do Brasil", "Rei do Brasil ","Imperador do Brasil", "Rei de Portugal"], "Regente do Brasil")  
]
 // Colentando atravéz do clique no botão a escolha do usuário
 function guess(id, guess) {
    var button = document.getElementById(id);
    button.onclick = function() {
        quiz.guess(guess);
        populate();
    }
};
// Criando o questionário
var quiz = new Quiz(questions);
 
// mostrar Questionário
populate();

