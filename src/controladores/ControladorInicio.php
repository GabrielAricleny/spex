<?php
declare(strict_types=1);

namespace App\controladores;

class ControladorInicio
{
    public function index(): void
    {
        session_start();

        // Se já estiver logado
        if (isset($_SESSION['utilizador'])) {
            $nivel = $_SESSION['utilizador']['nivel_acesso'] ?? '';

            if ($nivel === 'admin') {
                header('Location: ?rota=painel_admin');
                exit;
            } else {
                header('Location: ?rota=dashboard_estudante');
                exit;
            }
        }

        // Se não estiver logado, mostra a página de início pública
        require __DIR__ . '/../visoes/inicio.php';
    }
}

