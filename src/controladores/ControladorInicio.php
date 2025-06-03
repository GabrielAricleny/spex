<?php
declare(strict_types=1);

namespace App\controladores;

class ControladorInicio
{
    public function index(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Permite voltar ao início mesmo se logado, mas mostra links conforme o nível de acesso
        $nivel = $_SESSION['utilizador']['nivel_acesso'] ?? null;

        // Define variáveis para a view saber quais links mostrar
        $links = [
            'admin' => false,
            'estudante' => false,
            'publico' => false,
        ];

        if ($nivel === 'admin') {
            $links['admin'] = true;
        } elseif ($nivel === 'estudante') {
            $links['estudante'] = true;
        } else {
            $links['publico'] = true;
        }

        // A view pode usar $links para mostrar os links activos
        include __DIR__ . '/../visoes/inicio.php';
    }
}