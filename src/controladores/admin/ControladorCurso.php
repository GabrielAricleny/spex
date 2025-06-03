<?php
declare(strict_types=1);

namespace App\controladores\admin;

use App\servicos\CursoServico;

class ControladorCurso
{
    protected $servico;

    public function __construct()
    {
        $this->servico = new CursoServico();
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
                    header('Location: ?rota=crud_curso');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/curso/criar.php';
                break;

            case 'editar':
                $curso = $this->servico->buscarPorId($id);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dados = [
                        'nome' => $_POST['nome'] ?? '',
                    ];
                    $this->servico->atualizar($id, $dados);
                    header('Location: ?rota=crud_curso');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/curso/editar.php';
                break;

            case 'deletar':
                $this->servico->deletar($id);
                header('Location: ?rota=crud_curso');
                exit;

            default:
                $cursos = $this->servico->listarTodos();
                include __DIR__ . '/../../visoes/admin/curso/listar.php';
                break;
        }
    }
}