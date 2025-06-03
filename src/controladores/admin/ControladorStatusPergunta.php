<?php

namespace App\controladores\admin;

use App\servicos\StatusPerguntaServico;

class ControladorStatusPergunta
{
    protected $servico;

    public function __construct()
    {
        $this->servico = new StatusPerguntaServico();
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
                    header('Location: ?rota=crud_status_pergunta');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/status_pergunta/criar.php';
                break;

            case 'editar':
                if (!$id) {
                    header('Location: ?rota=crud_status_pergunta');
                    exit;
                }
                $statusPergunta = $this->servico->buscarPorId($id);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dados = [
                        'nome' => $_POST['nome'] ?? '',
                    ];
                    $this->servico->atualizar($id, $dados);
                    header('Location: ?rota=crud_status_pergunta');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/status_pergunta/editar.php';
                break;

            case 'deletar':
                if ($id) {
                    $this->servico->deletar($id);
                }
                header('Location: ?rota=crud_status_pergunta');
                exit;

            default:
                $statusPerguntas = $this->servico->listarTodos();
                include __DIR__ . '/../../visoes/admin/status_pergunta/listar.php';
                break;
        }
    }
}