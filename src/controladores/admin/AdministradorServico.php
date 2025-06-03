<?php

namespace App\servicos;

require_once __DIR__ . '/../../modelos/Administrador.php';

use App\Modelos\Administrador;

class AdministradorServico
{
    public function listarTodos()
    {
        // Retorna todos os administradores do banco de dados
        return Administrador::todos();
    }

    public function buscarPorId($id)
    {
        // Busca um administrador pelo ID
        return Administrador::buscarPorId($id);
    }

    public function criar($dados)
    {
        // Cria um novo administrador com os dados fornecidos
        $admin = new Administrador();
        $admin->nome = $dados['nome'] ?? '';
        $admin->email = $dados['email'] ?? '';
        $admin->senha = password_hash($dados['senha'] ?? '', PASSWORD_DEFAULT);
        return $admin->salvar();
    }

    public function atualizar($id, $dados)
    {
        // Atualiza os dados do administrador
        $admin = Administrador::buscarPorId($id);
        if (!$admin) {
            return false;
        }
        $admin->nome = $dados['nome'] ?? $admin->nome;
        $admin->email = $dados['email'] ?? $admin->email;
        if (!empty($dados['senha'])) {
            $admin->senha = password_hash($dados['senha'], PASSWORD_DEFAULT);
        }
        return $admin->salvar();
    }

    public function deletar($id)
    {
        // Deleta o administrador pelo ID
        $admin = Administrador::buscarPorId($id);
        if ($admin) {
            return $admin->deletar();
        }
        return false;
    }
}