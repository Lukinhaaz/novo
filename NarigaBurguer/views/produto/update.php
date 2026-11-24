<?php
    require "../../autoload.php";

    // Instanciar um objeto da classe produto (bean)
    $produto = new produto();

    // Definir os valores dos atributos a partir dos dados do form
    $produto->setNome($_POST['nome']);
    $produto->setPreco($_POST['preco']);
    $produto->setDescricao($_POST['descricao']);
    $produto->setId($_POST['id']);

    // Instanciar um objeto da classe produtoDAO
    $dao = new ProdutoDAO();

    // Invocar o método update da classe produtoDAO
    $dao->update($produto);

    // Redirecionar para o index
    header('Location: index.php');