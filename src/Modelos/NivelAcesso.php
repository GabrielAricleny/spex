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
}