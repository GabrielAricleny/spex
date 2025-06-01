<?php
require_once __DIR__ . '/configuracao_basedados.php';

try {
    $dsn = "mysql:host=" . BD_SERVIDOR . ";port=" . BD_PORTA . ";dbname=" . BD_BASEDADOS . ";charset=utf8mb4";
    $conexao = new PDO($dsn, BD_USUARIO, BD_SENHA, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $erro) {
    die("Erro na conexão com a base de dados: " . $erro->getMessage());
} 

