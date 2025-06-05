<?php
declare(strict_types=1);

namespace App\controladores\admin;

use App\Servicos\CursoServico;

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
                        'nome_curso' => $_POST['nome_curso'] ?? '',
                        'nivel'      => $_POST['nivel'] ?? ''
                    ];
                    $this->servico->criar($dados);
                    header('Location: ?rota=crud_curso');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/cursos/criar.php';
                break;

            case 'editar':
                $curso = $this->servico->buscarPorId($id);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dados = [
                        'nome_curso' => $_POST['nome_curso'] ?? '',
                        'nivel'      => $_POST['nivel'] ?? ''
                    ];
                    $this->servico->atualizar($id, $dados);
                    header('Location: ?rota=crud_curso');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/cursos/editar.php';
                break;

            case 'deletar':
                $this->servico->deletar($id);
                header('Location: ?rota=crud_curso');
                exit;

            default:
                $cursos = $this->servico->listarTodos();
                include __DIR__ . '/../../visoes/admin/cursos/listar.php';
                break;
        }
    }
}