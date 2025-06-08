<?php
declare(strict_types=1);

namespace App\controladores\admin;

class ControladorPainelAdmin
{
    public function painel(): void
    {
        // Verifica se o utilizador está autenticado e tem nível de acesso 'admin'
        if (!isset($_SESSION['utilizador']) || ($_SESSION['utilizador']['nivel_acesso'] ?? null) !== 'admin') {
            header('Location: ?rota=inicio');
            exit;
        }

        // Renderize o painel do admin
        include __DIR__ . '/../../visoes/admin/painel_admin.php';
    }
}
