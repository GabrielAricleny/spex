<?php
declare(strict_types=1);

namespace App\modelos;

use PDO;
use PDOException;

class ModeloEstudante
{
    private PDO $pdo;

    public function __construct(PDO $conexao)
    {
        if (!$conexao instanceof PDO) {
            throw new PDOException("A variável \$conexao não é uma instância de PDO.");
        }
        $this->pdo = $conexao;
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
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE email = :email AND id_nivel_acesso = 2 LIMIT 1");
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
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
        // 1. Inserir na tabela usuario
        $sqlUsuario = 'INSERT INTO usuario (
            nome_usuario, nome_completo, email, senha, id_nivel_acesso
        ) VALUES (
            :nome_usuario, :nome_completo, :email, :senha, :id_nivel_acesso
        )';

        $stmtUsuario = $this->pdo->prepare($sqlUsuario);
        $stmtUsuario->bindValue(':nome_usuario', $dados['nome_usuario'], PDO::PARAM_STR);
        $stmtUsuario->bindValue(':nome_completo', $dados['nome_completo'], PDO::PARAM_STR);
        $stmtUsuario->bindValue(':email', $dados['email'], PDO::PARAM_STR);
        $stmtUsuario->bindValue(':senha', $dados['senha_estudante'], PDO::PARAM_STR);
        $stmtUsuario->bindValue(':id_nivel_acesso', 2, PDO::PARAM_INT); // 2 = estudante

        if (!$stmtUsuario->execute()) {
            return false;
        }

        $id_usuario = (int)$this->pdo->lastInsertId();

        // 2. Inserir na tabela estudante
        $sqlEstudante = 'INSERT INTO estudante (
            id_usuario, data_nasc, telefone, area_formacao, curso_pretendido
        ) VALUES (
            :id_usuario, :data_nasc, :telefone, :area_formacao, :curso_pretendido
        )';

        $stmtEstudante = $this->pdo->prepare($sqlEstudante);
        $stmtEstudante->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmtEstudante->bindValue(':data_nasc', $dados['data_nasc'], PDO::PARAM_STR);
        $stmtEstudante->bindValue(':telefone', $dados['telefone'], PDO::PARAM_STR);
        $stmtEstudante->bindValue(':area_formacao', $dados['area_formacao'], PDO::PARAM_INT);
        $stmtEstudante->bindValue(':curso_pretendido', $dados['curso_pretendido'], PDO::PARAM_INT);

        return $stmtEstudante->execute();
    }

    public function obterDadosEstudante(int $id): ?array
    {
        $sql = "SELECT u.*, e.data_nasc, e.telefone, e.area_formacao, e.curso_pretendido
                FROM usuario u
                INNER JOIN estudante e ON u.id_usuario = e.id_usuario
                WHERE u.id_usuario = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // Ajuste este método conforme sua estrutura de exames
    public function obterHistoricoExames(int $idUsuario): array
    {
        $sql = "SELECT ha.*, esr.nota_obtida, esr.data_realizacao
                FROM historico_aluno ha
                LEFT JOIN exame_sistema_realizado esr ON ha.id_exame_realizado = esr.id_exame_realizado
                WHERE ha.id_usuario = :id
                ORDER BY ha.data_realizacao DESC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
