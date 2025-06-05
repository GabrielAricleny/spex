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

        // Atualiza telefone na tabela administrador
        $admin->telefone = $dados['telefone'] ?? $admin->telefone;
        $resultadoAdmin = $admin->atualizar([
            'telefone' => $admin->telefone
        ]);

        // Atualiza nome_completo na tabela usuario, se enviado
        if (isset($dados['nome_completo'])) {
            // Supondo que existe um método para atualizar o usuário pelo id_usuario
            \App\Modelos\Usuario::atualizarNomeCompleto($admin->id_usuario, $dados['nome_completo']);
        }

        return $resultadoAdmin;
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