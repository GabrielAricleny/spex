<?php
declare(strict_types=1);

namespace App\config;

class Verificacoes
{
    /**
     * Garante que o utilizador esteja autenticado com o nível de acesso especificado.
     *
     * @param string $nivel O nível de acesso necessário (ex: 'admin', 'estudante').
     */
    public static function autenticadoComo(string $nivel): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            !isset($_SESSION['utilizador']) ||
            ($_SESSION['utilizador']['nivel_acesso'] ?? '') !== $nivel
        ) {
            http_response_code(403);
            require __DIR__ . '/../visoes/templates/erro_403.php';
            exit;
        }
    }

    /**
     * Garante que qualquer utilizador esteja autenticado, independentemente do nível.
     */
    public static function autenticado(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['utilizador'])) {
            header('Location: ?rota=login_estudante');
            exit;
        }
    }

    /**
     * Redirecciona se o utilizador já estiver autenticado.
     * Útil para páginas como login ou registo.
     */
    public static function redirecionarSeAutenticado(string $rotaDestino = 'inicio'): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['utilizador'])) {
            header("Location: ?rota=$rotaDestino");
            exit;
        }
    }
}

