<?php
namespace App\Modelos;

use PDO;

class ModeloPergunta
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function listar(): array
    {
        $stmt = $this->db->query("SELECT * FROM pergunta ORDER BY id_pergunta DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM pergunta WHERE id_pergunta = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function criar(array $dados): bool
    {
        $stmt = $this->db->prepare("INSERT INTO pergunta (enunciado, curso, resposta, disciplina, tema, status, criada_em) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        return $stmt->execute([
            $dados['enunciado'],
            $dados['curso'],
            $dados['resposta'],
            $dados['disciplina'],
            $dados['tema'],
            $dados['status']
        ]);
    }

    public function atualizar(int $id, array $dados): bool
    {
        $stmt = $this->db->prepare("UPDATE pergunta SET enunciado = ?, curso = ?, resposta = ?, disciplina = ?, tema = ?, status = ?, actualizada_em = NOW() WHERE id_pergunta = ?");
        return $stmt->execute([
            $dados['enunciado'],
            $dados['curso'],
            $dados['resposta'],
            $dados['disciplina'],
            $dados['tema'],
            $dados['status'],
            $id
        ]);
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM pergunta WHERE id_pergunta = ?");
        return $stmt->execute([$id]);
    }
}