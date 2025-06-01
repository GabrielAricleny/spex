<?php
    require_once __DIR__ . '/../src/config/config.php';
    session_start();

    $username = $_POST['username'];
    // $senha = $_POST['senha'];

    $sql = 'SELECT * FROM estudante WHERE nome_usuario = :username';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    // $stmt->bindValue(':senha', $senha);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION['id'] = $resultado['id_estudante'];
    $_SESSION['nome'] = $resultado['nome_estudante'];
    $_SESSION['username'] = $resultado['nome_usuario'];
    $_SESSION['email'] = $resultado['email'];
    $_SESSION['senha'] = $resultado['senha_estudante'];

    header("Location: test_login2.php");
?>