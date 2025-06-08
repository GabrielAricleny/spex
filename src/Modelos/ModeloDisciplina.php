<?php
namespace App\Modelos;

use PDO;

class ModeloDisciplina
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function listar(): array
    {
        $stmt = $this->db->query("SELECT * FROM disciplina ORDER BY nome_disciplina");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM disciplina WHERE id_disciplina = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function criar(string $nome): bool
    {
        $stmt = $this->db->prepare("INSERT INTO disciplina (nome_disciplina) VALUES (?)");
        return $stmt->execute([$nome]);
    }

    public function atualizar(int $id, string $nome): bool
    {
        $stmt = $this->db->prepare("UPDATE disciplina SET nome_disciplina = ? WHERE id_disciplina = ?");
        return $stmt->execute([$nome, $id]);
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM disciplina WHERE id_disciplina = ?");
        return $stmt->execute([$id]);
    }
}