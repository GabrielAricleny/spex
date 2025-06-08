<?php

namespace App\controladores\admin;

use App\Modelos\ModeloDisciplina;

class ControladorDisciplina
{
    private ModeloDisciplina $modelo;

    public function __construct()
    {
        $conexao = require __DIR__ . '/../../config/conexao_basedados.php';
        $this->modelo = new ModeloDisciplina($conexao);
    }

    public function listar(): void
    {
        $disciplinas = $this->modelo->listar();
        require __DIR__ . '/../../visoes/admin/disciplinas/listar.php';
    }

    public function criar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome_disciplina'] ?? '');
            if ($nome) {
                $this->modelo->criar($nome);
                header('Location: ?rota=disciplinas_listar');
                exit;
            }
        }
        require __DIR__ . '/../../visoes/admin/disciplinas/criar.php';
    }

    public function editar(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $disciplina = $this->modelo->buscarPorId($id);
        if (!$disciplina) {
            header('Location: ?rota=disciplinas_listar');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome_disciplina'] ?? '');
            if ($nome) {
                $this->modelo->atualizar($id, $nome);
                header('Location: ?rota=disciplinas_listar');
                exit;
            }
        }
        require __DIR__ . '/../../visoes/admin/disciplinas/editar.php';
    }

    public function excluir(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $this->modelo->excluir($id);
        header('Location: ?rota=disciplinas_listar');
        exit;
    }
}