<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="resources/favicon.png"/>
    <link rel="manifest" href="manifest.json">   
    <title>Aplicativo - Stories Br</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="resources/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <style>
        body{
            height: 100%;
            padding-top: 150px;
            background: #4ac575;
        }
        .app-container{
            margin: 0 20px 0px 20px;
            border-top-left-radius: 7px;
            border-top-right-radius: 7px;
            background: white;
        }
        .app-title{
            border-bottom: 1px solid #ececec;
            padding: 10px;
        }
        .app-title h1{
            line-height: 24px;
            font-size: 1.2em;
            margin: 0;
        }
        .app-apresentacao{
            display: grid;
            grid-template-columns: 350px auto;
            padding: 10px;
        }
        .app-apresentacao div{
            padding: 10px;
        }
        .descricao{
            display: flex;
            flex-direction: column;
            /* justify-content: center; */
        }
        .button{
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid #0000;
            border-radius: 2px;
            color: #fff;
            background-color: #337ab7;
        }
        .detalhes{
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        li{
            margin: 7px;
        }
        span{
            font-weight: bold;
        }
        .app-container img{
            width: 300px;
        }
        @media (max-width: 600px){
            .app-container{
                margin: 0;
                border-radius: 7px;
                background: white;
            }

            .app-apresentacao{
                grid-template-columns: unset;
                grid-template-rows: auto 200px;
                padding: 10px;
            }

        }
    </style>
</head>
<body>
    <nav class="navbar container navbar-expand-xl navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="/" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" >
          Stories <img data-aos="zoom-in-left"src="resources/src/br.svg" alt="Stories Br">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação" data-aos="fade-down-left">
            <span class="navbar-toggler-icon"></span>
        </button> 
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link" href="livros">Biblioteca</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#saibamais">Saiba mais</a>
                </li>
            
          <?php 
            if (isset($_SESSION['userid'])){            
              echo  '<li class="nav-item"><a class="nav-link" href="perfil">Perfil</a></li>';
                  
              if ($_SESSION['isadmin'] === 2  || $_SESSION['isadmin'] === 1) {//checar admin
                  if ($_SESSION['isadmin'] === 2) echo  '<li class="nav-item"><a class="nav-link" href="admin/paineladmin">Painel Admin</a></li>';
                  echo  '<li class="nav-item active">
                          <a class="nav-link" href="admin/edicao">Criar</a>
                        </li>';
                }                  
                echo  '<form action="config/login.inc.php?sair=true" method="post">
                        <button type="submit" name="logout" class="btn btn-danger">Sair</button>
                      </form>';
            }
            else {
              echo '<li class="nav-item">
                      <a class="nav-link "  href="inscricao">Inscrever-se</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link "  href="login" tabindex="-1" aria-disabled="true">Entrar</a>
                    </li>';
            }
            ?>
              <form class="form-inline my-2 my-lg-0" method="POST" action="livros">
                <input class="form-control mr-sm-2" type="text" placeholder="Pesquisar" aria-label="Pesquisar"data-aos="fade-down-left" name="search_title" id="search_title">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" data-aos="fade-down-left" name="search" id="search">Pesquisar</button>
              </form>
            </ul>
        </div>
    </nav>

    <div class="app-container">
        <div class="app-title">
            <h1>Aplicativo - Stories Br</h1>
        </div>
        <div class="app-apresentacao">
            <div>
                <center><img src="resources/app/app.png" alt="inicio-app-stories-br"></center>
            </div>
            <div class="descricao">
                <center>
                <h1>App Stories Br</h1>
                <p>Quer usar o stories br no seu smartphone com mais conforto e facilidade?</p>
                <a class="button" href="https://drive.google.com/file/d/1pRAesBmFW4NfZA46X0nCJZzlqKPPOxE1/view?usp=sharing">Baixe o app aqui</a>
                </center>
            </div>
        </div>
        <div class="detalhes">
            <h1>Como instalar?</h1><br>
            <p>Devido a limitações momentâneas, o aplicativo não está disponivel em nenhuma loja de aplicativos.</p>
            <p>Mas seguindo as instruções abaixo ainda é possível instalar e utiliza-lo sem quaisquer problemas.</p>
            <br>
            <p>Após baixar o aplicativo siga estas instruções:</p>
            <ul>
                <li>Localize o apk baixado em seu smartphone;</li>
                <li>Execute-o, e clique na opção <span>configurações</span>;</li>
            </ul>
            <center><img src="resources/app/instalacao1.png"  alt="instalando o app"></center>
            <ul><li>Então ative a opção <span>Fontes desconhecidas</span>;</li></ul>
            <center><img src="resources/app/instalacao2.png"  alt="instalando o app 2"></center>
            <ul><li>Agora você pode instalar o app sem problemas.</li></ul>
        </div>
    </div>
    <footer class="container-fluid">
        <ul class="nav list">
            <li class="nav-item active">
            <a class="nav-link" href="fale-conosco" target="_blank">Fale Conosco</a>
            </li>
        </ul>
        <div class="social-buttons">
            <a href="playground/videos"><i class="fab fa-youtube"></i></a>
        </div>
        <p class="esp">Desenvolvido por - ADS-5 UNIBR-SV 2020</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>