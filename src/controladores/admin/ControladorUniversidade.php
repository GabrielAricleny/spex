<?php

namespace App\controladores\admin;

class ControladorUniversidade
{
    public function crud()
    {
        // Renderiza a view correta para o CRUD de Universidade
        require_once __DIR__ . '/../../visoes/admin/universidade/crud.php';
    }
}