<?php

namespace App\controladores\admin;

require_once __DIR__ . '/../../Modelos/ModeloDisciplinaCurso.php';
require_once __DIR__ . '/../../Modelos/Curso.php';
require_once __DIR__ . '/../../Modelos/ModeloDisciplina.php';

use App\Modelos\ModeloDisciplinaCurso;
use App\Modelos\Curso;
use App\Modelos\ModeloDisciplina;

class ControladorDisciplinaCurso
{
    private ModeloDisciplinaCurso $modelo;
    private ModeloDisciplina $modeloDisciplina;

    public function __construct()
    {
        $conexao = require __DIR__ . '/../../config/conexao_basedados.php';
        $this->modelo = new ModeloDisciplinaCurso($conexao);
        $this->modeloDisciplina = new ModeloDisciplina($conexao);
    }

    // GET /disciplina_curso_listar
    public function listar(): void
    {
        $disciplinasCursos = $this->modelo->listar();
        require __DIR__ . '/../../visoes/admin/disciplina_curso/listar.php';
    }

    // GET|POST /disciplina_curso_criar
    public function criar(): void
    {
        // Filtra apenas cursos superiores
        $todosCursos = Curso::todos();
        $cursos = array_filter($todosCursos, fn($curso) => isset($curso['nivel_curso']) && $curso['nivel_curso'] === 'superior');
        $disciplinas = $this->modeloDisciplina->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_curso = $_POST['id_curso'] ?? '';
            $id_disciplina = $_POST['id_disciplina'] ?? '';
            if ($id_curso && $id_disciplina) {
                $this->modelo->criar($id_disciplina, $id_curso);
                header('Location: ?rota=disciplina_curso_listar');
                exit;
            }
        }
        require __DIR__ . '/../../visoes/admin/disciplina_curso/criar.php';
    }

    // GET|POST /disciplina_curso_editar&id_disciplina=...&id_curso=...
    public function editar(): void
    {
        $id_disciplina = $_GET['id_disciplina'] ?? '';
        $id_curso = $_GET['id_curso'] ?? '';
        $relacao = $this->modelo->buscar($id_disciplina, $id_curso);

        // Filtra apenas cursos superiores
        $todosCursos = Curso::todos();
        $cursos = array_filter($todosCursos, fn($curso) => isset($curso['nivel_curso']) && $curso['nivel_curso'] === 'superior');
        $disciplinas = $this->modeloDisciplina->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $novo_id_curso = $_POST['id_curso'] ?? '';
            $novo_id_disciplina = $_POST['id_disciplina'] ?? '';
            if ($novo_id_curso && $novo_id_disciplina) {
                $this->modelo->atualizar($id_disciplina, $id_curso, $novo_id_disciplina, $novo_id_curso);
                header('Location: ?rota=disciplina_curso_listar');
                exit;
            }
        }
        require __DIR__ . '/../../visoes/admin/disciplina_curso/editar.php';
    }

    // POST|GET /disciplina_curso_excluir&id_disciplina=...&id_curso=...
    public function excluir(): void
    {
        $id_disciplina = $_GET['id_disciplina'] ?? ($_POST['id_disciplina'] ?? '');
        $id_curso = $_GET['id_curso'] ?? ($_POST['id_curso'] ?? '');
        if ($id_disciplina && $id_curso) {
            $this->modelo->excluir($id_disciplina, $id_curso);
        }
        header('Location: ?rota=disciplina_curso_listar');
        exit;
    }
}