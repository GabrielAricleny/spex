<?php
declare(strict_types=1);

namespace App\controladores\admin;

use App\Modelos\ModeloTema;

class ControladorTema
{
    private ModeloTema $modelo;

    public function __construct()
    {
        $conexao = require __DIR__ . '/../../config/conexao_basedados.php';
        $this->modelo = new ModeloTema($conexao);
    }

    public function listar()
    {
        $temas = $this->modelo->listar();
        require __DIR__ . '/../../visoes/admin/tema/listar.php';
    }

    public function criar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome_tema'] ?? '');
            if ($nome) {
                $this->modelo->criar($nome);
                header('Location: ?rota=tema_listar');
                exit;
            }
        }
        require __DIR__ . '/../../visoes/admin/tema/criar.php';
    }

    public function editar()
    {
        $id = (int)($_GET['id'] ?? 0);
        $tema = $this->modelo->buscarPorId($id);
        if (!$tema) {
            header('Location: ?rota=tema_listar');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome_tema'] ?? '');
            if ($nome) {
                $this->modelo->atualizar($id, $nome);
                header('Location: ?rota=tema_listar');
                exit;
            }
        }
        require __DIR__ . '/../../visoes/admin/tema/editar.php';
    }

    public function excluir()
    {
        $id = (int)($_GET['id'] ?? 0);
        $this->modelo->excluir($id);
        header('Location: ?rota=tema_listar');
        exit;
    }
}