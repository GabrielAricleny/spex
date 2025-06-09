<?php

namespace App\controladores\admin;

require_once __DIR__ . '/../../Modelos/ModeloListaPerguntasExameSistema.php';
require_once __DIR__ . '/../../Modelos/ModeloPergunta.php';
require_once __DIR__ . '/../../Modelos/ModeloExameSistema.php';
require_once __DIR__ . '/../../Modelos/Curso.php';
require_once __DIR__ . '/../../Modelos/ModeloDisciplina.php';
require_once __DIR__ . '/../../Modelos/ModeloTema.php';
require_once __DIR__ . '/../../Modelos/ModeloStatusPergunta.php';

use App\Modelos\ModeloListaPerguntasExameSistema;

class ControladorListaPerguntasExameSistema
{
    private ModeloListaPerguntasExameSistema $modelo;

    public function __construct()
    {
        $conexao = require __DIR__ . '/../../config/conexao_basedados.php';
        $this->modelo = new ModeloListaPerguntasExameSistema($conexao);
    }

    public function listar(): void
    {
        $listas = $this->modelo->listar();
        require __DIR__ . '/../../visoes/admin/lista_perguntas_exame_sistema/listar.php';
    }

    public function criar(): void
    {
        $conexao = require __DIR__ . '/../../config/conexao_basedados.php';
        $exames = (new \App\Modelos\ModeloExameSistema($conexao))->listar();
        $perguntas = (new \App\Modelos\ModeloPergunta($conexao))->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_exame_sistema = $_POST['id_exame_sistema'] ?? '';
            $id_pergunta = $_POST['id_pergunta'] ?? '';
            if ($id_exame_sistema && $id_pergunta) {
                $this->modelo->criar($id_exame_sistema, $id_pergunta);
                header('Location: ?rota=lista_perguntas_exame_sistema_listar');
                exit;
            }
        }
        require __DIR__ . '/../../visoes/admin/lista_perguntas_exame_sistema/criar.php';
    }

    public function criar_aleatorio(): void
    {
        $conexao = require __DIR__ . '/../../config/conexao_basedados.php';
        $exames = (new \App\Modelos\ModeloExameSistema($conexao))->listar();
        $cursos = \App\Modelos\Curso::todos();
        $disciplinas = (new \App\Modelos\ModeloDisciplina($conexao))->listar();
        $temas = (new \App\Modelos\ModeloTema($conexao))->listar();
        $status = (new \App\Modelos\ModeloStatusPergunta($conexao))->listar();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_exame_sistema = $_POST['id_exame_sistema'] ?? '';
            $qtd_perguntas = (int)($_POST['qtd_perguntas'] ?? 0);

            $where = [];
            $params = [];

            // Filtro por curso: filtra perguntas pelo campo 'curso' (que é id_curso na tabela pergunta)
            if (!empty($_POST['curso'])) {
                $where[] = 'curso = ?';
                $params[] = $_POST['curso'];
            }
            // Filtro por disciplina
            if (!empty($_POST['disciplina'])) {
                $where[] = 'disciplina = ?';
                $params[] = $_POST['disciplina'];
            }
            // Filtro por tema
            if (!empty($_POST['tema'])) {
                $where[] = 'tema = ?';
                $params[] = $_POST['tema'];
            }
            // Filtro por status
            if (isset($_POST['status']) && $_POST['status'] !== '') {
                $where[] = 'status = ?';
                $params[] = $_POST['status'];
            }

            // Não incluir perguntas já associadas ao exame
            $where[] = 'id_pergunta NOT IN (SELECT id_pergunta FROM lista_perguntas_exame_sistema WHERE id_exame_sistema = ?)';
            $params[] = $id_exame_sistema;

            $whereSql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

            $sql = "SELECT id_pergunta FROM pergunta $whereSql ORDER BY RAND() LIMIT ?";
            $params[] = $qtd_perguntas;

            $stmt = $conexao->prepare($sql);
            $stmt->execute($params);
            $idsPerguntas = $stmt->fetchAll(\PDO::FETCH_COLUMN);

            foreach ($idsPerguntas as $id_pergunta) {
                $this->modelo->criar($id_exame_sistema, $id_pergunta);
            }
            header('Location: ?rota=lista_perguntas_exame_sistema_listar');
            exit;
        }

        require __DIR__ . '/../../visoes/admin/lista_perguntas_exame_sistema/criar_aleatorio.php';
    }

    public function editar(): void
    {
        $conexao = require __DIR__ . '/../../config/conexao_basedados.php';
        $exames = (new \App\Modelos\ModeloExameSistema($conexao))->listar();
        $perguntas = (new \App\Modelos\ModeloPergunta($conexao))->listar();

        $id_exame_sistema = $_GET['id_exame'] ?? '';
        $id_pergunta = $_GET['id_pergunta'] ?? '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_pergunta_nova = $_POST['id_pergunta'] ?? '';
            if ($id_exame_sistema && $id_pergunta && $id_pergunta_nova) {
                $this->modelo->editar($id_exame_sistema, $id_pergunta, $id_pergunta_nova);
                header('Location: ?rota=lista_perguntas_exame_sistema_listar');
                exit;
            }
        }

        require __DIR__ . '/../../visoes/admin/lista_perguntas_exame_sistema/editar.php';
    }

    public function excluir(): void
    {
        $id_exame_sistema = $_GET['id_exame'] ?? '';
        $id_pergunta = $_GET['id_pergunta'] ?? '';
        if ($id_exame_sistema && $id_pergunta) {
            $this->modelo->excluir($id_exame_sistema, $id_pergunta);
        }
        header('Location: ?rota=lista_perguntas_exame_sistema_listar');
        exit;
    }
}