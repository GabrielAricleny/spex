<?php
require_once __DIR__ . '/../config/database.php';

class Estudante
{
    public static function login($email, $senha)
    {
        global $pdo;
        $sql = 'SELECT * FROM estudante WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $estudante = $stmt->fetch();

        if ($estudante) {
            if ($estudante && password_verify($senha, $estudante['senha_estudante'])) {
                return $estudante;
            }
        }

        return false;
    }

    public static function cadastrar($nome_estudante, $nome_usuario, $data_nascimento, $telefone, $email,
                                     $area_formacao, $curso_pretendido, $senha_estudante)
    {
        global $pdo;
        $sql = 'INSERT INTO estudante
                (nome_estudante, nome_usuario, data_nasc, telefone, email, 
                area_formacao, curso_pretendido, senha_estudante)
                VALUES
                (:nome_estudante, :nome_usuario, :data_nascimento, :telefone, :email, :area_formacao, :curso_pretendido, :senha_estudante);
                ';
        $senha_hash = password_hash($senha_estudante, PASSWORD_BCRYPT);
                
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nome_estudante', $nome_estudante);
        $stmt->bindValue(':nome_usuario', $nome_usuario);
        $stmt->bindValue(':data_nascimento', $data_nascimento);
        $stmt->bindValue(':telefone', $telefone);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':area_formacao', $area_formacao);
        $stmt->bindValue(':curso_pretendido', $curso_pretendido);
        $stmt->bindValue(':senha_estudante', $senha_hash);
        $stmt->execute();
        $mensagem = $stmt->fetch();

        if ($mensagem) {
            return $mensagem;
        }
    }
}