<?php
    session_start();
    echo 'Id estudante: ' . $_SESSION['id'] . '<br>';
    echo 'Nome estudante: ' . $_SESSION['nome'] . '<br>';
    echo 'Nome Usuario: ' . $_SESSION['username'] . '<br>';
    echo 'Email: ' . $_SESSION['email'] . '<br>';
    echo 'Senha: ' . $_SESSION['senha'] . '<br>';
?>