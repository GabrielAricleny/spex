<?php

namespace App\servicos;

use App\Modelos\Administrador;

class AdministradorServico
{
    public function listarTodos()
    {
        return Administrador::todos();
    }

    public function buscarPorId($id)
    {
        return Administrador::buscarPorId($id);
    }

    public function criar($dados)
    {
        $admin = new Administrador();
        $admin->nome = $dados['nome'] ?? '';
        $admin->email = $dados['email'] ?? '';
        $admin->senha = password_hash($dados['senha'] ?? '', PASSWORD_DEFAULT);
        return $admin->salvar();
    }

    public function atualizar($id, $dados)
    {
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
        $admin = Administrador::buscarPorId($id);
        if ($admin) {
            return $admin->deletar();
        }
        return false;
    }
}