<?php
namespace App\Modelos;

use PDO;

class ModeloTema
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function listar(): array
    {
        $stmt = $this->db->query("SELECT * FROM tema ORDER BY id_tema");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM tema WHERE id_tema = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function criar(string $nome): bool
    {
        $stmt = $this->db->prepare("INSERT INTO tema (nome_tema) VALUES (?)");
        return $stmt->execute([$nome]);
    }

    public function atualizar(int $id, string $nome): bool
    {
        $stmt = $this->db->prepare("UPDATE tema SET nome_tema = ? WHERE id_tema = ?");
        return $stmt->execute([$nome, $id]);
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM tema WHERE id_tema = ?");
        return $stmt->execute([$id]);
    }
}