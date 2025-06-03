<?php

namespace App\controladores\admin;

class ControladorHistoricoAlunoExameSistema
{
    public function crud()
    {
        // Renderiza a view correta para o CRUD de Histórico de Aluno em Exame do Sistema
        require_once __DIR__ . '/../../visoes/admin/historico_aluno_exame_sistema/crud.php';
    }
}