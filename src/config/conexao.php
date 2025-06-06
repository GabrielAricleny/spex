<?php

namespace Src\Config;

use PDO;
use PDOException;

class Conexao
{
    private static ?PDO $conexao = null;

    public static function obterConexao(): PDO
    {
        if (self::$conexao === null) {
            $config = require __DIR__ . '/config.php';

            try {
                self::$conexao = new PDO(
                    'mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_nome'],
                    $config['db_usuario'],
                    $config['db_senha']
                );
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erro ao conectar: ' . $e->getMessage());
            }
        }

        return self::$conexao;
    }
}
