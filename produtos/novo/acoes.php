<?php

session_start();

function validarCampos()
{
    $erros = [];

    //validar se campo descricao está preenchido
    if (!isset($_POST["descricao"]) && $_POST["descricao"] == "") {
        $erros[] = "O campo descrição é obrigatório";
    }

    //validar se o campo peso está preenchido
    if (!isset($_POST["peso"]) && $_POST["peso"] == "") {
        $erros[] = "O campo peso é obrigatório";
        //validar se o campo peso é um número
    } elseif (!is_numeric(str_replace(",", ".", $_POST["peso"]))) {
        $erros[] = "O campo peso deve ser um número";
    }

    //validar se o campo quantidade está preenchido
    if (!isset($_POST["quantidade"]) && $_POST["quantidade"] == "") {
        $erros[] = "O campo quantidade é obrigatório";
        //validar se o campo quantidade é um número
    } elseif (!is_numeric(str_replace(",", ".", $_POST["quantidade"]))) {
        $erros[] = "O campo quantidade deve ser um número";
    }

    if (!isset($_POST["cor"]) && $_POST["cor"] == "") {
        $erros[] = "O campo cor é obrigatório";
    }

    if (!isset($_POST["valor"]) && $_POST["valor"] == "") {
        $erros[] = "O campo valor é obrigatório";
    } elseif (!is_numeric(str_replace(",", ".", $_POST["valor"]))) {
        $erros[] = "O campo valor deve ser um número";
    }

    //se o campo desconto veio preenchidotesta se ele é numérico
    if (isset($_POST["desconto"]) && $_POST["desconto"] != "" && !is_numeric(str_replace(",", ".", $_POST["desconto"]))) {
        $erros[] = "O campo desconto deve ser um número";
    }

    return $erros;
}

require("../../database/conexao.php");

switch ($_POST["acao"]) {

    case "inserir":
        //Função validação para verificicar erros
        $erros = validarCampos();

        if (count($erros) > 0) {

            $_SESSION["erros"] = $erros;

            header("location: novo/index.php");
        }

        //recebe os valores em variáveis
        $descricao = $_POST["descricao"];
        $peso = str_replace(",", ".", $_POST["peso"]);
        $quantidade = $_POST["quantidade"];
        $cor = $_POST["cor"];
        $tamanho = $_POST["tamanho"];
        $valor = str_replace(",", ".", $_POST["valor"]);
        $desconto = $_POST["desconto"] != "" ? $_POST["desconto"] : 0;

        //declara o sql de insert no banco de dados
        $sqlInsert = " INSERT INTO tbl_produto (descricao, peso, quantidade, cor, tamanho, valor, desconto) 
                        VALUES ('$descricao', $peso, $quantidade, '$cor', '$tamanho', $valor, $desconto) ";

        echo $sqlInsert;

        //executamos o sql
        $resultado = mysqli_query($conexao, $sqlInsert) or die(mysqli_error($conexao));

        if ($resultado) {
            $mensagem = "Produto inserido com sucesso!";
        } else {
            $mensagem = "Erro ao inserir o produto!";
        }

        header("location: http://localhost/Web-backend/icatalogo-part2/produtos/");

        break;
}