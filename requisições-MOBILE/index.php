<?php session_start();
echo "<body>
<nav class='navbar container navbar-expand-lg navbar-light bg-light fixed-top'>
    <a class='navbar-brand' href='https://stories-br.000webhostapp.com/' data-aos='fade-right' data-aos-offset='300'
    data-aos-easing='ease-in-sine' >Stories <img data-aos='zoom-in-left'src='img/br.svg'></a><br>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#conteudoNavbarSuportado'
      aria-controls='conteudoNavbarSuportado' aria-expanded='false' aria-label='Alterna navegação' data-aos='fade-down-left'>
      <span class='navbar-toggler-icon'></span>
    </button> 

    <div class='collapse navbar-collapse' id='conteudoNavbarSuportado'>
      <ul class='navbar-nav ml-auto'>
        <li class='nav-item'>
          <a class='nav-link' href='biblioteca.html'>Biblioteca</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='#saiba'>Saiba mais</a>
        </li>";
        
       echo '
        <form class="form-inline my-2 my-lg-0" method="POST" action="https://stories-br.000webhostapp.com/biblioteca/pesquisa">
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
        <div class="overlay1 d-block w-100 "></div>
        <div class="carousel-caption  d-md-block">
          <h2 class="animated bounceInRight" style="animation-delay: 1s">Descobrimento do Brasil</h2>
          <p class="animated bounceInLeft" style="animation-delay: 2s">A chegada de Cabral ao território brasileiro
            representou o início de uma conquista sobre o descobrimento</p>
          <p class="animated bounceInRight" style="animation-delay: 3s"><a href="#">saiba mais</a></p>
        </div>

      </div>
      <div class="carousel-item">
        <div class="overlay2 d-block w-100"></div>
        <div class="carousel-caption   d-md-block">
          <h2 class="animated bounceInDown" style="animation-delay: 1s">Brasil no Período Colonial</h2>
          <p class="animated fadeInUp" style="animation-delay: 2s">Martim Afonso de Sousa (1532) combateu a pirataria
            francesa. Da mesma forma, ele instalou em São Vicente, a primeira povoação dotada de um engenho para
            produção de açúcar.</p>
          <p class="animated zoomIn" style="animation-delay: 3s"><a href="#">saiba mais</a></p>
        </div>
      </div>
      <div class="carousel-item">
        <div class="overlay3 d-block w-100"></div>
        <div class="carousel-caption d-md-block">
          <h2 class="animated zoomIn" style="animation-delay: 1s">Independência do Brasil</h2>
          <p class="animated fadeInLeft" style="animation-delay: 2s">Brasil determinou o fim do laço colonial com
            Portugal, declarando-se como uma nação independente</p>
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

  </div>


 <section class=" container destaques" id="saiba">
  <div class="cont-card "><a href="biblioteca.html">
    <div class="card">
        <div class="imgBx">
            <img  data-aos="fade-right"src="img/estudar.png" alt="">
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
        </div></a>
    </div>
    <div class="card">
     
            <div class="imgBx">
               
                <img data-aos="zoom-in-left" src="img/cabral.png" alt="">  
           
            </div>
            <div data-aos="fade-right" class="contentBx">
                <div class="content">
                    <h2>Divirta-se com nossos quadrinhos</h2>
                    <br><br>
                    <p> <br> Acha história muito dificil?
                            Aprenda lendo nossos quadrinhos,
                            ou jogando jogos.</p>

                </div>
            </div>
        </div>
</div>  
 </section>
  <div class="container">
    <section class="row descricao" style="margin-left: 0;margin-right: 0;">

      <div class="col-md-12 ">
        <h3 data-aos="flip-left">Vantagens do StoriesBR</h3>
        <hr>
        <span  data-aos="zoom-in-down">
          No StoriesBR você obtem algumas vantagens <br>
          que o nosso site proporciona para um<br>
          conhecimento mais eficaz. confira a baixo
        </span>
      </div>

      <div class="col-md-4 ">
        <img data-aos="fade-right" src="img/part1.svg" alt="">
        <h4 data-aos="flip-left" >Pratique em suas <br>
          pesquisas</h4>
        <hr>
        <span data-aos="zoom-in-down" >Com o StoriesBR você <br>
          consegue aprender mais sobre <br>
          as historias do Brasil aqui.<br>
          num único lugar</span>
      </div>

      <div class="col-md-4 ">
        <img data-aos="fade-down"src="img/part2.svg" alt="">
        <h4  data-aos="flip-right" >Eficiente e acessível</h4>
        <hr>
        <span data-aos="zoom-in-down">Sem tempo em casa?<br>
          StoriesBR também tem <br>
          sua versão Mobile , Além <br>
          da leitura em áudio e <br>
          histórias também em inglês</span>
      </div>
      <div class="col-md-4 ">
        <img data-aos="fade-left"src="img/part3.svg" alt="">
        <h4 data-aos="flip-right" >Aprenda se divertindo</h4>
        <hr>
        <span data-aos="zoom-in-down" >Mini-games, Histórias<br>
          em quadrimhos e conteúdos<br>
          ilustrados para crianças </span>
      </div>

    </section>

  </div>
<section id="quemsomos" class="container" >
       <div data-aos="zoom-in-up">
  <div class="fundo row" >
  
        <div class=" col-md-12">

         <div class="sobre" data-aos="fade-right"
         data-aos-offset="450"
         data-aos-easing="ease-in-sine">
            <h3>Quem Somos</h3>
            <span >Somos um Grupo acadêmico do curso <br>
                de Analise e desenvolvimento de<br>
                Sistemas do 4° semestre de 2019 da<br>
                faculdade UNIBR elaborando um projeto <br>
                com objetivo de ajudar e facilitar o <br>
                entendimento das pessoas na matéria<br>
                história de forma mais interativa e
                <br> divertida
            </span>

        </div>
    </div>
  </div>
    </section>

  <footer class="container-fluid">
    <div class="social-buttons">
      <a href="#"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="https://www.youtube.com/watch?v=8ola10-AzV4"><i class="fab fa-youtube"></i></a>
    </div>
    <p class="esp">Criado por ADS-4 UNIBR 2019</p>
    <p class="esp">Versão 1.0.0. Livre para todos usos.</p>
  </footer>
  

  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script type="text/javascript">
      $(document).ready(function () {
          var docWidth = $(document.getElementsByClassName("lista-img")).width(),
              slidesWidth = $(document.getElementsByClassName("ul-img")).width(),
              rangeX = slidesWidth - docWidth,
              $images = $(document.getElementsByClassName("ul-img"));
          $(document).on("mousemove", function (e) {
              var mouseX = e.pageX,
                  offset = mouseX / docWidth * slidesWidth - mouseX / 2;

              $images.css({
                  "-webkit-transform": "translate3d(" + -offset + "px,0,0)",
                  "transform": "translate3d(" + -offset + "px,0,0)"
              });
          });
      });
     
  </script>
  <!--<script src="js/aos.js"></script>-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
<!--
  <script>
    AOS.init({
      duration:1000
    });
  </script>
-->';
 ?>