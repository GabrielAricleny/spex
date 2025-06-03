<?php

namespace App\controladores\admin;

use App\servicos\AdministradorServico;

class ControladorAdministrador
{
    protected $servico;

    public function __construct()
    {
        $this->servico = new AdministradorServico();
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
                    header('Location: ?rota=crud_administrador');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/administradores/criar.php';
                break;

            case 'editar':
                if (!$id) {
                    header('Location: ?rota=crud_administrador');
                    exit;
                }
                $administrador = $this->servico->buscarPorId($id);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dados = [
                        'nome' => $_POST['nome'] ?? '',
                        'email' => $_POST['email'] ?? '',
                        'senha' => $_POST['senha'] ?? ''
                    ];
                    $this->servico->atualizar($id, $dados);
                    header('Location: ?rota=crud_administrador');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/administradores/editar.php';
                break;

            case 'deletar':
                if ($id) {
                    $this->servico->deletar($id);
                }
                header('Location: ?rota=crud_administrador');
                exit;

            default:
                $administradores = $this->servico->listarTodos();
                include __DIR__ . '/../../visoes/admin/administradores/listar.php';
                break;
        }
    }
}