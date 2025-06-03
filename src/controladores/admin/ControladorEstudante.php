<?php

namespace App\controladores\admin;

class ControladorEstudante
{
    public function crud()
    {
        // Renderiza a view correta para o CRUD de Estudante
        require_once __DIR__ . '/../../visoes/admin/estudante/crud.php';
    }
}