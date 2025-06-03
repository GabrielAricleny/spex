<?php

namespace App\controladores\admin;

use App\servicos\ListaPerguntasExameSistemaServico;

class ControladorListaPerguntasExameSistema
{
    protected $servico;

    public function __construct()
    {
        $this->servico = new ListaPerguntasExameSistemaServico();
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
                    header('Location: ?rota=crud_lista_perguntas_exame_sistema');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/lista_perguntas_exame_sistema/criar.php';
                break;

            case 'editar':
                if (!$id) {
                    header('Location: ?rota=crud_lista_perguntas_exame_sistema');
                    exit;
                }
                $listaPerguntasExameSistema = $this->servico->buscarPorId($id);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dados = [
                        'nome' => $_POST['nome'] ?? '',
                    ];
                    $this->servico->atualizar($id, $dados);
                    header('Location: ?rota=crud_lista_perguntas_exame_sistema');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/lista_perguntas_exame_sistema/editar.php';
                break;

            case 'deletar':
                if ($id) {
                    $this->servico->deletar($id);
                }
                header('Location: ?rota=crud_lista_perguntas_exame_sistema');
                exit;

            default:
                $listaPerguntasExameSistema = $this->servico->listarTodos();
                include __DIR__ . '/../../visoes/admin/lista_perguntas_exame_sistema/listar.php';
                break;
        }
    }
}