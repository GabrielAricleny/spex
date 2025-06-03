<?php

namespace App\controladores\admin;

class ControladorDisciplina
{
    public function crud()
    {
        // Caminho corrigido para a view correta
        include __DIR__ . '/../../visoes/admin/disciplina/crud.php';
    }
}