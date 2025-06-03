<?php

namespace App\Modelos;

class Usuario
{
    public $id_usuario;
    public $nome_usuario;
    public $email;
    public $senha;
    public $nome_completo;
    public $id_nivel_acesso;

    // Busca todos os usuários
    public static function todos()
    {
        $pdo = self::getConexao();
        $stmt = $pdo->query("SELECT * FROM usuario");
        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::class);
    }

    // Busca um usuário pelo ID
    public static function buscarPorId($id)
    {
        $pdo = self::getConexao();
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE id_usuario = :id");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return $stmt->fetch();
    }

    // Salva (insere ou atualiza) o usuário
    public function salvar()
    {
        $pdo = self::getConexao();
        if (isset($this->id_usuario) && !empty($this->id_usuario)) {
            // Atualizar
            $stmt = $pdo->prepare("UPDATE usuario SET nome_usuario = :nome_usuario, email = :email, senha = :senha, nome_completo = :nome_completo, id_nivel_acesso = :id_nivel_acesso WHERE id_usuario = :id_usuario");
            return $stmt->execute([
                'nome_usuario' => $this->nome_usuario,
                'email' => $this->email,
                'senha' => $this->senha,
                'nome_completo' => $this->nome_completo,
                'id_nivel_acesso' => $this->id_nivel_acesso,
                'id_usuario' => $this->id_usuario
            ]);
        } else {
            // Inserir
            $stmt = $pdo->prepare("INSERT INTO usuario (nome_usuario, email, senha, nome_completo, id_nivel_acesso) VALUES (:nome_usuario, :email, :senha, :nome_completo, :id_nivel_acesso)");
            $result = $stmt->execute([
                'nome_usuario' => $this->nome_usuario,
                'email' => $this->email,
                'senha' => $this->senha,
                'nome_completo' => $this->nome_completo,
                'id_nivel_acesso' => $this->id_nivel_acesso
            ]);
            if ($result) {
                $this->id_usuario = $pdo->lastInsertId();
            }
            return $result;
        }
    }

    // Deleta o usuário
    public function deletar()
    {
        if (!isset($this->id_usuario)) {
            return false;
        }
        $pdo = self::getConexao();
        $stmt = $pdo->prepare("DELETE FROM usuario WHERE id_usuario = :id_usuario");
        return $stmt->execute(['id_usuario' => $this->id_usuario]);
    }

    // Conexão com o banco de dados (ajuste conforme necessário)
    private static function getConexao()
    {
        // Substitua pelos dados reais do seu banco
        $host = 'localhost';
        $db   = 'db_spex';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        return new \PDO($dsn, $user, $pass, $options);
    }
}