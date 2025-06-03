<?php

namespace App\controladores\admin;

use App\servicos\UsuarioServico;

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
                        'nome' => $_POST['nome'] ?? '',
                        'email' => $_POST['email'] ?? '',
                        'senha' => $_POST['senha'] ?? ''
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
                        'nome' => $_POST['nome'] ?? '',
                        'email' => $_POST['email'] ?? '',
                        'senha' => $_POST['senha'] ?? ''
                    ];
                    $this->servico->atualizar($id, $dados);
                    header('Location: ?rota=crud_usuario');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/usuarios/editar.php';
                break;

            case 'deletar':
                if ($id) {
                    $this->servico->deletar($id);
                }
                header('Location: ?rota=crud_usuario');
                exit;

            default:
                $usuarios = $this->servico->listarTodos();
                include __DIR__ . '/../../visoes/admin/usuarios/listar.php';
                break;
        }
    }
}