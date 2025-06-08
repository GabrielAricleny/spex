<?php
declare(strict_types=1);

namespace App\Modelos;

require_once __DIR__ . '/../config/conexao_basedados.php';

class Curso
{
    public $id_curso;
    public $nome_curso;
    public $nivel;
    public $nivel_curso;
    public $criado_em;
    public $actualizado_em;

    protected static function getConexao()
    {
        // Usa a função global obterConexao() definida no conector central
        return obterConexao();
    }

    public static function todos()
    {
        $pdo = self::getConexao();
        $sql = "SELECT id_curso, nome_curso, nivel_curso, criado_em, actualizado_em FROM curso";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function buscarPorId($id_curso)
    {
        $pdo = self::getConexao();
        $stmt = $pdo->prepare("SELECT * FROM curso WHERE id_curso = :id_curso");
        $stmt->execute(['id_curso' => $id_curso]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return $stmt->fetch();
    }

    public function salvar()
    {
        if (empty($this->nome_curso)) {
            throw new \Exception('O nome do curso não pode ser vazio.');
        }

        $pdo = self::getConexao();
        if (isset($this->id_curso) && !empty($this->id_curso)) {
            $stmt = $pdo->prepare("UPDATE curso SET nome_curso = :nome_curso, nivel = :nivel WHERE id_curso = :id_curso");
            return $stmt->execute([
                'nome_curso' => $this->nome_curso,
                'nivel'      => $this->nivel,
                'id_curso'   => $this->id_curso
            ]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO curso (nome_curso, nivel) VALUES (:nome_curso, :nivel)");
            $result = $stmt->execute([
                'nome_curso' => $this->nome_curso,
                'nivel'      => $this->nivel
            ]);
            if ($result) {
                $this->id_curso = $pdo->lastInsertId();
            }
            return $result;
        }
    }

    public function deletar()
    {
        if (!isset($this->id_curso)) return false;
        $pdo = self::getConexao();
        $stmt = $pdo->prepare("DELETE FROM curso WHERE id_curso = :id_curso");
        return $stmt->execute(['id_curso' => $this->id_curso]);
    }
}