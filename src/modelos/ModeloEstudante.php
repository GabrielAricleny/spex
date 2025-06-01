<?php
declare(strict_types=1);

namespace App\modelos;

use PDO;
use PDOException;

class ModeloEstudante
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Efetua login do estudante pelo email e senha.
     *
     * @param string $email
     * @param string $senha
     * @return array|null Dados do estudante ou null se falhar.
     */
    public function login(string $email, string $senha): ?array
    {
        $sql = 'SELECT * FROM estudante WHERE email = :email LIMIT 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $estudante = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($estudante !== false && password_verify($senha, $estudante['senha_estudante'])) {
            unset($estudante['senha_estudante']); // Remover a senha para segurança
            return $estudante;
        }

        return null;
    }

    /**
     * Cadastra um novo estudante.
     *
     * @param array $dados Dados do estudante.
     * @return bool Sucesso da operação.
     * @throws PDOException Em caso de erro na base de dados.
     */
    public function cadastrar(array $dados): bool
    {
        $sql = 'INSERT INTO estudante (
                    nome_estudante, nome_usuario, data_nasc, telefone,
                    email, area_formacao, curso_pretendido, senha_estudante
                ) VALUES (
                    :nome_estudante, :nome_usuario, :data_nasc, :telefone,
                    :email, :area_formacao, :curso_pretendido, :senha_estudante
                )';

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome_estudante', $dados['nome_estudante'], PDO::PARAM_STR);
        $stmt->bindValue(':nome_usuario', $dados['nome_usuario'], PDO::PARAM_STR);
        $stmt->bindValue(':data_nasc', $dados['data_nascimento'], PDO::PARAM_STR);
        $stmt->bindValue(':telefone', $dados['telefone'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $dados['email'], PDO::PARAM_STR);
        $stmt->bindValue(':area_formacao', $dados['area_formacao'], PDO::PARAM_STR);
        $stmt->bindValue(':curso_pretendido', $dados['curso_pretendido'], PDO::PARAM_STR);
        $stmt->bindValue(':senha_estudante', password_hash($dados['senha_estudante'], PASSWORD_BCRYPT), PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function obterDadosEstudante(int $id): ?array
    {
        $sql = "SELECT * FROM estudante WHERE id_estudante = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function obterHistoricoExames(int $idEstudante): array
    {
        $sql = "SELECT e.*, er.nota 
                FROM exame_realizado er
                JOIN exame e ON er.id_exame = e.id_exame
                WHERE er.id_estudante = :id
                ORDER BY er.data_realizacao DESC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $idEstudante, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
