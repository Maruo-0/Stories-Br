<?php session_start();    require '../config/db.php';
    if(!isset($_SESSION['userid'])){
        header("Location: ../index.php");
        exit();                    
    }
    elseif(isset($_POST['mudar_nome'])){
        $nome = mysqli_real_escape_string($conn, $_POST['nome_atual']);
        $id = $_SESSION['userid'];
        $query = "update usuarios set nome = '{$nome}' where id = {$id}";
        mysqli_query($conn, $query);
    }
    elseif(isset($_POST['mudar_senha'])){
        $senha_atual = $_POST['senha_atual'];
        $senha_nova = $_POST['senha_nova'];
        $id = $_SESSION['userid'];

        $sql = "select * from usuarios where id=?;";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            if(password_verify($senha_atual, $row['senha'])){
                $hashedSenha = password_hash($senha_nova, PASSWORD_DEFAULT);
                $queryAut = "update `usuarios` set `senha`='".$hashedSenha."' where id=".$id.";";
                $result = mysqli_query($conn, $queryAut);
            }
        }
    }
    $query = "select * from usuarios where id = {$_SESSION['userid']}";
    $usuario = mysqli_query($conn, $query);
    $usuario = mysqli_fetch_assoc($usuario);
    if(isset($_GET['postagens'])){
        $query_postagens = "select * from historias where criador_id = {$_SESSION['userid']}";
        $postagens = mysqli_query($conn, $query_postagens);
        $postagens = mysqli_fetch_assoc($postagens);
        }
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="resources/favicon.png"/>
    <link rel="manifest" href="manifest.json"> 
  
    <title>Perfil - Stories Br</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="resources/css/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Slab&display=swap');
        *{
            box-sizing: border-box;
        }
        body{
            width: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
        }
        a,p,h2,h3,i,form,.box-content{
            height: unset;
        }
        .box{
            background-color: #ffdb59;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .box-content{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #263e73;
            color: #ffffff;
            padding: 20px;
            border: solid 4px #ffffff;
            border-bottom-right-radius: 20px;
            border-bottom-left-radius: 20px;
            border-top: 0;
            width: 100%;
            min-width: 500px;
            max-width: 800px;
        }
        .fa-user-circle{
            font-size: 10em;
            margin-bottom: 20px;
        }
        .btn, .btn-voltar{
            background-color: #263e73;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            text-decoration: none;
            margin-top: 10px;
            cursor: pointer;
            font-size: 25px;
            width: 100px;
            transition: 500ms;
        }
        .btn-voltar{
            background-color: #263e73;
            color: #ffffff;
            position: relative;
            top: -40px;
            width: 150px;
        }
        .btn-danger{
            background-color: #dc3545;
        }
        .btn:hover, .btn-voltar:hover{
            background-color: #ffffff;
            color: #263e73;
        }
        .btn-danger:hover{
            background-color: #dc3545;
        }
        .box-acoes{
            background-color: #4CAF50;
            padding: 30px;
            width: 100%;
        }
        form{
            display: flex;
            flex-direction: column;
            margin-bottom: 40px;
        }
        label{
            font-size: x-large;
        }
        input[type="text"],input[type="password"]{
            font-size: 1.2rem;
            padding: 0.7rem 0.8rem;
            border-radius: 0.2rem;
            background-color: rgb(255, 255, 255);
            border: none;
            border-bottom: 0.3rem solid transparent;
            transition: all 0.3s;
        }
        input[type="text"]{
            width: 320px;
        }
        input[type="password"]{
            width: 200px;
        }
        @media screen and (max-width: 600px){
            .box-content{
                min-width: 0;
            }
        }
        @media screen and (max-width: 600px){
            .nome{
                padding-left: 70px;
            }
            .fa-user-circle{
                font-size: 8em;
            }
        }
        @media screen and (max-width: 425px){
            .box-content{
                margin: 0  5px 0 5px;
            }
            .nome{
                padding-left: 50px;
            }
            .fa-user-circle{
                font-size: 7em;
                margin-bottom: 15px;
            }
            input[type="text"]{
                width: 260px;
            }
        }
        @media screen and (max-width: 350px){
            .nome{
                padding-left: 30px;
            }
            .fa-user-circle{
                font-size: 6em;
                margin-bottom: 10px;
            }
        }
    </style>
    <script src="https://kit.fontawesome.com/57b737a7cf.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="box">
        <div class="box-content">
            <i class="fas fa-user-circle"></i>
            <h2 class="nome">Olá, <?php echo $usuario['nome'] ?></h2>
            <p>Deseja mudar seu nome ou senha?</p>
        </div>
        <div>
            <a href="index.php" class="btn btn-voltar">voltar</a>
            <a href="favoritos" class="btn btn-voltar">Favoritos</a>
            <?php if(isset($_SESSION['isadmin']) && !isset($_GET['postagens'])){?>
                <a href="?postagens=true" class="btn btn-voltar">Postagens</a>
                <a href="admin/edicao" class="btn btn-voltar">Criar</a>
                </div>
            <?php } 
            if(isset($_GET['postagens'])){?>
                <a href="?" class="btn btn-voltar">Opções</a>
                <a href="admin/edicao" class="btn btn-voltar">Criar</a>
            </div>
                    <div class="box-acoes" id="main">
                    <div class="col-sm-4">
                        <a href="livro/<?php echo $postagens['id']; ?>">
                        <div class="card-b mb-5">
                            <img src="resources/src/<?php echo $postagens['img_capa']; ?>" class="card-img-top" width="300px">
                            <div class="card-body">
                                <div class="card-title formatar-titulo"><p><?php echo $postagens['titulo']; ?></p></div>
                                <div class="card-title formatar-desc"><p><?php echo $postagens['desc']; ?></p></div>
                                <div class="card-title formatar-data"><p><?php $data = $postagens['created_at']; echo 'Postado em: '.date('d/m/Y',strtotime($data)) ?></p></div>
                            </div>
                        </div></a>
                    </div>

                    </div>
                </div>
            </body>
            </html>
        <?php exit(); } ?>
        <div class="box-acoes">
            <form action="config/login.inc.php?sair=true" method="post">
                <button type="submit" name="logout" class="btn btn-danger">Sair</button>
            </form>
            <h2>Mudar nome?</h2>
            <form action="" method="post">
                <input type="text" name="nome_atual">
                <input type="submit" name="mudar_nome" value="Mudar" class="btn">
            </form>
            <h2>Mudar senha?</h2>
            <form action="" method="post">
                <label>Senha atual:</label>
                <input type="password" name="senha_atual" required>
                <label>Senha nova:</label>
                <input type="password" name="senha_nova" required>
                <input type="submit" name="mudar_senha" value="Mudar" class="btn">
            </form>
        </div>
    </div>
</body>
</html>