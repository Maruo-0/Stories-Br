<?php
require 'config/db.php';

    if(isset($_GET['get'])){
        if(isset($_GET['livros']) && $_GET['livros'] == 'todos'){
            $quantidade = $_GET['quantidade'];
            $inicio = $_GET['inicio'];
        
            $query = "select * from historias where aprovado = 1 order by created_at desc limit $inicio, $quantidade";
            $arrayAcessado = false;
            $array = array();
            $query = mysqli_query($conn, $query);
            $contador = 1;
            while($historia = mysqli_fetch_assoc($query)){
                $array = array_merge($array, array(
                    "id{$contador}" => "{$historia['id']}",
                    "imagem{$contador}" => "{$historia['img_capa']}",
                    "titulo{$contador}" => "{$historia['titulo']}",           
                ));
                $contador++;
            }
            $array = json_encode($array);
            echo $array;
            mysqli_close($conn);
            exit();
        }
        elseif(isset($_GET['livrosNomes'])){
            $titulo = $_GET['livrosNomes'];

            $query = "select * from historias where titulo like '%{$titulo}%'";
            $arrayAcessado = false;
            $array = array();
            $query = mysqli_query($conn, $query);
            $contador = 1;
            while($historia = mysqli_fetch_assoc($query)){
                $array = array_merge($array, array(
                    "id{$contador}" => "{$historia['id']}",
                    "imagem{$contador}" => "{$historia['img_capa']}",
                    "titulo{$contador}" => "{$historia['titulo']}",           
                ));
                $contador++;
            }
            $array = json_encode($array);
            echo $array;
            mysqli_close($conn);
            exit();
        }
        elseif(isset($_GET['favoritos']) && isset($_GET['usuarioId'])){
            $usuario_id = $_GET['usuarioId'];
            $arrayAcessado = false;
            $array = array();
            $contador = 1;
            $query  = "select * from ler_depois where id_usuario = {$usuario_id}";
            $query = mysqli_query($conn, $query);

            while($favorito = mysqli_fetch_assoc($query)){   
                $query_historia = "select * from historias where id = {$favorito['id_historia']}";
                $query_historia = mysqli_query($conn, $query_historia);
                while($historia = mysqli_fetch_assoc($query_historia)){
                    $array = array_merge($array, array(
                        "id{$contador}" => "{$historia['id']}",
                        "imagem{$contador}" => "{$historia['img_capa']}",
                        "titulo{$contador}" => "{$historia['titulo']}",           
                    ));
                }
                $contador++;
            }
            $array = json_encode($array);
            echo $array;
            mysqli_close($conn);
            exit();
        }
        elseif(isset($_GET['artigo'])){
            $artigo_id = $_GET['artigo'];
            $query = "select * from historias where id = {$artigo_id}";
            $query = mysqli_query($conn, $query);
            $historia = mysqli_fetch_assoc($query);
            $array = array(
                "texto" => "{$historia['texto']}",
                "imagem" => "{$historia['img_capa']}",
            );
            $array = json_encode($array);
            echo $array;
            mysqli_close($conn);
            exit();
        }
        elseif(isset($_GET['id']) && isset($_GET['lingua'])){
            $id = $_GET['id'];
            $lingua = $_GET['lingua'];
            $query = '';
            if($lingua === 'US English Male') $query = "select textoIngles as texto from historias where id = {$id}";
            else $query = "select texto as texto from historias where id = {$id}";
            $query = mysqli_query($conn, $query);
            $texto = mysqli_fetch_assoc($query);
            echo $texto['texto'];
            mysqli_close($conn);
            exit();
        }
    }
    elseif(isset($_POST['estado']) && isset($_POST['artigoId'])){
        $id_usuario = $_POST['usuarioId'];
        $artigo_id = $_POST['artigoId'];
        $query = '';
        if($_POST['estado'] === 'favoritar') $query = "insert into ler_depois (`id_historia`, `id_usuario`) VALUES ({$artigo_id}, {$id_usuario})";
        else $query = "delete from ler_depois where id_historia = {$artigo_id} and id_usuario = {$id_usuario}";
        
        mysqli_query($conn, $query);
        mysqli_close($conn);
    }