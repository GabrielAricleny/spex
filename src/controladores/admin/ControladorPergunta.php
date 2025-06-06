<?php

namespace App\controladores\admin;

use App\servicos\PerguntaCadastradaServico;

class ControladorPerguntaCadastrada
{
    protected $servico;

    public function __construct()
    {
        $this->servico = new PerguntaCadastradaServico();
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
                    header('Location: ?rota=crud_pergunta_cadastrada');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/pergunta_cadastrada/criar.php';
                break;

            case 'editar':
                if (!$id) {
                    header('Location: ?rota=crud_pergunta_cadastrada');
                    exit;
                }
                $perguntaCadastrada = $this->servico->buscarPorId($id);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dados = [
                        'nome' => $_POST['nome'] ?? '',
                    ];
                    $this->servico->atualizar($id, $dados);
                    header('Location: ?rota=crud_pergunta_cadastrada');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/pergunta_cadastrada/editar.php';
                break;

            case 'deletar':
                if ($id) {
                    $this->servico->deletar($id);
                }
                header('Location: ?rota=crud_pergunta_cadastrada');
                exit;

            default:
                $perguntasCadastradas = $this->servico->listarTodos();
                include __DIR__ . '/../../visoes/admin/pergunta_cadastrada/listar.php';
                break;
        }
    }
}