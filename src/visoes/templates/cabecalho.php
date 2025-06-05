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

    <style>
    /* Remove qualquer espaço extra do menu */
    .navbar,
    .navbar.is-dark,
    .navbar.is-fixed-top,
    header {
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        background: #23272b !important;
    }

    .navbar {
        border-radius: 0 !important;
        min-height: 56px;
    }

    /* Cor padrão: branco, hover: violeta */
    .navbar .navbar-item,
    .navbar .navbar-brand {
        color: #fff !important;
    }

    .navbar .navbar-item:hover,
    .navbar .navbar-item:focus,
    .navbar .navbar-end .buttons .navbar-item:hover,
    .navbar .navbar-end .buttons .navbar-item:focus {
        background: transparent !important;
        color: #8f5fff !important;
    }

    .navbar .navbar-end .buttons .navbar-item {
        margin-left: 8px;
        margin-right: 0;
        padding-bottom: 0 !important;
    }

    .navbar .navbar-end .buttons {
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
        margin-right: 15px !important; /* aumenta o afastamento do grupo de botões da margem direita */
    }

    header {
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
    }

    body {
        background: #181a1b;
        /* ... */
    }

    .navbar-item .link-admin {
        color: #8f5fff !important; /* mantém o violeta durante o hover */
    }
    
    .navbar-item .link-admin:hover a {
        color: #fff;
    }

    /* Ajuste para todos os ícones dos botões do menu ficarem próximos ao texto */
    .navbar-item .icon {
        margin-right: -0.5rem;
        display: inline-flex;
        align-items: center;
        vertical-align: middle;
        font-size: 1em;
        height: 1em;
    }

    .navbar-item .icon i {
        position: relative;
        top: 1px; /* ajuste fino, pode ser 0, 1px ou 2px conforme o resultado visual */
    }

    /* Área Administrativa: cor padrão laranja, hover violeta */
    .navbar .navbar-end .buttons .navbar-item.link-admin,
    .navbar .navbar-end .buttons .navbar-item[style*="color:#ffb84d"] {
        color: #ffb84d !important;
    }
    .navbar .navbar-end .buttons .navbar-item.link-admin:hover,
    .navbar .navbar-end .buttons .navbar-item[style*="color:#ffb84d"]:hover {
        color: #8f5fff !important;
        background: transparent !important;
    }

    /* Área Administrativa: cor padrão igual aos outros links quando não logado */
    .navbar .navbar-end .buttons .navbar-item[style*="color:#ffb84d"]:not(.link-admin) {
        color: #fff !important;
    }
    .navbar .navbar-end .buttons .navbar-item[style*="color:#ffb84d"]:not(.link-admin):hover,
    .navbar .navbar-end .buttons .navbar-item[style*="color:#ffb84d"]:not(.link-admin):focus {
        color: #8f5fff !important;
        background: transparent !important;
    }

    /* Quando logado como admin, mantém o destaque laranja */
    .navbar .navbar-end .buttons .navbar-item.link-admin {
        color: #ffb84d !important;
    }
    .navbar .navbar-end .buttons .navbar-item.link-admin:hover,
    .navbar .navbar-end .buttons .navbar-item.link-admin:focus {
        color: #8f5fff !important;
        background: transparent !important;
    }
    </style>
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
                    <?php if ($nivelAcesso !== 'admin'): ?>
                        <a href="?rota=dashboard_utilizador" class="navbar-item">Dashboard</a>
                        <a href="?rota=perfil_utilizador" class="navbar-item">Meu Perfil</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="navbar-end">
                <?php if ($utilizadorLogado): ?>
                    <div class="navbar-item">
                        <?php if ($nivelAcesso === 'admin'): ?>
                            <div class="buttons">
                                <a href="?rota=painel_admin" class="navbar-item link-admin" style="color:#ffb84d;">
                                    <span class="icon"><i class="fas fa-user-shield"></i></span>
                                    <span>Área Administrativa</span>
                                </a>
                                <a href="?rota=sair_admin" class="navbar-item">
                                    <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                                    <span>Sair</span>
                                </a>
                            </div>
                        <?php else: ?>
                            <a href="?rota=sair_estudante" class="botao-sair-estudante">
                                <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                                <span>Sair</span>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="buttons">
                        <a href="?rota=cadastro_estudante" class="navbar-item">
                            <span class="icon"><i class="fas fa-user-plus"></i></span>
                            <span>Criar Conta</span>
                        </a>
                        <a href="?rota=login_estudante" class="navbar-item navbar-item-entrar">
                            <span class="icon"><i class="fas fa-sign-in-alt"></i></span>
                            <span>Entrar</span>
                        </a>
                        <a href="?rota=login_admin" class="navbar-item" style="color:#ffb84d;">
                            <span class="icon"><i class="fas fa-user-shield"></i></span>
                            <span>Área Administrativa</span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>