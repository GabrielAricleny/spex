<?php
namespace App\Servicos;

use App\Modelos\Usuario;

class UsuarioServico
{
    public function listarTodos()
    {
        return Usuario::todos();
    }

    public function criar($dados)
    {
        if (empty($dados['id_nivel_acesso'])) {
            throw new \Exception('O campo Nível de Acesso é obrigatório.');
        }
        $usuario = new Usuario();
        $usuario->nome_usuario = $dados['nome_usuario'] ?? '';
        $usuario->nome_completo = $dados['nome_completo'] ?? '';
        $usuario->email = $dados['email'] ?? '';
        $usuario->senha = password_hash($dados['senha'] ?? '', PASSWORD_DEFAULT);
        $usuario->id_nivel_acesso = $dados['id_nivel_acesso'];
        return $usuario->salvar();
    }

    public function buscarPorId($id)
    {
        // Busca um usuário pelo ID
        return Usuario::buscarPorId($id);
    }

    public function atualizar($id, $dados)
    {
        // Atualiza os dados do usuário
        $usuario = Usuario::buscarPorId($id);
        if (!$usuario) {
            return false;
        }
        $usuario->nome_usuario = $dados['nome_usuario'] ?? $usuario->nome_usuario;
        $usuario->email = $dados['email'] ?? $usuario->email;
        if (!empty($dados['senha'])) {
            $usuario->senha = password_hash($dados['senha'], PASSWORD_DEFAULT);
        }
        $usuario->nome_completo = $dados['nome_completo'] ?? $usuario->nome_completo;
        $usuario->id_nivel_acesso = $dados['id_nivel_acesso'] ?? $usuario->id_nivel_acesso;
        return $usuario->salvar();
    }

    public function deletar($id)
    {
        // Deleta o usuário pelo ID
        $usuario = Usuario::buscarPorId($id);
        if ($usuario) {
            return Usuario::deletar($id);
        }
        return false;
    }
}