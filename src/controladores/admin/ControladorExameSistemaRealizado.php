<?php

namespace App\controladores\admin;

class ControladorExameSistemaRealizado
{
    public function crud()
    {
        // Renderiza a view correta para o CRUD de Exame do Sistema Realizado
        require_once __DIR__ . '/../../visoes/admin/exame_sistema_realizado/crud.php';
    }
}