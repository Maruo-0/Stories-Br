<?php
    

    if (isset($_SESSION['userid'])) {
        session_start();
        header("Location: /StoriesBr/");
        exit();                    
    }
    echo '
    <div class="container">
        <div class="eue padding-sm borda-r">
            <img class="mb-4" src="resources/src/bandeira.png" alt="" width="100" height="auto">
            <h1 class="h3 mb-3 font-weight-normal">Acessar a Biblioteca</h1>
        </div>
        <div class=" borda-r2">
            <form class="form-signin" action="login.inc.html" method="post">

                <label for="inputEmail" class="sr-only">Email</label>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email">

                <label for="inputPassword"  class="sr-only">Senha</label>
                <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha">
                
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Lembre de mim
                    </label>
                </div>
                <button class="btn btn-lg btn-cl btn-block" type="submit" name="login">Entrar</button>
                <label class="subline">Não tem uma conta? <a href="inscrisao.html">Inscreva-se</a></label>
                <p class="mt-3 text-muted">© 2019-2019</p>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>';