<?php
namespace App\Modelos;

use PDO;

class ModeloDisciplinaCurso
{
    private PDO $pdo;

    public function __construct(PDO $conexao)
    {
        $this->pdo = $conexao;
    }

    public function listar()
    {
        $sql = "SELECT dc.id_disciplina, dc.id_curso, dc.criado_em,
                       d.nome_disciplina, c.nome_curso
                  FROM disciplina_curso dc
                  JOIN disciplina d ON d.id_disciplina = dc.id_disciplina
                  JOIN curso c ON c.id_curso = dc.id_curso
              ORDER BY c.nome_curso, d.nome_disciplina";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id_disciplina, $id_curso)
    {
        $sql = "SELECT * FROM disciplina_curso WHERE id_disciplina = ? AND id_curso = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_disciplina, $id_curso]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($id_disciplina, $id_curso)
    {
        $sql = "INSERT INTO disciplina_curso (id_disciplina, id_curso, criado_em) VALUES (?, ?, NOW())";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_disciplina, $id_curso]);
    }

    public function atualizar($id_disciplina_antigo, $id_curso_antigo, $id_disciplina, $id_curso)
    {
        $sql = "UPDATE disciplina_curso SET id_disciplina = ?, id_curso = ? WHERE id_disciplina = ? AND id_curso = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_disciplina, $id_curso, $id_disciplina_antigo, $id_curso_antigo]);
    }

    public function excluir($id_disciplina, $id_curso)
    {
        $sql = "DELETE FROM disciplina_curso WHERE id_disciplina = ? AND id_curso = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_disciplina, $id_curso]);
    }
}