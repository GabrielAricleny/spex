<?php

namespace App\controladores\admin;

use App\Servicos\UsuarioServico;

class ControladorUsuario
{
    protected $servico;

    public function __construct()
    {
        $this->servico = new UsuarioServico();
    }

    public function crud()
    {
        $acao = $_GET['acao'] ?? 'listar';
        $id = $_GET['id'] ?? null;

        switch ($acao) {
            case 'criar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dados = [
                        'nome_usuario'    => $_POST['nome_usuario'] ?? '',
                        'nome_completo'   => $_POST['nome_completo'] ?? '',
                        'email'           => $_POST['email'] ?? '',
                        'senha'           => $_POST['senha'] ?? '',
                        'id_nivel_acesso' => $_POST['id_nivel_acesso'] ?? ''
                    ];
                    $this->servico->criar($dados);
                    header('Location: ?rota=crud_usuario');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/usuarios/criar.php';
                break;

            case 'editar':
                if (!$id) {
                    header('Location: ?rota=crud_usuario');
                    exit;
                }
                $usuario = $this->servico->buscarPorId($id);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dados = [
                        'nome_usuario'    => $_POST['nome_usuario'] ?? $usuario->nome_usuario,
                        'nome_completo'   => $_POST['nome_completo'] ?? $usuario->nome_completo,
                        'email'           => $_POST['email'] ?? $usuario->email,
                        'senha'           => $_POST['senha'] ?? '', // só actualiza se não estiver vazio
                        'id_nivel_acesso' => $_POST['id_nivel_acesso'] ?? $usuario->id_nivel_acesso
                    ];
                    $this->servico->atualizar($id, $dados);
                    header('Location: ?rota=crud_usuario');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/usuarios/editar.php';
                break;

            case 'eliminar':
                if ($id) {
                    $this->servico->deletar($id);
                }
                header('Location: ?rota=crud_usuario');
                exit;

            case 'listar':
            default:
                $usuarios = $this->servico->listarTodos();
                include __DIR__ . '/../../visoes/admin/usuarios/listar.php';
                break;
        }
    }
}