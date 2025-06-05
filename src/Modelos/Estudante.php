<?php
declare(strict_types=1);

namespace App\Modelos;

require_once __DIR__ . '/../config/conexao_basedados.php';

class Estudante
{
    public $id_usuario;
    public $data_nasc;
    public $telefone;
    public $area_formacao;
    public $curso_pretendido;
    public $nome_completo;
    public $nome_usuario;
    public $email;

    protected static function getConexao()
    {
        return \obterConexao();
    }

    public static function todos()
    {
        $pdo = self::getConexao();
        $sql = "SELECT 
                    e.id_usuario,
                    e.data_nasc,
                    e.telefone,
                    e.area_formacao,
                    e.curso_pretendido,
                    u.nome_completo,
                    u.nome_usuario,
                    u.email
                FROM estudante e
                JOIN usuario u ON e.id_usuario = u.id_usuario
                ORDER BY e.id_usuario";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function buscarPorId($id_usuario)
    {
        $pdo = self::getConexao();
        $sql = "SELECT e.*, u.nome_completo, u.nome_usuario, u.email 
                FROM estudante e
                JOIN usuario u ON e.id_usuario = u.id_usuario
                WHERE e.id_usuario = :id_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_usuario' => $id_usuario]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return $stmt->fetch();
    }

    public static function salvar($dados)
    {
        $pdo = self::getConexao();

        // 1. Inserir na tabela usuario
        $sqlUsuario = "INSERT INTO usuario (nome_usuario, nome_completo, email, senha, id_nivel_acesso)
                       VALUES (:nome_usuario, :nome_completo, :email, :senha, :id_nivel_acesso)";
        $stmtUsuario = $pdo->prepare($sqlUsuario);
        $stmtUsuario->bindValue(':nome_usuario', $dados['nome_usuario']);
        $stmtUsuario->bindValue(':nome_completo', $dados['nome_completo']);
        $stmtUsuario->bindValue(':email', $dados['email']);
        $stmtUsuario->bindValue(':senha', $dados['senha_estudante']);
        $stmtUsuario->bindValue(':id_nivel_acesso', 2); // 2 = estudante

        if (!$stmtUsuario->execute()) {
            return false;
        }

        $id_usuario = (int)$pdo->lastInsertId();

        // 2. Inserir na tabela estudante
        $sqlEstudante = "INSERT INTO estudante (id_usuario, data_nasc, telefone, area_formacao, curso_pretendido)
                         VALUES (:id_usuario, :data_nasc, :telefone, :area_formacao, :curso_pretendido)";
        $stmtEstudante = $pdo->prepare($sqlEstudante);
        $stmtEstudante->bindValue(':id_usuario', $id_usuario);
        $stmtEstudante->bindValue(':data_nasc', $dados['data_nasc']);
        $stmtEstudante->bindValue(':telefone', $dados['telefone']);
        $stmtEstudante->bindValue(':area_formacao', $dados['area_formacao']);
        $stmtEstudante->bindValue(':curso_pretendido', $dados['curso_pretendido']);

        return $stmtEstudante->execute();
    }

    public static function atualizar($id_usuario, $dados)
    {
        $pdo = self::getConexao();

        // Atualizar usuario
        $sqlUsuario = "UPDATE usuario SET nome_completo = :nome_completo, nome_usuario = :nome_usuario, email = :email WHERE id_usuario = :id_usuario";
        $stmtUsuario = $pdo->prepare($sqlUsuario);
        $stmtUsuario->bindValue(':nome_completo', $dados['nome_completo']);
        $stmtUsuario->bindValue(':nome_usuario', $dados['nome_usuario']);
        $stmtUsuario->bindValue(':email', $dados['email']);
        $stmtUsuario->bindValue(':id_usuario', $id_usuario);
        $stmtUsuario->execute();

        // Atualizar estudante
        $sqlEstudante = "UPDATE estudante SET data_nasc = :data_nasc, telefone = :telefone, area_formacao = :area_formacao, curso_pretendido = :curso_pretendido WHERE id_usuario = :id_usuario";
        $stmtEstudante = $pdo->prepare($sqlEstudante);
        $stmtEstudante->bindValue(':data_nasc', $dados['data_nasc']);
        $stmtEstudante->bindValue(':telefone', $dados['telefone']);
        $stmtEstudante->bindValue(':area_formacao', $dados['area_formacao']);
        $stmtEstudante->bindValue(':curso_pretendido', $dados['curso_pretendido']);
        $stmtEstudante->bindValue(':id_usuario', $id_usuario);
        return $stmtEstudante->execute();
    }

    public static function deletar($id_usuario)
    {
        $pdo = self::getConexao();
        $stmt = $pdo->prepare("DELETE FROM usuario WHERE id_usuario = :id_usuario");
        return $stmt->execute(['id_usuario' => $id_usuario]);
    }

    public static function login($email, $senha)
    {
        $pdo = self::getConexao();
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email AND id_nivel_acesso = 2 LIMIT 1");
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch();
        if (!$usuario) {
            error_log("Usuário não encontrado para email: $email");
            return false;
        }
        if (!password_verify($senha, $usuario['senha'])) {
            error_log("Senha inválida para email: $email");
            return false;
        }
        return $usuario;
    }
}