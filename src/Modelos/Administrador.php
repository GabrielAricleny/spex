<?php

namespace App\Modelos;

class Administrador
{
    public $id_administrador;
    public $id_usuario;
    public $telefone;

    // Dados do usuário relacionados
    public $usuario; // objeto Usuario

    // Adicione as propriedades vindas do JOIN
    public $nome_usuario;
    public $nome_completo;
    public $email;

    public static function todos()
    {
        $pdo = self::getConexao();
        $stmt = $pdo->query("SELECT a.*, u.id_usuario, u.nome_usuario, u.email FROM administrador a JOIN usuario u ON a.id_usuario = u.id_usuario");
        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::class);
    }

    public static function buscarPorId($id)
    {
        $pdo = self::getConexao();
        $stmt = $pdo->prepare("SELECT a.*, u.nome_usuario, u.nome_completo, u.email FROM administrador a JOIN usuario u ON a.id_usuario = u.id_usuario WHERE a.id_administrador = :id");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return $stmt->fetch();
    }

    public function atualizar($dados)
    {
        $pdo = self::getConexao();
        $stmt = $pdo->prepare("UPDATE administrador SET telefone = :telefone WHERE id_administrador = :id_administrador");
        return $stmt->execute([
            'telefone' => $dados['telefone'],
            'id_administrador' => $this->id_administrador
        ]);
    }

    public function salvar()
    {
        $pdo = self::getConexao();
        $stmt = $pdo->prepare("INSERT INTO administrador (id_usuario, telefone) VALUES (:id_usuario, :telefone)");
        $result = $stmt->execute([
            'id_usuario' => $this->id_usuario,
            'telefone' => $this->telefone
        ]);
        if ($result) {
            $this->id_administrador = $pdo->lastInsertId();
        }
        return $result;
    }

    private static function getConexao()
    {
        require_once __DIR__ . '/../config/conexao_basedados.php';
        return obterConexao();
    }
}