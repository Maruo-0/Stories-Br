
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
    new Question("Em 23 de outubro de 1906, com o avião 14-Bis, ocorreu o primeiro voo da história. Como o dia ficou conhecido?", ["Dia do Avião", "Dia dos Ares","Dia da Aviação", "Dia do Vôo"], "Dia da Aviação"),
    new Question("Como foi chamado a primeira criação de Santos Dumont ?", ["Dirigível", "Brésil  “Brasil”, em francês", "Aeronave de asas fixas", "Canhão paradoxal"], "Brésil  “Brasil”, em francês"),
    new Question("Após saber que sua invenção foi usada para guerras, Dumont decidiu se dedicar a qual estudo?", ["Físico", "Astronomia","Psicologia", "Escritor"], "Astronomia"),
    new Question("Dumont ganhou em 19 de outubro de 1901, um prêmio que consistia em sair de Saint-Cloud, circundar a Torre Eiffel e voltar ao ponto de partida em 30 minutos. Qual era o nome desse prêmio?", ["Prêmio Saint-Cloud", "Prêmio Eiffel", "Prêmio Paris", "Prêmio Deutsch"], "Prêmio Deutsch"),
    new Question("Respectivamente, em qual ano Dumont nasceu e em qual houve seu falecimento?", ["1873-1932", "1871-1937", "1870-1955", "1875-1930"], "1873-1932")
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

