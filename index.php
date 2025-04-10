<?php
session_start(); // Inicia a sessão do usuário

// Carregar configurações do ambiente
require_once __DIR__ . '/src/config/config.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['id_estudante'])) {
    // Se não estiver logado, redirecionar para a página pública
    header("Location: /public/index.html");
    exit();
}

// Se estiver logado, redirecionar para o dashboard do usuário
header("Location: /src/views/dashboard.php");
exit();