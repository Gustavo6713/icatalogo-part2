<?php
session_start();
require("../../database/conexao.php");

function validarCampos(){
    $erros = [];

    if (!isset($_POST["usuario"]) && $_POST["usuario"] == "") {
        $erros = "O usuário é obrigatório";
    }

    if (!isset($_POST["senha"]) && $_POST["senha"] == "") {
        $erros = "A senha é obrigatório";
    }

    return $erros;
}

//autenticação
switch ($_POST["acao"]) {
    case "login":

        $erros = validarCampos();

        if (count($erros) > 0) {
            $_SESSION["erros"] = $erros;

            header("location: ../../produtos/index.php");
        }

        //receber os campos do fomulário (usuario e senha)
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];

        //montar o sql select na tabela tbl_adminitrador
        $sql = " SELECT * FROM tbl_administrador WHERE usuario = '$usuario' ";

        //executar o sql
        $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

        $usuario = mysqli_fetch_array($resultado);

        //verificar se o usuário existe e se a senha está correta
        if (!$usuario || !password_verify($senha, $usuario["senha"])){
            $erros[] = "Usuário ou senha inválidos";
        } else {
            $_SESSION["usuarioId"] = $usuario["id"];
            $_SESSION["usuarioNome"] = $usuario["nome"];
        }

        //redirecionar para tela de listagem de produtos
        header("location: ../../produtos/index.php");

        break;

    case "logout":
        //implementa logout
        session_destroy();

        header("location: ../../produtos/index.php");

        break;
}