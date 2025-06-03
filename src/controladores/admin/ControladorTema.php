<?php
declare(strict_types=1);

namespace App\controladores\admin;

use App\servicos\TemaServico;

class ControladorTema
{
    protected $servico;

    public function __construct()
    {
        $this->servico = new TemaServico();
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
                    ];
                    $this->servico->criar($dados);
                    header('Location: ?rota=crud_tema');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/tema/criar.php';
                break;

            case 'editar':
                $tema = $this->servico->buscarPorId($id);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dados = [
                        'nome' => $_POST['nome'] ?? '',
                    ];
                    $this->servico->atualizar($id, $dados);
                    header('Location: ?rota=crud_tema');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/tema/editar.php';
                break;

            case 'deletar':
                $this->servico->deletar($id);
                header('Location: ?rota=crud_tema');
                exit;

            default:
                $temas = $this->servico->listarTodos();
                include __DIR__ . '/../../visoes/admin/tema/listar.php';
                break;
        }
    }
}