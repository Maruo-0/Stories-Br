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

    if(isset($_GET['usuarios']) || isset($_GET['conteudo']) || isset($_GET['revisao']) || isset($_GET['reportes']) || isset($_GET['sugestoes'])){
        $requisicao = '';

        if(isset($_GET['usuarios'])){
            $requisicao = $_GET['usuarios'];
        }
        elseif(isset($_GET['conteudo'])){
            $requisicao = $_GET['conteudo'];
        }
        elseif(isset($_GET['revisao'])){
            $requisicao = $_GET['revisao'];
        }
        elseif(isset($_GET['reportes'])){
            $requisicao = $_GET['reportes'];
        }
        elseif(isset($_GET['sugestoes'])){
            $requisicao = $_GET['sugestoes'];
        }

        switch ($requisicao) {
            case 'usuarios':
                $queryUsuarios = 'select * from usuarios where autenticado = 1 order by nome';
                echo '<tr>
                    <th onclick="ordenarTabela(0, quadrousuarios)">ID</th>
                    <th onclick="ordenarTabela(1, quadrousuarios)">Nome</th>
                    <th onclick="ordenarTabela(2, quadrousuarios)">Email</th>
                    <th onclick="ordenarTabela(3, quadrousuarios)">Admin?</th>
                </tr>';
                $result = mysqli_query($conn, $queryUsuarios);
                while($query = mysqli_fetch_assoc($result)){
                    echo '<tr>
                        <td>'.$query['id'].'</td>
                        <td>'.$query['nome'].'</td>
                        <td>'.$query['email'].'</td>
                        <td>'.$query['admin'].'<button>Promover</button><button>Retirar</button></td>
                    </tr>';
                }
                break;
            case 'conteudo':
                $queryConteudo = 'select * from historias where aprovado = 1 order by created_at desc';
                echo '<tr>
                    <th onclick="ordenarTabela(0, tabelaUser)">Titulo</th>
                    <th onclick="ordenarTabela(1, tabelaUser)">Decrição</th>
                    <th onclick="ordenarTabela(2, tabelaUser)">Data</th>
                    <th onclick="ordenarTabela(3, tabelaUser)">Autor</th>
                    <th onclick="ordenarTabela(4, tabelaUser)">Opções</th>
                </tr>';
                $result = mysqli_query($conn, $queryConteudo);
                while($query = mysqli_fetch_assoc($result)){
                    $querynome = 'select * from usuarios where id = '.$query['criador_id'];
                    $resultnome = mysqli_query($conn, $querynome);
                    $resultquerynome = mysqli_fetch_assoc($resultnome);
                    $data = strtotime($query['created_at']);
                    $data = date('d/m/y', $data);
                    echo '<tr>
                        <td>'.trim($query['titulo'], '<p></p>').'</td>
                        <td>'.$query['desc'].'</td>
                        <td>'.$data.'</td>
                        <td>'.$resultquerynome['nome'].'</td>
                        <td class="alinhar"><a target="_blank" href="/StoriesBr/livro/'.$query['id'].'">Ler</a><a href="edicao.php?id='.$query['id'].'" target="_blank"><button>Editar</button></a><button>Excluir</button></td>
                    </tr>';
                }

                break;
            case 'revisao':
                $queryRevisao = 'select * from historias where aprovado = 0 order by created_at desc';
                $result = mysqli_query($conn, $queryRevisao);
                while($query = mysqli_fetch_assoc($result)){
                    $querynome = 'select * from usuarios where id = '.$query['criador_id'];
                    $resultnome = mysqli_query($conn, $querynome);
                    $resultquerynome = mysqli_fetch_assoc($resultnome);
                    
                    echo '<div id="parent-modal">
                        <div id="modalopen" class="quadro-revisar">
                            <img src="../resources/src/'.$query['img_capa'].'" width="100%">
                            <h2>'.trim($query['titulo'], '<p></p>').'</h2><hr>
                            '.$query['desc'].'
                        </div>
                        <div id="modal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <span class="salvar" onclick="aprovar('.$query['id'].')">Aprovado</span>
                                <span class="apagar" onclick="negar('.$query['id'].')">negado</span>
                                <img src="../resources/src/'.$query['img_capa'].'" width="100%">
                                <h2>'.trim($query['titulo'], '<p></p>').'</h2>
                                <h5>Escrito por: '.$resultquerynome['nome'].'</h5>
                                <p>'.$query['desc'].'</p>
                                <p>'.$query['texto'].'</p>
                                <a href="../resources/src/'.$query['pdf'].'">'.$query['pdf'].'</a>
                            </div>
                        </div>
                    </div>';
                }
                break;
            case 'reportes':
                $queryReportes = 'select * from mensagens where pag_erro_id is not null order by created_at desc';
                $result = mysqli_query($conn, $queryReportes);
                echo '<tr>
                    <th onclick="ordenarTabela(0, tabela)">Asssunto</th>
                    <th onclick="ordenarTabela(1, tabela)">nome</th>
                    <th onclick="ordenarTabela(2, tabela)">email</th>
                    <th onclick="ordenarTabela(3, tabela)">Messagem</th>
                </tr>';
                while($query = mysqli_fetch_assoc($result)){

                    echo '<tr id="parent-modal">
                        <td>'.$query['assunto'].'</td>
                        <td>'.$query['nome'].'</td>
                        <td>'.$query['email'].'</td>
                        <td>
                            <button id="modalopen">Abrir</button>
                            <div id="modal" class="modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <span class="apagar">Apagar</span>
                                    <span class="salvar">Salvar</span>
                                    <h2>Assunto: '.$query['assunto'].'</h2>
                                    <h2>Página do reporte :<a target="_blank" href="/StoriesBr/livro/'.$query['pag_erro_id'].'">'.$query['pag_erro_id'].'</a></h2>
                                    <h5>'.$query['nome'].'</h5>
                                    <p>'.$query['email'].'</p>
                                    <p>'.$query['mens'].'</p>
                                </div>
                            </div>
                        </td>
                    </tr>';
                }
                break;
            case 'sugestoes':
                $querySugestões = 'select * from mensagens where pag_erro_id is null order by created_at desc';
                $result = mysqli_query($conn, $querySugestões);
                echo '<tr>
                    <th onclick="ordenarTabela(0, tabela2)">Asssunto</th>
                    <th onclick="ordenarTabela(1, tabela2)">nome</th>
                    <th onclick="ordenarTabela(2, tabela2)">email</th>
                    <th onclick="ordenarTabela(3, tabela2)">Messagem</th>
                </tr>';
                while($query = mysqli_fetch_assoc($result)){
                    echo '<tr id="parent-modal">
                        <td>'.$query['assunto'].'</td>
                        <td>'.$query['nome'].'</td>
                        <td>'.$query['email'].'</td>
                        <td>
                            <button id="modalopen">Abrir</button>
                            <div id="modal" class="modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <span class="apagar">Apagar</span>
                                    <span class="salvar">Salvar</span>
                                    <h2>Assunto: '.$query['assunto'].'</h2>
                                    <h5>'.$query['nome'].'</h5>
                                    <p>'.$query['email'].'</p>
                                    <p>'.$query['mens'].'</p>
                                </div>
                            </div>
                        </td>
                    </tr>';
                }
                break;
        }

        mysqli_close($conn);
        exit();
    }    //fazer processos de aprovação e negação
    elseif (isset($_GET['aprovar']) && isset($_GET['id'])) {
        if (is_numeric($_GET['id']) == true){
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $querySalvar = "update historias set aprovado = 1 where id = {$id}";
            mysqli_query($conn, $querySalvar);
            mysqli_close($conn);
        }
        else{
            header('Location: paineladmin?erroSQL');
        }
    }
    elseif (isset($_GET['negar']) && isset($_GET['id'])) {
        if (is_numeric($_GET['id']) == true){
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $querySalvar = "delete from historias where id = {$id}";
            mysqli_query($conn, $querySalvar);
            mysqli_close($conn);
        }
        else{
            header('Location: paineladmin?erroSQL');
        }
    }