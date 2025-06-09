<?php
namespace App\Modelos;

use PDO;

class ModeloListaPerguntasExameSistema
{
    private PDO $pdo;

    public function __construct(PDO $conexao)
    {
        $this->pdo = $conexao;
    }

    public function listar()
    {
        $sql = "SELECT lpes.*, es.duracao, p.enunciado
                FROM lista_perguntas_exame_sistema lpes
                JOIN exame_sistema es ON lpes.id_exame_sistema = es.id_exame
                JOIN pergunta p ON lpes.id_pergunta = p.id_pergunta
                ORDER BY lpes.id_exame_sistema DESC";
        return $this->pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function criar($id_exame_sistema, $id_pergunta)
    {
        $sql = "INSERT INTO lista_perguntas_exame_sistema (id_exame_sistema, id_pergunta) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_exame_sistema, $id_pergunta]);
    }

    public function excluir($id_exame_sistema, $id_pergunta)
    {
        $sql = "DELETE FROM lista_perguntas_exame_sistema WHERE id_exame_sistema = ? AND id_pergunta = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_exame_sistema, $id_pergunta]);
    }

    public function editar($id_exame_sistema, $id_pergunta_antiga, $id_pergunta_nova)
    {
        $sql = "UPDATE lista_perguntas_exame_sistema SET id_pergunta = ? WHERE id_exame_sistema = ? AND id_pergunta = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_pergunta_nova, $id_exame_sistema, $id_pergunta_antiga]);
    }
}