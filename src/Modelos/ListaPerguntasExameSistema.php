<?php

namespace App\Modelos;

class ListaPerguntasExameSistema
{
    public $id;
    public $nome;

    public static function getConexao()
    {
        $host = 'localhost';
        $db   = 'spex';
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

    public static function todos()
    {
        $pdo = self::getConexao();
        $stmt = $pdo->query("SELECT * FROM lista_perguntas_exame_sistema");
        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::class);
    }

    public static function buscarPorId($id)
    {
        $pdo = self::getConexao();
        $stmt = $pdo->prepare("SELECT * FROM lista_perguntas_exame_sistema WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return $stmt->fetch();
    }

    public function salvar()
    {
        $pdo = self::getConexao();
        if (isset($this->id) && !empty($this->id)) {
            $stmt = $pdo->prepare("UPDATE lista_perguntas_exame_sistema SET nome = :nome WHERE id = :id");
            return $stmt->execute([
                'nome' => $this->nome,
                'id' => $this->id
            ]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO lista_perguntas_exame_sistema (nome) VALUES (:nome)");
            $result = $stmt->execute(['nome' => $this->nome]);
            if ($result) {
                $this->id = $pdo->lastInsertId();
            }
            return $result;
        }
    }

    public function deletar()
    {
        if (!isset($this->id)) return false;
        $pdo = self::getConexao();
        $stmt = $pdo->prepare("DELETE FROM lista_perguntas_exame_sistema WHERE id = :id");
        return $stmt->execute(['id' => $this->id]);
    }
}