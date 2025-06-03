<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$utilizadorLogado = $_SESSION['utilizador'] ?? null;
$nomeUtilizador   = $utilizadorLogado['nome'] ?? null;
$nivelAcesso      = $utilizadorLogado['nivel_acesso'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-AO">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SPEX | Início</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Bulma CSS (local) -->
    <link rel="stylesheet" href="css/bulma/css/bulma.min.css" />

    <!-- Font Awesome (local) -->
    <link rel="stylesheet" href="css/font_awesome/css/all.min.css" />

    <!-- CSS próprio -->
    <link rel="stylesheet" href="css/main.css" />

    <!-- CSS específico de cada página (carregado dinamicamente) -->
    <?php if (!empty($paginaCss)): ?>
        <?php foreach ((array)$paginaCss as $css): ?>
            <link rel="stylesheet" href="css/<?= htmlspecialchars($css) ?>.css" />
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>

<header>
    <nav class="navbar is-dark is-fixed-top" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="?rota=inicio">
                <img src="/img/spex-logo.png" alt="Logotipo SPEX" style="height: 24px; margin-right: 8px;">
                <strong>SPEX</strong>
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasic">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasic" class="navbar-menu">
            <div class="navbar-start">
                <a href="?rota=inicio" class="navbar-item">Início</a>
                <a href="?rota=sobre" class="navbar-item">Sobre o SPEX</a>
                <a href="?rota=universidades" class="navbar-item">Universidades</a>
                <a href="?rota=faq" class="navbar-item">Perguntas Frequentes</a>

                <?php if ($utilizadorLogado): ?>
                    <?php if ($nivelAcesso === 'admin'): ?>
                        <a href="?rota=painel_admin" class="navbar-item">Painel Admin</a>
                    <?php else: ?>
                        <a href="?rota=dashboard_utilizador" class="navbar-item">Dashboard</a>
                        <a href="?rota=perfil_utilizador" class="navbar-item">Meu Perfil</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="navbar-end">
                <?php if ($utilizadorLogado): ?>
                    <div class="navbar-item">
                        <span>Olá, <strong class="nome-utilizador" style="color: orange;"><?= htmlspecialchars($nomeUtilizador) ?></strong></span>
                    </div>
                    <div class="navbar-item">
                        <?php if ($nivelAcesso === 'admin'): ?>
                            <a href="?rota=sair_admin" class="botao-sair-admin">
                                <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                                <span>Sair</span>
                            </a>
                        <?php else: ?>
                            <a href="?rota=sair_estudante" class="botao-sair-estudante">
                                <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                                <span>Sair</span>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="buttons">
                        <a href="?rota=registro" class="navbar-item" style="color:#fff;">
                            <span class="icon"><i class="fas fa-user-plus"></i></span>
                            <span>Criar Conta</span>
                        </a>

                        <a href="?rota=login_admin" class="navbar-item" style="color:#fff;">
                            <span class="icon"><i class="fas fa-sign-in-alt"></i></span>
                            <span>Entrar</span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>