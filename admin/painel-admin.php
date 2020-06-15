<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("Location: /StoriesBr/");
        exit();
    }
    elseif($_SESSION['isadmin'] === 1 || $_SESSION['isadmin'] === 0){
        header("Location: /StoriesBr/");
        exit();
    }

    require('../config/db.php');

    $querymens = 'select * from mensagens order by created_at desc limit 0, 5';
    $querycountmens = 'select count(*) from mensagens';
    $queryrevs = 'select * from historias where aprovado = 0 order by created_at desc limit 0, 5';
    $querycountrevs = 'select count(*) from historias where aprovado = 0';
    $querymemb = 'select count(*) from usuarios where autenticado = 1';
    $queryvisit = 'select * from visitas';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="../resources/favicon.png"/>
    <title>Painel admin - Stories Br</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="stylesheet" href="../resources/css/painel-admin.css">
    <style>
        .avaliacao{
            display: grid;
            align-items: center;
            justify-content: center;
        }
        .avaliacao h2, .avaliacao h3{
            margin: 5px 0;
        }
        .avaliacao p{
            margin: 5px 10px;
        }
    </style>
    <script src="https://kit.fontawesome.com/57b737a7cf.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav id="nav" class="navbar sticky-top  navbar-dark bg-ligh">
        <button class="btn" id="sideMenu" type="button" onclick="openNav()">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a id="painel">Painel Admin</a>
    </nav>
    <div class="caixa">
        <div id="mySidenav" class="sidenav">
            <a class="botao active" id="inicio">Inicio</a>
            <a class="botao" id="usuarios">Usuários</a>
            <a class="botao" id="conteudo">Conteúdo</a>
            <a class="botao" id="revisao">Revisão</a>
            <a class="botao" id="reportes">Reportes</a>
            <a class="botao" id="sugestoes">Sugestões</a>
            <a class="botao" id="avaliacoes">Avaliações app</a>
            <a class="botao" href="edicao">Criar</a><br>
            <form action="../config/login.inc.php?sair=true" method="post">
                <button type="submit" name="logout" class="btn btn-danger" style="margin-left: 32px;">Sair</button>
            </form>
            <a class="botao" href="../">Voltar ao site</a><br><br><br>
        </div>
        <div id="overl" class="sidenavb" onclick="closeNav()"></div>
        <div class="loader"><div class="spin"></div></div>

        <div id="views">
            <div class="view" style="display: block;">
                <a class="botao btn-link" href="../" >/Página Inicial</a>
                <div id="relogio" class="relogio" onload="showTime()"></div>
                <div class="quadro-grid">
                    <div class="quadro">
                        <img src="../resources/src/icone1.png" width="67px">
                        <div class="quadro-content">
                            <div>
                                <h4>Visitantes</h4>
                                <h5><?php 
                                        $result = mysqli_query($conn, $queryvisit);
                                        $query = mysqli_fetch_assoc($result);
                                        mysqli_free_result($result);
                                        echo $query['visitas'];
                                ?></h5>
                            </div>
                            
                            <select>
                                <option value="hoje">hoje</option>
                                <option value="mes">mês</option>
                                <option value="ano">ano</option>
                                <option value="total">total</option>
                            </select>
                        </div>
                    </div>
                    <div class="quadro">
                        <img src="../resources/src/icone2.png" width="67px">
                        <div class="quadro-content">
                            <div>
                                <h4>Membros</h4>
                                <h5><?php 
                                        $result = mysqli_query($conn, $querymemb);
                                        $query = mysqli_fetch_assoc($result);
                                        mysqli_free_result($result);
                                        echo $query['count(*)'];
                                ?></h5>
                            </div>
                            
                            <select>
                                <option value="hoje">hoje</option>
                                <option value="mes">mês</option>
                                <option value="ano">ano</option>
                                <option value="total">total</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="quadro-opcoes-grid">
                    <div class="quadro-mensagens">
                        <div class="quadro-mensagens-titulo">
                            <h4>Quadro de mensagens</h4>
                            <div class="numerowrap">
                                <p>Últimas atualizações recebidas</p>
                                <div class="numeroatualizacao">
                                    <?php $result = mysqli_query($conn, $querycountmens); 
                                        $query = mysqli_fetch_assoc($result);
                                        mysqli_free_result($result);
                                        echo $query['count(*)'];
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div id="quadromens" class="mensagens">
                            <?php
                                $result = mysqli_query($conn, $querymens);
                                while($query = mysqli_fetch_assoc($result)){
                                    $data = $query['created_at'];
                                    echo '<div class="mensagem">
                                        <p>'.$query['assunto'].'</p>
                                        <p>'.$query['nome'].'</p>
                                        <p>'.date('d/m/Y',strtotime($data)).'</p>
                                    </div>';
                                }
                                mysqli_free_result($result);
                            ?>
                        </div>
                    </div>
                    <div class="quadro-mensagens">
                        <div class="quadro-mensagens-titulo">
                            <h4>Quadro de revisão</h4>
                            <div class="numerowrap">
                                <p>Últimos postagens recebidas</p>
                                <div class="numeroatualizacao">                                    
                                    <?php $result = mysqli_query($conn, $querycountrevs); 
                                        $query = mysqli_fetch_assoc($result);
                                        mysqli_free_result($result);
                                        echo $query['count(*)'];
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                            $result = mysqli_query($conn, $queryrevs);
                            while($query = mysqli_fetch_assoc($result)){
                                $data = $query['created_at'];
                                echo '<div class="mensagem">
                                        <p>'.$query['id'].'</p>
                                        <p>'.trim($query['titulo'], '<p></p>').'</p>
                                        <p>'.date('d/m/Y',strtotime($data)).'</p>
                                    </div>';
                            }
                            mysqli_free_result($result);
                        ?>
                    </div>

                    <div class="quadro-rapido">
                        <h3>Acesso Rápido</h3>
                        <div class="quadro-acoes">
                            <div class="botao" id="usuarios"><h4>Usuários</h4></div>
                            <div class="botao" id="conteudo"><h4>Conteúdo</h4></div>
                            <div class="botao" id="revisao"><h4>Revisão</h4></div>
                            <div class="botao" id="reportes"><h4>Reportes</h4></div>
                            <div class="botao" id="sugestoes"><h4>Sugestões</h4></div>
                            <div class="botao" id="avaliacoes"><h4>Avaliações app</h4></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="view" id="usuariospag">
                <a class="botao btn-link" href="../" >/Página Inicial</a><a class="botao btn-link" id="inicio">/Painel Inicio</a>
                <h2 class="title">Usuários</h2>
                <input type="text" id="procurarusuarios" class="procurar" onkeyup="procurarNome(procurarusuarios, quadrousuarios)" placeholder="Procurar por email...">
                <table id="quadrousuarios" class="quadro-usuarios">
                    <tr>
                        <th onclick="ordenarTabela(0, quadro-usuarios)">ID</th>
                        <th onclick="ordenarTabela(1, quadro-usuarios)">Nome</th>
                        <th onclick="ordenarTabela(2, quadro-usuarios)">E-mail</th>
                        <th onclick="ordenarTabela(3, quadro-usuarios)">Admin?</th>
                    </tr>
                </table>
            </div>
            <div class="view" id="conteudopag">
                <a class="botao btn-link" href="../" >/Página Inicial</a><a class="botao btn-link" id="inicio">/Painel Inicio</a>

                <h2 class="title">Conteúdo</h2>
                <input type="text" id="procurarUser" class="procurar" onkeyup="procurarNome(procurarUser, tabelaUser)" placeholder="Procurar por titulo..">
                <table id="tabelaUser" class="quadro-usuarios">
                    <tr>
                        <th onclick="ordenarTabela(0, tabelaUser)">Titulo</th>
                        <th onclick="ordenarTabela(1, tabelaUser)">Decrição</th>
                        <th onclick="ordenarTabela(2, tabelaUser)">Data</th>
                        <th onclick="ordenarTabela(3, tabelaUser)">Autor</th>
                        <th onclick="ordenarTabela(4, tabelaUser)">Opções</th>
                    </tr>
                    <tr>
                        <td>descobrimento do brasil</td>
                        <td>nome</td>
                        <td>13/04/2020</td>
                        <td>13/04/2020</td>
                        <td><button>Editar</button><button>Excluir</button></td>
                    </tr>
                    <tr>
                        <td>idependencia do brasil</td>
                        <td>nome</td>
                        <td>25/06/2020</td>
                        <td>25/06/2020</td>
                        <td><button>Editar</button><button>Excluir</button></td>
                    </tr>
                </table>

            </div>
            <div class="view" id="revisaopag">
                <a class="botao btn-link" href="../" >/Página Inicial</a><a class="botao btn-link" id="inicio">/Painel Inicio</a>

                <h2 class="title">Revisão</h2>
                <div id="quadro-conteudo" class="quadro-conteudo">
                    <div id="parent-modal">
                        <div id="modalopen" class="quadro-revisar">
                            <img src="../resources/src/caravela.jpg" width="100%">
                            <h2>Teste</h2>
                            <p>Teste</p>
                        </div>
                        <div id="modal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <span class="close" onclick="aprovar(1)">Teste</span>
                                <span class="close" onclick="negar(1)">Teste</span>
                                <img src="../resources/src/caravela.jpg" width="100%">
                                <h2>Teste</h2>
                                <h5>Teste</h5>
                                <p>Teste</p>
                                <p>Teste</p>
                                <a href="#">Teste</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="view" id="reportespag">
                <a class="botao btn-link" href="../" >/Página Inicial</a><a class="botao btn-link" id="inicio">/Painel Inicio</a>

                <h2 class="title">Reportes</h2>
                <input type="text" id="procurar" class="procurar" onkeyup="procurarNome(procurar, tabela)" placeholder="Procurar por assunto...">
                <input type="text" id="procurarB" class="procurar hidden" onkeyup="procurarNome(procurarB, tabelaB)" placeholder="Procurar por assunto...">
                <div class="mudar-tabela">
                    <div id="iconTabela1" class="icon icon-left" onclick="alternarTabelas('reportespag', '#tabela', 'novas')"><i class="fas fa-angle-left fa-2x"></i></div>
                    <h4 id="tabelaTitulo">Mensagens salvas</h4>
                    <div id="iconTabela2" class="icon icon-right" onclick="alternarTabelas('reportespag', '#tabela', 'salvas')"><i class="fas fa-angle-right fa-2x"></i></div>
                </div>
                <div id="reportespagbox">
                    <table id="tabela" class="quadro-usuarios">
                        <tr>
                            <th onclick="ordenarTabela(0, tabela)">Asssunto</th>
                            <th onclick="ordenarTabela(1, tabela)">nome</th>
                            <th onclick="ordenarTabela(2, tabela)">email</th>
                            <th onclick="ordenarTabela(3, tabela)">Messagem</th>
                        </tr>
                        <!-- <tr id="parent-modal">
                            <td>Teste</td>
                            <td>Teste</td>
                            <td>Teste</td>
                            <td>
                                <button id="modalopen">Abrir</button>
                                <div id="modal" class="modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <span class="close">Teste</span>
                                        <span class="close">Teste</span>
                                        <h2>Teste</h2>
                                        <h5>Teste</h5>
                                        <p>Teste</p>
                                        <p>Teste</p>
                                    </div>
                                </div>
                            </td>
                        </tr> -->
                    </table>
                    <table id="tabelaB" class="quadro-usuarios hidden">
                        <tr>
                            <th onclick="ordenarTabela(0, tabelaB)">Asssunto</th>
                            <th onclick="ordenarTabela(1, tabelaB)">nome</th>
                            <th onclick="ordenarTabela(2, tabelaB)">email</th>
                            <th onclick="ordenarTabela(3, tabelaB)">Messagem</th>
                        </tr>
                        <!-- <tr id="parent-modal">
                            <td>Teste</td>
                            <td>Teste</td>
                            <td>Teste</td>
                            <td>
                                <button id="modalopen">Abrir</button>
                                <div id="modal" class="modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <span class="close">Teste</span>
                                        <span class="close">Teste</span>
                                        <h2>Teste</h2>
                                        <h5>Teste</h5>
                                        <p>Teste</p>
                                        <p>Teste</p>
                                    </div>
                                </div>
                            </td>
                        </tr> -->
                    </table>
                </div>
            </div>
            <div class="view" id="sugestoespag">
                <a class="botao btn-link" href="../" >/Página Inicial</a><a class="botao btn-link" id="inicio">/Painel Inicio</a>

                <h2 class="title">Sugestões</h2>
                <input type="text" id="procurar2" class="procurar" onkeyup="procurarNome(procurar2, tabela2)" placeholder="Procurar por assunto..">
                <input type="text" id="procurar2B" class="procurar hidden" onkeyup="procurarNome(procurar2B, tabela2B)" placeholder="Procurar por assunto..">
                <div class="mudar-tabela">
                    <div id="iconTabela1" class="icon icon-left" onclick="alternarTabelas('sugestoespag', '#tabela2', 'novas')"><i class="fas fa-angle-left fa-2x"></i></div>
                    <h4 id="tabelaTitulo">Mensagens salvas</h4>
                    <div id="iconTabela2" class="icon icon-right" onclick="alternarTabelas('sugestoespag', '#tabela2', 'salvas')"><i class="fas fa-angle-right fa-2x"></i></div>
                </div>
                <div id="sugestoespagbox">
                    <table id="tabela2" class="quadro-usuarios">
                        <tr>
                            <th onclick="ordenarTabela(0, tabela2)">Asssunto</th>
                            <th onclick="ordenarTabela(1, tabela2)">nome</th>
                            <th onclick="ordenarTabela(2, tabela2)">email</th>
                            <th onclick="ordenarTabela(3, tabela2)">Messagem</th>
                        </tr>
                        <!-- <tr id="parent-modal">
                            <td>Sugestão</td>
                            <td>Marcelo</td>
                            <td>marcelo.e.jr@hotmail.com</td>
                            <td>
                                <button id="modalopen">Abrir</button>
                                <div id="modal" class="modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <span class="close">Apagar</span>
                                        <span class="close">Salvar</span>
                                        <h2>Asssunto</h2>
                                        <h5>Marcelo</h5>
                                        <p>email</p>
                                        <p>mensagem</p>
                                    </div>
                                </div>
                            </td>
                        </tr> -->
                    </table>
                    <table id="tabela2B" class="quadro-usuarios  hidden">
                        <tr>
                            <th onclick="ordenarTabela(0, tabela2B)">Asssunto</th>
                            <th onclick="ordenarTabela(1, tabela2B)">nome</th>
                            <th onclick="ordenarTabela(2, tabela2B)">email</th>
                            <th onclick="ordenarTabela(3, tabela2B)">Messagem</th>
                        </tr>
                        <!-- <tr id="parent-modal">
                            <td>Sugestão</td>
                            <td>Marcelo</td>
                            <td>marcelo.e.jr@hotmail.com</td>
                            <td>
                                <button id="modalopen">Abrir</button>
                                <div id="modal" class="modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <span class="close">Apagar</span>
                                        <span class="close">Salvar</span>
                                        <h2>Asssunto</h2>
                                        <h5>Marcelo</h5>
                                        <p>email</p>
                                        <p>mensagem</p>
                                    </div>
                                </div>
                            </td>
                        </tr> -->
                    </table>
                </div>
            </div>
            <div class="view" id="avaliacoespag">
                <a class="botao btn-link" href="../" >/Página Inicial</a><a class="botao btn-link" id="inicio">/Painel Inicio</a>

                <h2 class="title">Avaliações</h2>

                <div class="avaliacao">
                    <h3>Gostou</h3>
                    <p>Membros: <?php 
                        $query = "select count(*) from app_avaliacao where id_usuario is not null and avaliacao = 1";
                        $resultado = mysqli_query($conn, $query);
                        $resultado = mysqli_fetch_assoc($resultado);
                        echo $resultado['count(*)'];?>
                    </p>
                    <p>Não-Membros: <?php 
                        $query = "select count(*) from app_avaliacao where id_usuario is null and avaliacao = 1";
                        $resultado = mysqli_query($conn, $query);
                        $resultado = mysqli_fetch_assoc($resultado);
                        echo $resultado['count(*)'];?>
                    </p>

                    <h3>Não gostou</h3>
                    <p>Membros: <?php 
                        $query = "select count(*) from app_avaliacao where id_usuario is not null and avaliacao = 0";
                        $resultado = mysqli_query($conn, $query);
                        $resultado = mysqli_fetch_assoc($resultado);
                        echo $resultado['count(*)'];?>
                    </p>
                    <p>Não-Membros: <?php 
                        $query = "select count(*) from app_avaliacao where id_usuario is null and avaliacao = 0";
                        $resultado = mysqli_query($conn, $query);
                        $resultado = mysqli_fetch_assoc($resultado);
                        echo $resultado['count(*)'];?>
                    </p>
                    <h2>Total: <?php 
                        $query = "select count(*) from app_avaliacao";
                        $resultado = mysqli_query($conn, $query);
                        $resultado = mysqli_fetch_assoc($resultado);
                        echo $resultado['count(*)'];?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <script src="../resources/js/painel-admin.js"></script>
    <script>
    </script>
</body>
</html>