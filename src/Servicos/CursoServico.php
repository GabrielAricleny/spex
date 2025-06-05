<?php

namespace App\servicos;

use App\Modelos\Curso;

class CursoServico
{
    private $pdo;

    public function __construct()
    {
        // Carrega a conexão centralizada apenas uma vez
        $this->pdo = require __DIR__ . '/../config/conexao_basedados.php';
    }

    public function listarTodos()
    {
        return Curso::todos();
    }

    public function buscarPorId($id)
    {
        return Curso::buscarPorId($id);
    }

    public function criar($dados)
    {
        $stmt = $this->pdo->prepare("INSERT INTO curso (nome_curso, nivel_curso) VALUES (:nome_curso, :nivel_curso)");
        return $stmt->execute([
            'nome_curso' => $dados['nome_curso'],
            'nivel_curso' => $dados['nivel'] // 'nivel' do formulário, mas 'nivel_curso' na tabela
        ]);
    }

    public function atualizar($id, $dados)
    {
        $stmt = $this->pdo->prepare("UPDATE curso SET nome_curso = :nome_curso, nivel_curso = :nivel_curso WHERE id_curso = :id");
        return $stmt->execute([
            'nome_curso' => $dados['nome_curso'],
            'nivel_curso' => $dados['nivel'],
            'id' => $id
        ]);
    }

    public function deletar($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM curso WHERE id_curso = :id_curso");
        return $stmt->execute(['id_curso' => $id]);
    }
}