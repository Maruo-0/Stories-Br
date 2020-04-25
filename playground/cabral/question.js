
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
    new Question("Em qual região do Brasil Pedro Álvares Cabral desembarcou?", ["São Vicente, em São Paulo", "Foz do Rio Amazonas ","Ilha de Marajó", "Porto Seguro, no estado da Bahia"], "Porto Seguro, no estado da Bahia"),
    new Question("Quando partiu das terras recém-descobertas em direção às Índias, Pedro Álvares Cabral encarregou qual dos membros de suas caravelas a ir para a corte portuguesa informar ao rei sobre a descoberta?", ["Pero Vaz de Caminha", "Cristóvão Colombo", "Gaspar de Lemos", "Mem de Sá"], "Mem de Sá"),
    new Question("Qual foi o PRIMEIRO nome que o nosso país teve, que foi dado por Pedro Álvares Cabral?", ["Terra dos Papagaios", "Terra de Santa Cruz","Terra do Brasil", "Ilha de Vera Cruz."], "Ilha de Vera Cruz."),
    new Question("Em que dia, mês e ano Cabral chegou ao território que hoje é chamado Brasil?", ["12 de novembro de 1520", "22 de abril de 1500", "22 de setembro de 1500", "22 de setembro de 1500"], "22 de abril de 1500"),
    new Question("Pedro Álvares Cabral chegou ao Brasil acompanhado de quantas frotas e quantos homens?", ["13 navios, 1500 homens", "10 navios, 1000 homens", "7 navios, 800 homens", "5 navios, 600 homens"], "13 navios, 1500 homens")
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

