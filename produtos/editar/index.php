<?php
session_start();

// verifica se o usuário não esta logado
if(!isset($_SESSION["usuarioId"])){
    // declara e coloca um erro nas mensagem da sessão
    $_SESSION["mensagem"] = "Acesso negado, você precisa logar.";
    
// redirecionamos para listagem de produtos
    header("location: ../index.php");
}

require("../../database/conexao.php");

$produtoId = $_GET["id"];
$sqlProduto = " SELECT * FROM tbl_produto WHERE id = $produtoId ";
$resultado = mysqli_query($conexao, $sqlProduto);
$produto = mysqli_fetch_array($resultado);

if(!$produto){
  echo "Produto não encontrado!";

  exit();
}

$sql = " SELECT * FROM tbl_categoria ";

$resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../styles-global.css" />
  <link rel="stylesheet" href="./editar.css" />
  <title>Editar Produtos</title>
</head>

<body>
  <?php
    include("../../componentes/header/header.php")
  ?>
  <div class="content">
    <section class="produtos-container">
      <main>
        <form class="form-produto" method="POST" action="../novo/acoes.php" enctype="multipart/form-data">
          <input type="hidden" name="acao" value="editar" />
          <input type="hidden" name="produtoId" value="<?= $produto["id"] ?>" />
          <h1>Editar produto</h1>
          <ul>
            <?php
            // se tiver erros na sessao, listar os erros na tela
              if(isset($_SESSION["erros"])){
                foreach($_SESSION["erros"] as $erro){
            ?>
                  <li><?= $erro ?></li>
            <?php
                }
                unset($_SESSION["erros"]);
              }
            ?>
          </ul>
          <div class="input-group span2">
            <label for="descricao">Descrição</label>
            <input type="text" value="<?= $produto['descricao'] ?>" name="descricao" id="descricao" placeholder="Digite a descrição do produto" required>
          </div>
          <div class="input-group">
            <label for="peso">Peso</label>
            <input type="text" name="peso" value="<?= number_format($produto['peso'], 2, ",", ".") ?>" id="peso" placeholder="Digite o peso" required>
          </div>
          <div class="input-group">
            <label for="quantidade">Quantidade</label>
            <input type="text" name="quantidade" value="<?= $produto['quantidade'] ?>" id="quantidade" placeholder="Digite a quantidade" required>
          </div>
          <div class="input-group">
            <label for="cor">Cor</label>
            <input type="text" name="cor" value="<?= $produto['cor'] ?>" id="cor" placeholder="Digite a cor" required>
          </div>
          <div class="input-group">
            <label for="tamanho">Tamanho</label>
            <input type="text" name="tamanho" value="<?= $produto['tamanho'] ?>" id="tamanho" placeholder="Digite o tamanho">
          </div>
          <div class="input-group">
            <label for="valor">Valor</label>
            <input type="text" name="valor" value="<?= number_format($produto['valor'], 2, ",", ".") ?>" id="valor" placeholder="Digite o valor" required>
          </div>
          <div class="input-group">
            <label for="desconto">Desconto</label>
            <input type="text" name="desconto" value="<?= $produto['desconto'] ?>" id="desconto" placeholder="Digite o desconto">
          </div>
          <div class="input-group">
            <label for="categoria">Categorias</label>
            <select type="text" name="categoria" id="categoria" required>
              <option value="">SELECIONE</option>
              <?php
                while ($categoria = mysqli_fetch_array($resultado)){
                ?>
                  <option value="<?= $categoria["id"] ?>" <?= $categoria["id"] == $produto["categoria_id"] ? "selected" : "" ?>>
                    <?= $categoria["descricao"] ?>
                  </option>  
                <?php
                }
               ?>
            </select> 
          </div>
          <div class="input-group">
                <label for="foto">Foto</label>
                <input type="file" name="foto" accept="image/*">
          </div>
          <button onclick="javascript:window.location.href = '../'">Cancelar</button>
          <button>Salvar</button>
        </form>
      </main>
    </section>
  </div>
  <footer>
    SENAI 2021 - Todos os direitos reservados
  </footer>
</body>

</html>