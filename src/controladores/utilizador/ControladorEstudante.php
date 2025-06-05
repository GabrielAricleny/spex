<?php
namespace App\controladores\utilizador;

use App\Servicos\EstudanteServico;

class ControladorEstudante
{
    public function cadastro()
    {
        $erro = '';
        $sucesso = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'nome_completo'     => trim($_POST['nome_completo'] ?? ''),
                'data_nasc'         => trim($_POST['data_nasc'] ?? ''),
                'telefone'          => trim($_POST['telefone'] ?? ''),
                'email'             => trim($_POST['email'] ?? ''),
                'area_formacao'     => trim($_POST['area_formacao'] ?? ''),
                'curso_pretendido'  => trim($_POST['curso_pretendido'] ?? ''),
                'nome_usuario'      => trim($_POST['nome_usuario'] ?? ''),
                'senha_estudante'   => password_hash($_POST['senha_estudante'] ?? '', PASSWORD_DEFAULT),
            ];

            try {
                $servico = new EstudanteServico();
                $resultado = $servico->criar($dados);

                if ($resultado) {
                    $sucesso = true;
                    $_SESSION['sucesso_login'] = 'Conta criada com sucesso! Faça login.';
                    header('Location: ?rota=login_estudante');
                    exit;
                } else {
                    $erro = 'Erro ao criar conta. Verifique os dados e tente novamente.';
                }
            } catch (\Throwable $e) {
                $erro = 'Erro ao criar conta: ' . $e->getMessage();
            }
        }

        $pdo = require __DIR__ . '/../../config/conexao_basedados.php';
        $cursos_medio = $pdo->query("SELECT id_curso, nome_curso FROM curso WHERE nivel_curso = 'medio'")->fetchAll();
        $cursos_superior = $pdo->query("SELECT id_curso, nome_curso FROM curso WHERE nivel_curso = 'superior'")->fetchAll();
        $usuarios_estudantes = $pdo->query("SELECT * FROM usuario WHERE id_nivel_acesso = 2")->fetchAll();

        include __DIR__ . '/../../visoes/utilizador/cadastro_estudante.php';
    }

    public function dashboard()
    {
        if (!isset($_SESSION['estudante'])) {
            header('Location: ?rota=login_estudante');
            exit;
        }
        $estudante = $_SESSION['estudante'];
        include __DIR__ . '/../../visoes/utilizador/dashboard_estudante.php';
    }

    public function perfil()
    {
        if (!isset($_SESSION['estudante'])) {
            header('Location: ?rota=login_estudante');
            exit;
        }
        $estudante = $_SESSION['estudante'];
        include __DIR__ . '/../../visoes/utilizador/perfil_estudante.php';
    }

    public function meusResultados()
    {
        if (!isset($_SESSION['estudante'])) {
            header('Location: ?rota=login_estudante');
            exit;
        }
        $estudante = $_SESSION['estudante'];
        $servico = new EstudanteServico();
        $resultados = $servico->buscarResultados($estudante['id_usuario'] ?? null);
        include __DIR__ . '/../../visoes/utilizador/meus_resultados.php';
    }

    public function terminarSessao()
    {
        unset($_SESSION['estudante']);
        session_destroy();
        header('Location: ?rota=login_estudante');
        exit;
    }
}