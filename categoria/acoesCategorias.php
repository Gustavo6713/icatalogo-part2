<?php
    session_start();

    require("../database/conexao.php");

    function validarCampos(){
        $erros = [];

        if(!isset($_POST["descricao"]) || $_POST["descricao"] == ""){
            $erros[] = "O campo descrição é obrigatório";
        }

        return $erros;
    }

    switch ($_POST["acao"]) {

        case "inserir":

            $erros = validarCampos();

            if(count($erros) > 0){
                $_SESSION["mensagem"] = $erros[0];

                header("location: index.php");

                exit();
            }

            $descricao = $_POST["descricao"];

            //declara o SQL de inserção
            $sql = " INSERT INTO tbl_categoria (descricao) VALUES ('$descricao') ";

            //executa o SQL
            $resultado = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));

            if($resultado){
                $_SESSION["mensagem"] = "Categoria adicionada com sucesso!";
                $tipoMensagem = "Sucesso"; 
            }else{
                $_SESSION["mensagem"] = "Erro ao adicionar nova categoria!";
                $tipoMensagem = "Erro"; 
            }
        
        break;

        case "deletar":

                $categoriaId = $_POST["categoriaId"];
    
                //declarar o sql de delete
                $sqlDelete = " DELETE FROM tbl_categoria WHERE id = $categoriaId ";
    
                //executar o sql
                $resultado = mysqli_query($conexao, $sqlDelete);
    
                if($resultado){
                    $_SESSION["mensagem"] = "Categoria excluída com sucesso!";
                    $tipoMensagem = "sucesso"; 
                }else{
                    $_SESSION["mensagem"] = "Erro ao excluir a categoria!";
                    $tipoMensagem = "erro"; 
                }
            
            break;
    }

    //redirecionar para tela de listagem (index.php) com a mensagem
    header("location: index.php?");