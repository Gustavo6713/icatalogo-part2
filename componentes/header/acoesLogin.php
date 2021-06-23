<?php
session_start();
require("../../database/conexao.php");

function validarCampos(){
    $erros = [];

    if(!isset($_POST["usuario"])  || $_POST["usuario"] == ""){
        $erros[] = "O campo usuário é obrigatório";
    }

    if(!isset($_POST["senha"])  || $_POST["senha"] == ""){
        $erros[] = "O campo senha é obrigatório";
    }

    return $erros;
}

switch ($_REQUEST["acao"]) {
    case "login":
        
        $erros = validarCampos();

        if(count($erros) > 0){
            $_SESSION["erros"] = $erros;
            
            header("location: ../../produtos/index.php");
        }

        //receber os campos usuário e senha do post
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];

        //montaro sql select na tabela tbl_administrador
        //SELECT * FROM tbl_administrador WHERE usuario = $usuario;
        $sqlSelect = "SELECT * FROM tbl_administrador WHERE usuario = '$usuario'";

        //executar o sql
        $resultado = mysqli_query($conexao, $sqlSelect) or die(mysqli_error($conexao));
        $usuario = mysqli_fetch_array($resultado);
        //verificar se o usuário existe
    
    if (!$usuario || !password_verify($senha, $usuario["senha"])){
        // se a senha estiver errada, criar uma mensagem de "usuário e/ou senha inválidos"
        $mensagem = "Usuários e/ou senha inválidos";
    }else{
        // se estiver correta, salvar o id e o nome do usuário n a sessão $_SESSION
        $_SESSION["usuarioId"] = $usuario["id"];
        $_SESSION["usuarioNome"] = $usuario["nome"];
    }
        $mensagem = "Bem vindo," . $usuario["nome"];
        //redirecionar para a tela de listagem de produtos
        header("location: ../../produtos/index.php");
        break;

    case "logout":
        //implementar futuramente
        session_destroy();

        //redirecionar para a tela de listagem de produtos
        header("location: ../../produtos/index.php");
        break;
}