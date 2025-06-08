<?php

namespace App\controladores\admin;

use App\Servicos\EstudanteServico;

class ControladorEstudante
{
    private $servico;

    public function __construct()
    {
        $this->servico = new EstudanteServico();
    }

    public function crud()
    {
        $acao = $_GET['acao'] ?? 'listar';
        $id = $_GET['id'] ?? null;

        switch ($acao) {
            case 'criar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dados = [
                        'nome_completo'     => $_POST['nome_completo'] ?? '',
                        'data_nasc'         => $_POST['data_nasc'] ?? '',
                        'telefone'          => $_POST['telefone'] ?? '',
                        'email'             => $_POST['email'] ?? '',
                        'area_formacao'     => $_POST['area_formacao'] ?? '',
                        'curso_pretendido'  => $_POST['curso_pretendido'] ?? '',
                        'nome_usuario'      => $_POST['nome_usuario'] ?? '',
                        'senha_estudante'   => password_hash($_POST['senha_estudante'] ?? '', PASSWORD_DEFAULT),
                    ];
                    $this->servico->criar($dados);
                    header('Location: ?rota=crud_estudante');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/estudantes/criar.php';
                break;

            case 'editar':
                $estudante = $this->servico->buscarPorId($id);
                // Busque o usuário correspondente
                $usuario = \App\Modelos\Usuario::buscarPorId($estudante->id_usuario);
                $estudante->nome_completo = $usuario ? $usuario->nome_completo : '';
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dados = [
                        'nome_completo'     => $_POST['nome_completo'] ?? '',
                        'data_nasc'         => $_POST['data_nasc'] ?? '',
                        'telefone'          => $_POST['telefone'] ?? '',
                        'email'             => $_POST['email'] ?? '',
                        'area_formacao'     => $_POST['area_formacao'] ?? '',
                        'curso_pretendido'  => $_POST['curso_pretendido'] ?? '',
                        'nome_usuario'      => $_POST['nome_usuario'] ?? '',
                    ];
                    if (!empty($_POST['senha_estudante'])) {
                        $dados['senha_estudante'] = password_hash($_POST['senha_estudante'], PASSWORD_DEFAULT);
                    }
                    $this->servico->atualizar($id, $dados);
                    header('Location: ?rota=crud_estudante');
                    exit;
                }
                include __DIR__ . '/../../visoes/admin/estudantes/editar.php';
                break;

            case 'deletar':
                $this->servico->deletar($id);
                header('Location: ?rota=crud_estudante');
                exit;

            default:
                $estudantes = $this->servico->listarTodos();

                // Para cada estudante, busque o usuário correspondente
                foreach ($estudantes as &$estudante) {
                    $usuario = \App\Modelos\Usuario::buscarPorId($estudante->id_usuario);
                    $estudante->nome_completo = $usuario ? $usuario->nome_completo : '';
                }
                unset($estudante);

                include __DIR__ . '/../../visoes/admin/estudantes/listar.php';
                break;
        }
    }

    public function listarTodos()
    {
        return $this->servico->listarTodos();
    }

    public function buscarPorId($id)
    {
        return $this->servico->buscarPorId($id);
    }

    public function criar($dados)
    {
        return $this->servico->criar($dados);
    }

    public function atualizar($id, $dados)
    {
        return $this->servico->atualizar($id, $dados);
    }

    public function deletar($id)
    {
        return $this->servico->deletar($id);
    }
}