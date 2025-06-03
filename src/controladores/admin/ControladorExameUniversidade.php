<?php

namespace App\controladores\admin;

class ControladorExameUniversidade
{
    public function crud()
    {
        // Renderiza a view correta para o CRUD de Exame da Universidade
        require_once __DIR__ . '/../../visoes/admin/exame_universidade/crud.php';
    }
}