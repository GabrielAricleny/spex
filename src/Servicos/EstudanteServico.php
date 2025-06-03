<?php
namespace App\Servicos;

class EstudanteServico
{
    public function criar($dados)
    {
        $pdo = $this->getConexao();

        $stmt = $pdo->prepare("
            INSERT INTO estudante 
                (nome_estudante, data_nasc, telefone, email, area_formacao, curso_pretendido, nome_usuario, senha_estudante)
            VALUES 
                (:nome_estudante, :data_nasc, :telefone, :email, :area_formacao, :curso_pretendido, :nome_usuario, :senha_estudante)
        ");

        return $stmt->execute([
            'nome_estudante'   => $dados['nome_estudante'],
            'data_nasc'        => $dados['data_nasc'],
            'telefone'         => $dados['telefone'],
            'email'            => $dados['email'],
            'area_formacao'    => $dados['area_formacao'],
            'curso_pretendido' => $dados['curso_pretendido'],
            'nome_usuario'     => $dados['nome_usuario'],
            'senha_estudante'  => $dados['senha_estudante'],
        ]);
    }

    private function getConexao()
    {
        $host = 'localhost';
        $db   = 'db_spex';
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
}