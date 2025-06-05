<?php
namespace App\Servicos;

use App\Modelos\Estudante;

class EstudanteServico
{
    public function listarTodos()
    {
        return Estudante::todos();
    }

    public function buscarPorId($id)
    {
        return Estudante::buscarPorId($id);
    }

    public function criar($dados)
    {
        return Estudante::salvar($dados);
    }

    public function atualizar($id, $dados)
    {
        return Estudante::atualizar($id, $dados);
    }

    public function deletar($id)
    {
        return Estudante::deletar($id);
    }
    
    public function buscarResultados($idUsuario)
    {
        $pdo = require __DIR__ . '/../config/conexao_basedados.php';
        $stmt = $pdo->prepare("SELECT * FROM resultados WHERE id_usuario = :id_usuario");
        $stmt->execute(['id_usuario' => $idUsuario]);
        return $stmt->fetchAll();
    }
    
    public function login($email, $senha)
    {
        return Estudante::login($email, $senha);
    }
}