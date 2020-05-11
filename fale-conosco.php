<?php
require('config/db.php');

if(isset($_GET['idpag'])){
    $idpag = mysqli_real_escape_string($conn, $_GET['idpag']);
    $assunto = mysqli_real_escape_string($conn, $_GET['assunto']);
    $nome = mysqli_real_escape_string($conn, $_GET['nome']);
    $email = mysqli_real_escape_string($conn, $_GET['email']);
    $mensagem = mysqli_real_escape_string($conn, $_GET['mens']);
    if($idpag === ''){
        $query = "insert into `mensagens` (`assunto`, `nome`, `email`, `mens`, `salvar`) values ('$assunto', '$nome', '$email', '$mensagem', '0')";
    }else {
        $query = "insert into `mensagens` (`pag_erro_id`, `assunto`, `nome`, `email`, `mens`, `salvar`) values ('$idpag', '$assunto', '$nome', '$email', '$mensagem', '0')";
    }
    if(mysqli_query($conn, $query)){
        mysqli_close($conn);
        exit();
    }else{
        echo $idpag;

        echo '<h2>Houve um problema</h2><h4>Tente novamente mais tarde</h4>';
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="manifest.json"> 
    <link rel="shortcut icon" type="image/png" href="resources/favicon.png"/>
    <title>Fale Conosco - StoriesBr</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="resources/css/form.css">
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-md bg-light">
        <a class="navbar-brand" href="/StoriesBr/">Stories <img src="resources/src/br.svg" alt="Stores BR" id="logo2" style="width: 60px"></a>
    </nav>
        
    <div class="container">
        <h1 id="titulo">Fale Conosco</h1>
        <p>Nos mande sugestões e críticas para nos ajudar a melhorar.</p>
        <hr>
    
        <labe>Nome (obrigatório)</labe>
        <input type="text" name="nome" id="nome" placeholder="Nome" required>

        <label>Email (obrigatório)</label>
        <input type="text" name="email" id="email" placeholder="exemplo@exemplo.com" required>
    
        <label>Assunto</label>
        <div class="assunto">
            <select name="assunto" id="assunto">
                <optgroup label="Erro de ortografia">
                    <option value="portugues">Português</option>
                    <option value="ingles">Inglês</option>
                </optgroup>
                <option value="bug">Erro de função</option>
                <option value="autoria">Autoria</option>
                <option value="melhorias">Melhorias</option>
                <option value="outros">Outros</option>
            </select>
            <input onkeyup="mudarAssuntoValor()" type="text" name="assunto_outro" id="assunto_outro" placeholder="Descreva seu assunto...">
        </div> 

        <label>Mensagem / Reporte</label>
        <textarea name="mensagem" id="mensagem" rows="8" required></textarea>
        <div id="resultbox">
            <div id="result">
                <span class="close" onclick="fecharPag()">&times;</span>
                <h2>Mensagem enviada</h2>
            </div>
        </div>
        <div id="result">
            <span class="close" onclick="fecharPag()">&times;</span>
            <h2>Mensagem enviada</h2>
        </div>
        <button onclick="enviarMens()" name="enviar_mensagem" class="registerbtn">Enviar</button>
    </div>

    <script>
        const assunto = document.querySelector('#assunto')
        const assunto_outro = document.querySelector('#assunto_outro')
        let assunto_valor = assunto.value
        assunto.addEventListener('change', () =>{
            assunto_valor = assunto.value
            if(assunto.value === 'outros') assunto_outro.style.display = 'block'
            else assunto_outro.style.display = 'none'; assunto_outro.value = ''
        })
        function mudarAssuntoValor(){
            assunto_valor = assunto_outro.value
        }
        
        let id = ''
        if(localStorage.getItem('titulo') !== null){
            const titulo_atual = document.querySelector('#titulo')
            const titulo = localStorage.getItem('titulo')
            id = localStorage.getItem('id')
            console.log(titulo)
            console.log(id)
            titulo_atual.textContent = 'Reportar erro em: '+titulo
        }
        function CriaRequest() {
            try{
                request = new XMLHttpRequest();        
            }catch (IEAtual){
                
                try{
                    request = new ActiveXObject("Msxml2.XMLHTTP");       
                }catch(IEAntigo){
                
                    try{
                        request = new ActiveXObject("Microsoft.XMLHTTP");          
                    }catch(falha){
                        request = false;
                    }
                }
            }
            
            if (!request) 
                alert("Seu Navegador não suporta Ajax!");
            else
                return request;
        }
        function enviarMens(){
            const resultbox = document.querySelector('#resultbox');
            const result = document.querySelectorAll('#result');
            const nome_elemt = document.querySelector('#nome')
            const email_elemt = document.querySelector('#email')
            const mensagem_elemt = document.querySelector('#mensagem')
            nome = nome_elemt.value
            email = email_elemt.value
            mensagem = mensagem_elemt.value
            url = '?idpag='+id+'&assunto='+assunto_valor+'&nome='+nome+'&email='+email+'&mens='+mensagem
            var xmlreq = CriaRequest();
            xmlreq.open("GET", url, true);
            xmlreq.onreadystatechange = function(){
                if (xmlreq.readyState == 4) {
                    nome_elemt.value = ''
                    email_elemt.value = ''
                    mensagem_elemt.value = ''
                    localStorage.removeItem("id");
                    localStorage.removeItem("titulo");
                    result[0].style.display = 'flex';
                    if (xmlreq.status == 200) {
                        resultbox.style.display = 'flex'
                    }else{
                        result[1].innerHTML = xmlreq.responseText
                    }
                }
            };
            xmlreq.send(null);
        }
        function fecharPag(){
            window.location.href = '../StoriesBr/'
        }
    </script>
</body>
</html>