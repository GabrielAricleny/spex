<?php
declare(strict_types=1);

namespace App\controladores\admin;

class ControladorPainelAdmin
{
    public function painel(): void
    {
        // Renderize o painel do admin
        include __DIR__ . '/../../visoes/admin/painel_admin.php';
    }
}
