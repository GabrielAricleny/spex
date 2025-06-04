<?php

namespace App\Servicos;

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
        // Cria um novo administrador para um usuário existente
        $admin = new Administrador();
        $admin->id_usuario = $dados['id_usuario'];
        $admin->telefone = $dados['telefone'] ?? null;
        return $admin->salvar();
    }

    public function atualizar($id, $dados)
    {
        // Atualiza os dados do administrador
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
        // Deleta o administrador pelo ID
        $admin = Administrador::buscarPorId($id);
        if ($admin) {
            return $admin->deletar();
        }
        return false;
    }
}