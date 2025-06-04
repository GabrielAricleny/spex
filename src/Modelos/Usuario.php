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

    // Busca um usuário pelo ID
    public static function buscarPorId($id)
    {
        $pdo = self::getConexao();
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE id_usuario = :id");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return $stmt->fetch();
    }

    // Atualiza os dados do usuário
    public function atualizar($dados)
    {
        $pdo = self::getConexao();
        $stmt = $pdo->prepare("UPDATE usuario SET nome_usuario = :nome_usuario, email = :email, nome_completo = :nome_completo, id_nivel_acesso = :id_nivel_acesso WHERE id_usuario = :id_usuario");
        return $stmt->execute([
            'nome_usuario' => $dados['nome_usuario'],
            'email' => $dados['email'],
            'nome_completo' => $dados['nome_completo'],
            'id_nivel_acesso' => $dados['id_nivel_acesso'],
            'id_usuario' => $this->id_usuario
        ]);
    }

    // Salva os dados do usuário (inserção ou atualização)
    public function salvar()
    {
        $pdo = self::getConexao();
        if (isset($this->id_usuario) && !empty($this->id_usuario)) {
            // Atualização
            $stmt = $pdo->prepare("UPDATE usuario SET nome_usuario = :nome_usuario, nome_completo = :nome_completo, email = :email, senha = :senha, id_nivel_acesso = :id_nivel_acesso WHERE id_usuario = :id_usuario");
            return $stmt->execute([
                'nome_usuario' => $this->nome_usuario,
                'nome_completo' => $this->nome_completo,
                'email' => $this->email,
                'senha' => $this->senha,
                'id_nivel_acesso' => $this->id_nivel_acesso,
                'id_usuario' => $this->id_usuario
            ]);
        } else {
            // Inserção
            $stmt = $pdo->prepare("INSERT INTO usuario (nome_usuario, nome_completo, email, senha, id_nivel_acesso) VALUES (:nome_usuario, :nome_completo, :email, :senha, :id_nivel_acesso)");
            $result = $stmt->execute([
                'nome_usuario' => $this->nome_usuario,
                'nome_completo' => $this->nome_completo,
                'email' => $this->email,
                'senha' => $this->senha,
                'id_nivel_acesso' => $this->id_nivel_acesso
            ]);
            if ($result) {
                $this->id_usuario = $pdo->lastInsertId();
            }
            return $result;
        }
    }

    // Retorna todos os usuários
    public static function todos()
    {
        $pdo = self::getConexao();
        $stmt = $pdo->query("SELECT * FROM usuario");
        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::class);
    }

    // Conexão com o banco de dados usando o arquivo centralizado
    private static function getConexao()
    {
        require_once __DIR__ . '/../config/conexao_basedados.php';
        return obterConexao();
    }
}