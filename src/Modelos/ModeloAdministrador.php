<?php
declare(strict_types=1);

namespace App\Modelos;

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
            $caminho = __DIR__ . '/../config/conexao_basedados.php';
            if (!file_exists($caminho)) {
                throw new \RuntimeException('Arquivo de conexão não encontrado.');
            }
            require_once $caminho;
            self::$pdo = obterConexao();
            if (!(self::$pdo instanceof PDO)) {
                throw new \RuntimeException('Falha ao obter conexão PDO.');
            }
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

        if (!$admin) {
            echo "Email não encontrado.<br>";
            return null;
        }

        if (!password_verify($senha, $admin['senha'])) {
            echo "Senha incorreta.<br>";
            return null;
        }

        unset($admin['senha']);
        $admin['nivel_acesso'] = 'admin';
        return $admin;
    }
}
