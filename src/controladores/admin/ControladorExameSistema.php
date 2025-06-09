<?php

namespace App\controladores\admin;

require_once __DIR__ . '/../../Modelos/ModeloExameSistema.php';
require_once __DIR__ . '/../../Modelos/Curso.php';
require_once __DIR__ . '/../../Modelos/ModeloDisciplina.php';
require_once __DIR__ . '/../../Modelos/ModeloTema.php';

use App\Modelos\ModeloExameSistema;

class ControladorExameSistema
{
    private ModeloExameSistema $modelo;

    public function __construct()
    {
        $conexao = require __DIR__ . '/../../config/conexao_basedados.php';
        $this->modelo = new ModeloExameSistema($conexao);
    }

    public function crud()
    {
        // Renderiza a view correta para o CRUD de Exame do Sistema
        require_once __DIR__ . '/../../visoes/admin/exame_sistema/crud.php';
    }

    public function listar(): void
    {
        $exames = $this->modelo->listar();
        require __DIR__ . '/../../visoes/admin/exame_sistema/listar.php';
    }

    public function editar(): void
    {
        $id = $_GET['id'] ?? '';
        $exame = $this->modelo->buscarPorId($id);

        if (!$exame) {
            header('Location: ?rota=exame_sistema_listar');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $duracao = trim($_POST['duracao'] ?? '');
            if ($duracao) {
                $this->modelo->atualizar($id, $duracao);
                header('Location: ?rota=exame_sistema_listar');
                exit;
            }
        }
        require __DIR__ . '/../../visoes/admin/exame_sistema/editar.php';
    }

    public function excluir(): void
    {
        $id = $_GET['id'] ?? '';
        if ($id) {
            $this->modelo->excluir($id);
        }
        header('Location: ?rota=exame_sistema_listar');
        exit;
    }

    public function criar(): void
    {
        $conexao = require __DIR__ . '/../../config/conexao_basedados.php';
        $cursos = \App\Modelos\Curso::todos();
        $disciplinas = (new \App\Modelos\ModeloDisciplina($conexao))->listar();
        $temas = (new \App\Modelos\ModeloTema($conexao))->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $duracao = $_POST['duracao'] ?? '01:00:00';
            $idsCursos = $_POST['cursos'] ?? [];
            $idsDisciplinas = $_POST['disciplinas'] ?? [];
            $idsTemas = $_POST['temas'] ?? [];
            $qtdCursosAleatorios = (int)($_POST['qtd_cursos_aleatorios'] ?? 0);
            $qtdDisciplinasAleatorias = (int)($_POST['qtd_disciplinas_aleatorias'] ?? 0);
            $qtdTemasAleatorios = (int)($_POST['qtd_temas_aleatorios'] ?? 0);
            $qtdPerguntasAleatorias = (int)($_POST['qtd_perguntas_aleatorias'] ?? 0);

            // Seleção aleatória de cursos, se solicitado
            if (isset($_POST['cursos_aleatorio']) && $qtdCursosAleatorios > 0) {
                shuffle($cursos);
                $idsCursos = array_column(array_slice($cursos, 0, $qtdCursosAleatorios), 'id_curso');
            }

            // Seleção aleatória de disciplinas, se solicitado
            if (isset($_POST['disciplinas_aleatorio']) && $qtdDisciplinasAleatorias > 0) {
                shuffle($disciplinas);
                $idsDisciplinas = array_column(array_slice($disciplinas, 0, $qtdDisciplinasAleatorias), 'id_disciplina');
            }

            // Seleção aleatória de temas, se solicitado
            if (isset($_POST['temas_aleatorio']) && $qtdTemasAleatorios > 0) {
                shuffle($temas);
                $idsTemas = array_column(array_slice($temas, 0, $qtdTemasAleatorios), 'id_tema');
            }

            $this->modelo->criarExameSistemaPersonalizado(
                $duracao,
                $idsCursos,
                $idsDisciplinas,
                $idsTemas,
                $qtdDisciplinasAleatorias,
                $qtdTemasAleatorios,
                $qtdPerguntasAleatorias
            );
            header('Location: ?rota=exame_sistema_listar');
            exit;
        }

        require __DIR__ . '/../../visoes/admin/exame_sistema/criar.php';
    }

    // Mantém o método criarPersonalizado para compatibilidade, mas redireciona para criar()
    public function criarPersonalizado(): void
    {
        $this->criar();
    }
}