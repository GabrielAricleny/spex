<?php
namespace App\Modelos;

use PDO;

class ModeloUniversidade
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function listar(): array
    {
        $stmt = $this->db->query("SELECT * FROM universidade ORDER BY nome_universidade");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM universidade WHERE id_universidade = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function criar(string $nome, string $abreviado): bool
    {
        $stmt = $this->db->prepare("INSERT INTO universidade (nome_universidade, nome_abreviado) VALUES (?, ?)");
        return $stmt->execute([$nome, $abreviado]);
    }

    public function atualizar(int $id, string $nome, string $abreviado): bool
    {
        $stmt = $this->db->prepare("UPDATE universidade SET nome_universidade = ?, nome_abreviado = ? WHERE id_universidade = ?");
        return $stmt->execute([$nome, $abreviado, $id]);
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM universidade WHERE id_universidade = ?");
        return $stmt->execute([$id]);
    }
}