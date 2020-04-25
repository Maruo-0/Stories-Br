
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
    new Question("Quem descobriu a América e em que ano esse fato aconteceu?", ["Colombo em 1492", "Dom Pedro em 1500","Pedro Alvares Cabral em 1500", "Napoleão em 1888"], "Pedro Alvares Cabral em 1500"),
    new Question("Qual o nome do tratado que era estabelecida uma linha imaginária localizada a 370 léguas a oeste das Ilhas de Cabo Verde, dividindo o mundo não europeu entre Portugal e Espanha?", ["Tratado de Versalhes", "Tratado de Tordesilhas", "Tratado de Cabo Verde", "Tratado de Divisões"], "Tratado de Tordesilhas"),
    new Question("Em 22 de Abril, homens da esquadra de Cabral avistaram um monte no litoral brasileiro. Qual nome foi apelidado?", ["Monte Cabral", "Monte Pascoa","Monte do Litoral", "Monte Pascoal"], "Monte Pascoal"),
    new Question("Em que data a carta escrita por Pero Vaz de Caminha foi enviada?", ["1 de junho de 1500", "10 de maio de 1501", "11 de julho de 1500", "1 de maio de 1500"], "1 de maio de 1500"),
    new Question("Qual o nome do navegador português que chegou ao território brasileiro em 1498?", ["Vasco da Gama", "Diego de Lepe", "Vicente Yañez Pinzón", "Duarte Pacheco Pereira"], "Duarte Pacheco Pereira")
];
 
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

