<?php

namespace App\Servicos;

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
        // Cria um novo administrador para um usuário existente
        $admin = new Administrador();
        $admin->id_usuario = $dados['id_usuario'];
        $admin->telefone = $dados['telefone'] ?? null;
        return $admin->salvar();
    }

    public function atualizar($id, $dados)
    {
        $admin = Administrador::buscarPorId($id);
        if (!$admin) {
            return false;
        }
        $admin->telefone = $dados['telefone'] ?? $admin->telefone;
        return $admin->atualizar([
            'telefone' => $admin->telefone
        ]);
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