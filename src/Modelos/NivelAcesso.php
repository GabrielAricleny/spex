<?php

namespace App\Modelos;

class NivelAcesso
{
    public static function getConexao()
    {
        return require __DIR__ . '/../../config/conexao_basedados.php';
    }

    public static function todos()
    {
        $pdo = self::getConexao();
        $stmt = $pdo->query("SELECT * FROM nivel_acesso");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public static function deletar($id_nivel)
    {
        $pdo = self::getConexao();
        $stmt = $pdo->prepare("DELETE FROM nivel_acesso WHERE id_nivel = :id_nivel");
        return $stmt->execute(['id_nivel' => $id_nivel]);
    }
}