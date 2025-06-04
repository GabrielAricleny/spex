<?php
declare(strict_types=1);

namespace App\config;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Middleware: Verifica se o administrador está autenticado.
 */
function autenticadoAdmin(): void
{
    if (
        !isset($_SESSION['utilizador']) ||
        ($_SESSION['utilizador']['nivel_acesso'] ?? '') !== 'admin'
    ) {
        header('Location: ?rota=login_admin');
        exit;
    }
}

/**
 * Middleware: Verifica se o estudante está autenticado.
 */
function autenticadoEstudante(): void
{
    if (
        !isset($_SESSION['utilizador']) ||
        ($_SESSION['utilizador']['nivel_acesso'] ?? '') !== 'estudante'
    ) {
        header('Location: ?rota=login_estudante');
        exit;
    }
}

/**
 * Middleware: Verifica se o utilizador tem nível de acesso "admin".
 * Mostra erro 403 se não for autorizado.
 */
function apenasAdmin(): void
{
    if (
        !isset($_SESSION['utilizador']) ||
        ($_SESSION['utilizador']['nivel_acesso'] ?? '') !== 'admin'
    ) {
        http_response_code(403);
        require __DIR__ . '/../visoes/templates/erro_403.php';
        exit;
    }
}

/**
 * Middleware: Verifica se o utilizador tem nível de acesso "estudante".
 * Mostra erro 403 se não for autorizado.
 */
function apenasEstudante(): void
{
    if (
        !isset($_SESSION['utilizador']) ||
        ($_SESSION['utilizador']['nivel_acesso'] ?? '') !== 'estudante'
    ) {
        http_response_code(403);
        require __DIR__ . '/../visoes/templates/erro_403.php';
        exit;
    }
}

