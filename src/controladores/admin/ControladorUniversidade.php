<?php

namespace App\controladores\admin;

use App\Modelos\ModeloUniversidade;

class ControladorUniversidade
{
    private ModeloUniversidade $modelo;

    public function __construct()
    {
        $conexao = require __DIR__ . '/../../config/conexao_basedados.php';
        $this->modelo = new ModeloUniversidade($conexao);
    }

    public function listar(): void
    {
        $universidades = $this->modelo->listar();
        require __DIR__ . '/../../visoes/admin/universidades/listar.php';
    }

    public function criar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome_universidade'] ?? '');
            $abreviado = trim($_POST['nome_abreviado'] ?? '');
            if ($nome && $abreviado) {
                $this->modelo->criar($nome, $abreviado);
                header('Location: ?rota=universidades_listar');
                exit;
            }
        }
        require __DIR__ . '/../../visoes/admin/universidades/criar.php';
    }

    public function editar(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $universidade = $this->modelo->buscarPorId($id);
        if (!$universidade) {
            header('Location: ?rota=universidades_listar');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome_universidade'] ?? '');
            $abreviado = trim($_POST['nome_abreviado'] ?? '');
            if ($nome && $abreviado) {
                $this->modelo->atualizar($id, $nome, $abreviado);
                header('Location: ?rota=universidades_listar');
                exit;
            }
        }
        require __DIR__ . '/../../visoes/admin/universidades/editar.php';
    }

    public function excluir(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $this->modelo->excluir($id);
        header('Location: ?rota=universidades_listar');
        exit;
    }
}