<?php

namespace App\controladores\admin;

use App\Servicos\AdministradorServico;
use App\Modelos\Usuario;

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
                $usuarios = Usuario::todos();
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dados = [
                        'id_usuario' => $_POST['id_usuario'] ?? '',
                        'telefone'   => $_POST['telefone' ] ?? ''
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
                $admin = $this->servico->buscarPorId($id);
                if (!$admin) {
                    header('Location: ?rota=crud_administrador');
                    exit;
                }
                // Não permita trocar o usuário do administrador já existente
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dados = [
                        'telefone'      => $_POST['telefone'] ?? $admin->telefone,
                        'nome_completo' => $_POST['nome_completo'] ?? $admin->nome_completo
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