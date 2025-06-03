<?php

namespace App\controladores\admin;

class ControladorDisciplinaCurso
{
    public function crud()
    {
        // Renderiza a view correta para o CRUD de Disciplina do Curso
        require_once __DIR__ . '/../../visoes/admin/disciplina_curso/crud.php';
    }
}