<?php

namespace App\Modelos;

require_once __DIR__ . '/../config/conexao_basedados.php';

class Administrador
{
    public $id;
    public $nome;
    public $email;
    public $senha;

    public static function todos()
    {
        $pdo = obterConexao();
        $stmt = $pdo->query("SELECT * FROM administrador");
        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::class);
    }

    public static function buscarPorId($id)
    {
        $pdo = obterConexao();
        $stmt = $pdo->prepare("SELECT * FROM administrador WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return $stmt->fetch();
    }

    public function salvar()
    {
        $pdo = obterConexao();
        if (isset($this->id) && !empty($this->id)) {
            $stmt = $pdo->prepare("UPDATE administrador SET nome = :nome, email = :email, senha = :senha WHERE id = :id");
            return $stmt->execute([
                'nome' => $this->nome,
                'email' => $this->email,
                'senha' => $this->senha,
                'id' => $this->id
            ]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO administrador (nome, email, senha) VALUES (:nome, :email, :senha)");
            $result = $stmt->execute([
                'nome' => $this->nome,
                'email' => $this->email,
                'senha' => $this->senha
            ]);
            if ($result) {
                $this->id = $pdo->lastInsertId();
            }
            return $result;
        }
    }

    public function deletar()
    {
        if (!isset($this->id)) return false;
        $pdo = obterConexao();
        $stmt = $pdo->prepare("DELETE FROM administrador WHERE id = :id");
        return $stmt->execute(['id' => $this->id]);
    }
}