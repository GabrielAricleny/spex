<?php

namespace App\Modelos;

class NivelAcesso
{
    public static function getConexao()
    {
        return require __DIR__ . '/../config/conexao_basedados.php'; // Caminho corrigido
    }

    public static function todos()
    {
        $pdo = self::getConexao();
        $stmt = $pdo->query("SELECT * FROM nivel_acesso");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public static function eliminar($id_nivel)
    {
        $pdo = self::getConexao();
        $stmt = $pdo->prepare("DELETE FROM nivel_acesso WHERE id_nivel = :id_nivel");
        return $stmt->execute(['id_nivel' => $id_nivel]);
    }
    
    public static function encontrar($id_nivel)
    {
        $pdo = self::getConexao();
        $stmt = $pdo->prepare("SELECT * FROM nivel_acesso WHERE id_nivel = :id_nivel");
        $stmt->execute(['id_nivel' => $id_nivel]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    public static function actualizar($id_nivel, $descricao)
    {
        $pdo = self::getConexao();
        $stmt = $pdo->prepare("UPDATE nivel_acesso SET descricao = :descricao WHERE id_nivel = :id_nivel");
        return $stmt->execute([
            'descricao' => $descricao,
            'id_nivel' => $id_nivel
        ]);
    }
    
    public static function criar($descricao)
    {
        $pdo = self::getConexao();
        $stmt = $pdo->prepare("INSERT INTO nivel_acesso (descricao) VALUES (:descricao)");
        return $stmt->execute(['descricao' => $descricao]);
    }
}