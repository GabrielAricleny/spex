<?php

namespace App\controladores\admin;

use App\servicos\ListaPerguntasExameUniversidadeServico;

class ControladorListaPerguntasExameUniversidade
{
    protected $servico;

    public function __construct()
    {
        $this->servico = new ListaPerguntasExameUniversidadeServico();
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
                    header('Location: ?rota=crud_lista_perguntas_exame_universidade');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/lista_perguntas_exame_universidade/criar.php';
                break;

            case 'editar':
                if (!$id) {
                    header('Location: ?rota=crud_lista_perguntas_exame_universidade');
                    exit;
                }
                $listaPerguntasExameUniversidade = $this->servico->buscarPorId($id);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dados = [
                        'nome' => $_POST['nome'] ?? '',
                    ];
                    $this->servico->atualizar($id, $dados);
                    header('Location: ?rota=crud_lista_perguntas_exame_universidade');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/lista_perguntas_exame_universidade/editar.php';
                break;

            case 'deletar':
                if ($id) {
                    $this->servico->deletar($id);
                }
                header('Location: ?rota=crud_lista_perguntas_exame_universidade');
                exit;

            default:
                $listaPerguntasExameUniversidade = $this->servico->listarTodos();
                include __DIR__ . '/../../visoes/admin/lista_perguntas_exame_universidade/listar.php';
                break;
        }
    }
}