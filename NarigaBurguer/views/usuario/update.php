<?php
    require "../../autoload.php";

    // Instanciar um objeto da classe usuario (bean)
    $usuario = new Usuario();

    $usuario->setNome($_POST['nome']);
    $usuario->setEmail($_POST['email']);
    $usuario->setTelefone($_POST['telefone']);
    $usuario->setId($_POST['id']);

    // Instanciar um objeto da classe usuarioDAO
    $dao = new UsuarioDAO();

    // Invocar o método update da classe UsuarioDAO
    $dao->update($usuario);

    // Redirecionar para o index
    
   header('Location: index.php');