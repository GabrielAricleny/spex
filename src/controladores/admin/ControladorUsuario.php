<?php

namespace App\controladores\admin;

use App\Servicos\UsuarioServico;
use App\Modelos\Curso;
use App\Modelos\Usuario;
use App\Modelos\Estudante;

class ControladorUsuario
{
    protected $servico;

    public function __construct()
    {
        $this->servico = new UsuarioServico();
    }

    public function crud()
    {
        $acao = $_GET['acao'] ?? 'listar';
        $id = $_GET['id'] ?? null;

        switch ($acao) {
            case 'criar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dados = [
                        'nome_usuario'    => $_POST['nome_usuario'] ?? '',
                        'nome_completo'   => $_POST['nome_completo'] ?? '',
                        'email'           => $_POST['email'] ?? '',
                        'senha'           => $_POST['senha'] ?? '',
                        'id_nivel_acesso' => $_POST['id_nivel_acesso'] ?? ''
                    ];

                    // Adiciona campos extras se for estudante
                    if ($_POST['id_nivel_acesso'] == 2) {
                        $dados['data_nasc'] = $_POST['data_nasc'] ?? null;
                        $dados['telefone'] = $_POST['telefone'] ?? null;
                        $dados['area_formacao'] = $_POST['area_formacao'] ?? null;
                        $dados['curso_pretendido'] = $_POST['curso_pretendido'] ?? null;
                    }

                    try {
                        $this->servico->criar($dados);
                        header('Location: ?rota=crud_usuario');
                        exit;
                    } catch (\Exception $e) {
                        $erro = $e->getMessage();
                        // inclui o formulário novamente, exibindo $erro
                    }
                }
                $cursos = Curso::todos();
                $cursosMedio = [];
                $cursosSuperior = [];
                foreach ($cursos as $curso) {
                    if ($curso['nivel_curso'] === 'medio') {
                        $cursosMedio[] = $curso;
                    } elseif ($curso['nivel_curso'] === 'superior') {
                        $cursosSuperior[] = $curso;
                    }
                }
                include __DIR__ . '/../../visoes/admin/usuarios/criar.php';
                break;

            case 'editar':
                if (!$id) {
                    header('Location: ?rota=crud_usuario');
                    exit;
                }
                $usuario = $this->servico->buscarPorId($id);

                if ($usuario && $usuario->id_nivel_acesso == 2) {
                    $pdo = \obterConexao();
                    $modeloEstudante = new \App\Modelos\ModeloEstudante($pdo);
                    $dadosEstudante = $modeloEstudante->buscarPorUsuarioId($usuario->id_usuario);

                    $usuario->data_nasc = $dadosEstudante['data_nasc'] ?? '';
                    $usuario->telefone = $dadosEstudante['telefone'] ?? '';
                    $usuario->area_formacao = $dadosEstudante['area_formacao'] ?? '';
                    $usuario->curso_pretendido = $dadosEstudante['curso_pretendido'] ?? '';
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $dados = [
                        'nome_usuario'    => $_POST['nome_usuario'] ?? $usuario->nome_usuario,
                        'nome_completo'   => $_POST['nome_completo'] ?? $usuario->nome_completo,
                        'email'           => $_POST['email'] ?? $usuario->email,
                        'senha'           => $_POST['senha'] ?? '', // só atualiza se não estiver vazio
                        'id_nivel_acesso' => $_POST['id_nivel_acesso'] ?? $usuario->id_nivel_acesso
                    ];
                    // Adicione os campos extras sempre que for estudante
                    if (($_POST['id_nivel_acesso'] ?? $usuario->id_nivel_acesso) == 2) {
                        $dados['data_nasc'] = $_POST['data_nasc'] ?? null;
                        $dados['telefone'] = $_POST['telefone'] ?? null;
                        $dados['area_formacao'] = $_POST['area_formacao'] ?? null;
                        $dados['curso_pretendido'] = $_POST['curso_pretendido'] ?? null;
                    }
                    $this->servico->atualizar($id, $dados);
                    header('Location: ?rota=crud_usuario');
                    exit;
                }
                // Busque todos os cursos
                $cursos = Curso::todos();
                $cursosMedio = [];
                $cursosSuperior = [];
                foreach ($cursos as $curso) {
                    if ($curso['nivel_curso'] === 'medio') {
                        $cursosMedio[] = $curso;
                    } elseif ($curso['nivel_curso'] === 'superior') {
                        $cursosSuperior[] = $curso;
                    }
                }

                include __DIR__ . '/../../visoes/admin/usuarios/editar.php';
                break;

            case 'eliminar':
                if ($id) {
                    $this->servico->deletar($id);
                }
                header('Location: ?rota=crud_usuario');
                exit;

            case 'listar':
            default:
                $usuarios = $this->servico->listarTodos();
                include __DIR__ . '/../../visoes/admin/usuarios/listar.php';
                break;
        }
    }
}
?>