<?php

namespace App\controladores\admin;

use App\Modelos\ModeloPergunta;
use App\Modelos\Curso;
use App\Modelos\ModeloDisciplina;
use App\Modelos\ModeloTema;
use App\Modelos\ModeloStatusPergunta;

class ControladorPergunta
{
    private ModeloPergunta $modelo;

    public function __construct()
    {
        $conexao = require __DIR__ . '/../../config/conexao_basedados.php';
        $this->modelo = new ModeloPergunta($conexao);
    }

    public function listar()
    {
        $perguntas = $this->modelo->listar();
        require __DIR__ . '/../../visoes/admin/pergunta/listar.php';
    }

    public function criar()
    {
        $conexao = require __DIR__ . '/../../config/conexao_basedados.php';
        $cursos = Curso::todos();
        $disciplinas = (new ModeloDisciplina($conexao))->listar();
        $temas = (new ModeloTema($conexao))->listar();
        $status = (new ModeloStatusPergunta($conexao))->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'enunciado' => trim($_POST['enunciado'] ?? ''),
                'curso' => (int)($_POST['curso'] ?? 0),
                'resposta' => trim($_POST['resposta'] ?? ''),
                'disciplina' => (int)($_POST['disciplina'] ?? 0),
                'tema' => (int)($_POST['tema'] ?? 0),
                'status' => (int)($_POST['status'] ?? 0)
            ];
            if ($dados['enunciado'] && $dados['curso'] && $dados['resposta'] && $dados['disciplina'] && $dados['tema'] && $dados['status']) {
                $this->modelo->criar($dados);
                header('Location: ?rota=pergunta_listar');
                exit;
            }
        }
        require __DIR__ . '/../../visoes/admin/pergunta/criar.php';
    }

    public function editar()
    {
        $id = (int)($_GET['id'] ?? 0);
        $pergunta = $this->modelo->buscarPorId($id);
        $conexao = require __DIR__ . '/../../config/conexao_basedados.php';
        $cursos = Curso::todos();
        $disciplinas = (new ModeloDisciplina($conexao))->listar();
        $temas = (new ModeloTema($conexao))->listar();
        $status = (new ModeloStatusPergunta($conexao))->listar();

        if (!$pergunta) {
            header('Location: ?rota=pergunta_listar');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'enunciado' => trim($_POST['enunciado'] ?? ''),
                'curso' => (int)($_POST['curso'] ?? 0),
                'resposta' => trim($_POST['resposta'] ?? ''),
                'disciplina' => (int)($_POST['disciplina'] ?? 0),
                'tema' => (int)($_POST['tema'] ?? 0),
                'status' => (int)($_POST['status'] ?? 0)
            ];
            if ($dados['enunciado'] && $dados['curso'] && $dados['resposta'] && $dados['disciplina'] && $dados['tema'] && $dados['status']) {
                $this->modelo->atualizar($id, $dados);
                header('Location: ?rota=pergunta_listar');
                exit;
            }
        }
        require __DIR__ . '/../../visoes/admin/pergunta/editar.php';
    }

    public function excluir()
    {
        $id = (int)($_GET['id'] ?? 0);
        $this->modelo->excluir($id);
        header('Location: ?rota=pergunta_listar');
        exit;
    }
}