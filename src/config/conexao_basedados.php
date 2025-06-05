<?php
declare(strict_types=1);

require_once __DIR__ . '/configuracao_variaveis_aplicacao.php';

if (!function_exists('obterConexao')) {
    function obterConexao()
    {
        static $pdo = null;
        if ($pdo === null) {
            $host = BD_SERVIDOR;
            $db   = BD_BASEDADOS;
            $user = BD_USUARIO;
            $pass = BD_SENHA;
            $charset = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($dsn, $user, $pass, $options);
        }
        return $pdo;
    }
}

return obterConexao();
