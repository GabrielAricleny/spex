<?php

namespace App\Modelos;

class ModeloExame
{
    private int $id;
    private string $nome;
    private string $descricao;
    private string $data;
    private int $idAluno;

    public function __construct(
        int $id = 0,
        string $nome = '',
        string $descricao = '',
        string $data = '',
        int $idAluno = 0
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->data = $data;
        $this->idAluno = $idAluno;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function getIdAluno(): int
    {
        return $this->idAluno;
    }

    // Setters
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function setData(string $data): void
    {
        $this->data = $data;
    }

    public function setIdAluno(int $idAluno): void
    {
        $this->idAluno = $idAluno;
    }

    public static function listarExames(\PDO $pdo): array
    {
        $stmt = $pdo->query("SELECT id, nome, descricao, data, id_aluno FROM exames");
        $exames = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $exames[] = new self(
                (int)$row['id'],
                $row['nome'],
                $row['descricao'],
                $row['data'],
                (int)$row['id_aluno']
            );
        }
        return $exames;
    }
}