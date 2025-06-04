<?php

namespace App\modelos;

use PDO;

class NivelAcesso
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function todos(): array
    {
        $sql = "SELECT * FROM nivel_acesso ORDER BY id_nivel DESC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function encontrar(int $id): ?array
    {
        $sql = "SELECT * FROM nivel_acesso WHERE id_nivel = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }

    public function criar(string $descricao): bool
    {
        $sql = "INSERT INTO nivel_acesso (descricao) VALUES (?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$descricao]);
    }

    public function actualizar(int $id, string $descricao): bool
    {
        $sql = "UPDATE nivel_acesso SET descricao = ? WHERE id_nivel = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$descricao, $id]);
    }

    public function eliminar(int $id): bool
    {
        $sql = "DELETE FROM nivel_acesso WHERE id_nivel = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
