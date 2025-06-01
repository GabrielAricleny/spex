<?php
declare(strict_types=1);

namespace App\modelos;

use PDO;
use PDOException;

class ModeloAdministrador
{
    private static ?PDO $pdo = null;

    /**
     * Garante que a conexão PDO esteja carregada a partir do arquivo externo.
     */
    private static function inicializarConexao(): void
    {
        if (self::$pdo === null) {
            require_once __DIR__ . '/../config/conexao_basedados.php';
            if (!isset($conexao)) {
                throw new PDOException("A variável \$conexao não foi definida em conexao_basedados.php.");
            }
            self::$pdo = $conexao;
        }
    }

    /**
     * Tenta autenticar um administrador com email e senha.
     *
     * @param string $email Email do administrador.
     * @param string $senha Senha fornecida.
     * @return array|null Dados do administrador (sem a senha) ou null se falhar.
     */
    public static function login(string $email, string $senha): ?array
    {	
        self::inicializarConexao();

        $sql = 'SELECT id_usuario, nome_completo, email, senha FROM usuario WHERE email = :email LIMIT 1';
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($senha, $admin['senha'])) {
            unset($admin['senha']);
            $admin['nivel_acesso'] = 'admin';
            return $admin;
        }

        return null;
    }
}
