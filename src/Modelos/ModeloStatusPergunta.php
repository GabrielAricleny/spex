<?php
namespace App\Modelos;

use PDO;

class ModeloStatusPergunta
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function listar(): array
    {
        $stmt = $this->db->query("SELECT * FROM status_pergunta ORDER BY id_status");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM status_pergunta WHERE id_status = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function criar(string $descricao): bool
    {
        $stmt = $this->db->prepare("INSERT INTO status_pergunta (descricao_status) VALUES (?)");
        return $stmt->execute([$descricao]);
    }

    public function atualizar(int $id, string $descricao): bool
    {
        $stmt = $this->db->prepare("UPDATE status_pergunta SET descricao_status = ? WHERE id_status = ?");
        return $stmt->execute([$descricao, $id]);
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM status_pergunta WHERE id_status = ?");
        return $stmt->execute([$id]);
    }
}