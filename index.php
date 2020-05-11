<?php session_start();?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" type="image/png" href="/StoriesBr/resources/favicon.png"/>
  <link rel="manifest" href="/StoriesBr/manifest.json"> 
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="resources/css/animate.min.css">
  <link rel="stylesheet" href="resources/css/index.css">
  <link rel="stylesheet" href="resources/css/aos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">


  <title>Stories Br</title>
</head>

<body>
      <nav class="navbar container navbar-expand-xl navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="/StoriesBr/" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" >
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
                  <a class="nav-link" href="#">Saiba mais</a>
                </li>
            
        <?php 
            if (isset($_SESSION['userid'])){            
              echo  '<li class="nav-item"><a class="nav-link" href="perfil">Perfil</a></li>';
                  
              if ($_SESSION['isadmin'] === 2  || $_SESSION['isadmin'] === 1) {//checar admin
                  if ($_SESSION['isadmin'] === 2) echo  '<li class="nav-item"><a class="nav-link" href="/StoriesBr/admin/paineladmin">Painel Admin</a></li>';
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

      <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="overlay1 d-block w-100"></div>
            <div class="overlay"></div>
            <div class="carousel-caption  d-md-block">
              <h2 class="animated bounceInLeft" style="animation-delay: 1s">Descobrimento do Brasil</h2>
              <p class="animated fadeInUp" style="animation-delay: 2s">A chegada de Cabral ao território brasileiro representou o início de uma conquista sobre o descobrimento</p>
              <p class="animated zoomIn" style="animation-delay: 3s"><a href="#">saiba mais</a></p>
            </div>

          </div>
          <div class="carousel-item">
            <div class="overlay2 d-block w-100"></div>
            <div class="overlay"></div>
            <div class="carousel-caption d-md-block">
              <h2 class="animated bounceInDown" style="animation-delay: 1s">Brasil no Período Colonial</h2>
              <p class="animated fadeInUp" style="animation-delay: 2s">Martim Afonso de Sousa (1532) combateu a pirataria francesa. Da mesma forma, ele instalou em São Vicente, a primeira povoação dotada de um engenho para produção de açúcar.</p>
              <p class="animated zoomIn" style="animation-delay: 3s"><a href="#">saiba mais</a></p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="overlay3 d-block w-100"></div>
            <div class="overlay"></div>
            <div class="carousel-caption d-md-block">
              <h2 class="animated bounceInRight" style="animation-delay: 1s">Independência do Brasil</h2>
              <p class="animated fadeInUp" style="animation-delay: 2s">Brasil determinou o fim do laço colonial com Portugal, declarando-se como uma nação independente</p>
              <p class="animated zoomIn" style="animation-delay: 3s"><a href="#">saiba mais</a></p>
            </div>
          </div>
        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Próximo</span>
        </a>

      </div>

      <section class="container-fluid lista-img">
        <ul class="ul-img">
            <li class="li-img">
                <a class="a-img" href="playground/atividades">Quadrinhos</a>
                <img class="l-img" src="resources/src/img01.svg" alt="">
            </li>
            <li class="li-img">
                <a  class="a-img"href="livros"> Artigos com Áudio </a>
                <img class="l-img"src="resources/src/img02.svg" alt="">
            </li>
            <li class="li-img">
                <a class="a-img" href="#">Curiosidades</a>
                <img class="l-img" src="resources/src/img03.svg" alt="">
            </li>
            <li class="li-img">
                <a  class="a-img" href="playground/atividades">vídeos </a>
                <img class="l-img"src="resources/src/img04.svg" alt="">
            </li>
            <li class="li-img">
                <a  class="a-img" href="playground/atividades">Jogo da memória </a>
                <img class="l-img"src="resources/src/img05.svg" alt="">
            </li>
            <li class="li-img">
                <a  class="a-img" href="#">Quiz de perguntas</a>
                <img class="l-img"src="resources/src/img06.svg" alt="">
            </li>
        </ul>
      </section>

      <section class="container destaques">
        <div class="cont-card ">
            <a href="livros">
              <div class="card">
                <div class="imgBx">
                    <img  data-aos="fade-right"src="resources/src/estudar.png" alt="">
                </div>
                  <div data-aos="zoom-in-left">
                    <div class="contentBx">
                        <div class="content">
                            <h2>Estude a história do Brasil aqui</h2><br>
                            <p>Você pode aprender quando e onde
                                quiser, e se preferir até mesmo escutar.
                                Treine seu inglês lendo e escutando
                                nossa história na lingua mais falada do mundo.</p>
                        </div>
                    </div>
                  </div>
              </div>
            </a>  
            <a href="playground/atividades">
              <div class="card">
                <div class="imgBx">
                    <img data-aos="zoom-in-left" src="resources/src/cabral.png" alt="">  
                </div>
                <div data-aos="fade-right" class="contentBx">
                    <div class="content">
                        <h2>Divirta-se com nossos quadrinhos</h2><br><br>
                        <p>Acha história muito dificil? Aprenda lendo nossos quadrinhos, ou jogando jogos.</p>
                    </div>
                </div>
              </div>
            </a>
        </div>  
      </section>
      <div class="container">
        <section class="row descricao" style="margin-left: 0;margin-right: 0;">

          <div class="col-md-12" style="margin-bottom: 40px">
            <h3 data-aos="flip-left">Vantagens do StoriesBr</h3><hr>
            <span  data-aos="zoom-in-down">
              No StoriesBr você obtem algumas vantagens <br>
              que o nosso site proporciona para um<br>
              conhecimento mais eficaz. confira a baixo
            </span>
          </div>

          <div class="col-md-4" style="margin-bottom: 20px">
            <img data-aos="fade-right" src="resources/src/part1.svg" alt="Pesquisas Práticas">
            <h4 data-aos="flip-left" >Pesquisas Práticas</h4><hr>
            <span data-aos="zoom-in-down" >Com o StoriesBr você pode<br> aprender mais sobre a história do Brasil, aqui, num único lugar</span>
          </div>
          <div class="col-md-4" style="margin-bottom: 20px">
            <img data-aos="fade-down"src="resources/src/part2.svg" alt="Eficiente e acessível">
            <h4  data-aos="flip-right" >Eficiente e acessível</h4><hr>
            <span data-aos="zoom-in-down">Sem tempo em casa?<br> Continue sua leitura fora de casa em duas linguas diferentes com nosso app</span>
          </div>
          <div class="col-md-4">
            <img data-aos="fade-left"src="resources/src/part3.svg" alt="Aprenda se divertindo">
            <h4 data-aos="flip-right" >Aprenda se divertindo</h4><hr>
            <span data-aos="zoom-in-down" >Mini-games, histórias em quadrinhos e videos animados, uma forma de aprender mais leve para os mais jovens </span>
          </div>
        </section>
      </div>

      <section class="container">
        <div data-aos="zoom-in-up">
          <div class="fundo row" >
            <div class=" col-md-12">
              <div class="sobre" data-aos="fade-right" data-aos-offset="450" data-aos-easing="ease-in-sine">
                  <h3>Quem Somos</h3> <br>
                  <span >Somos um Grupo acadêmico do curso 
                      de Analise e desenvolvimento de
                      Sistemas do 4° semestre de 2019 da
                      faculdade UNIBR-SV, elaborando um projeto
                      com objetivo de ajudar e facilitar o
                      aprendizado da história brasileira de forma
                      mais interativa e divertida</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <footer class="container-fluid">
        <ul class="nav list">
          <li class="nav-item active">
            <a class="nav-link" href="documentacao">Documentação TCC</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="politica-privacidade" target="_blank">Política de Privacidade</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="fale-conosco" target="_blank">Fale Conosco</a>
          </li>
        </ul>
        <div class="social-buttons">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="https://www.youtube.com/watch?v=8ola10-AzV4"><i class="fab fa-youtube"></i></a>
        </div>
        <p class="esp">Desenvolvido por - ADS-5 UNIBR-SV 2020</p>
      </footer>
      
      <script>
        if ('serviceWorker' in navigator) {
          navigator.serviceWorker.register('service-worker.js')
            .then(function () {
              console.log('service worker registered');
            })
            .catch(function () {
              console.warn('service worker failed');
            });
        }
      </script>
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <script type="text/javascript">
          $(document).ready(function () {
              var docWidth = $(document.getElementsByClassName('lista-img')).width(),
                  slidesWidth = $(document.getElementsByClassName('ul-img')).width(),
                  rangeX = slidesWidth - docWidth,
                  $images = $(document.getElementsByClassName('ul-img'));
              $(document).on('mousemove', function (e) {
                  var mouseX = e.pageX,
                      offset = mouseX / docWidth * slidesWidth - mouseX / 2;

                  $images.css({
                      '-webkit-transform': 'translate3d(' + -offset + 'px,0,0)',
                      'transform': 'translate3d(' + -offset + 'px,0,0)'
                  });
              });
          });
      </script>
      <script src="resources/js/aos.js"></script>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script>AOS.init({duration:1000});</script>
</body>
</html>