<?php

namespace App\controladores\admin;

class ControladorExameSistema
{
    public function crud()
    {
        // Renderiza a view correta para o CRUD de Exame do Sistema
        require_once __DIR__ . '/../../visoes/admin/exame_sistema/crud.php';
    }
}