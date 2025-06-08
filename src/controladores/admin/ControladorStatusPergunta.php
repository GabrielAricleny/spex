<?php

namespace App\controladores\admin;

use App\Modelos\ModeloStatusPergunta;

class ControladorStatusPergunta
{
    private ModeloStatusPergunta $modelo;

    public function __construct()
    {
        $conexao = require __DIR__ . '/../../config/conexao_basedados.php';
        $this->modelo = new ModeloStatusPergunta($conexao);
    }

    public function listar()
    {
        $statusPerguntas = $this->modelo->listar();
        require __DIR__ . '/../../visoes/admin/status_pergunta/listar.php';
    }

    public function criar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descricao = trim($_POST['descricao_status'] ?? '');
            if ($descricao) {
                $this->modelo->criar($descricao);
                header('Location: ?rota=status_pergunta_listar');
                exit;
            }
        }
        require __DIR__ . '/../../visoes/admin/status_pergunta/criar.php';
    }

    public function editar()
    {
        $id = (int)($_GET['id'] ?? 0);
        $status = $this->modelo->buscarPorId($id);
        if (!$status) {
            header('Location: ?rota=status_pergunta_listar');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descricao = trim($_POST['descricao_status'] ?? '');
            if ($descricao) {
                $this->modelo->atualizar($id, $descricao);
                header('Location: ?rota=status_pergunta_listar');
                exit;
            }
        }
        require __DIR__ . '/../../visoes/admin/status_pergunta/editar.php';
    }

    public function excluir()
    {
        $id = (int)($_GET['id'] ?? 0);
        $this->modelo->excluir($id);
        header('Location: ?rota=status_pergunta_listar');
        exit;
    }
}