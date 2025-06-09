<?php
namespace App\controladores\utilizador;

require_once __DIR__ . '/../../Modelos/ModeloEstudante.php';
require_once __DIR__ . '/../../Modelos/Curso.php';

use App\Modelos\ModeloEstudante;
use PDO;

class ControladorPerfilEstudante
{
    public function editar()
    {
        // Verifica se o usuário está logado
        if (empty($_SESSION['utilizador']) || empty($_SESSION['utilizador']['id_usuario'])) {
            header('Location: ?rota=login_estudante');
            exit;
        }

        // Conexão com o banco de dados
        $conexao = require __DIR__ . '/../../config/conexao_basedados.php';
        $modelo = new ModeloEstudante($conexao);

        // ID do usuário logado
        $id_usuario = (int)$_SESSION['utilizador']['id_usuario'];

        // Cursos para o select
        $cursos = \App\Modelos\Curso::todos();

        // Processamento do formulário
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Dados do formulário
            $dadosAtualizados = [
                'nome_completo'    => $_POST['nome_completo'] ?? '',
                'email'            => $_POST['email'] ?? '',
                'data_nasc'        => $_POST['data_nasc'] ?? '',
                'telefone'         => $_POST['telefone'] ?? '',
                'area_formacao'    => $_POST['area_formacao'] ?? '',
                'curso_pretendido' => $_POST['curso_pretendido'] ?? '',
            ];

            // Log antes do update
            error_log('ANTES UPDATE: ' . session_id() . ' | ' . print_r($_SESSION, true));

            // Atualiza o perfil no banco de dados
            $resultado = $modelo->atualizarPerfil($id_usuario, $dadosAtualizados);

            // Se houver erro no update
            if (!$resultado) {
                error_log('Erro ao atualizar perfil no banco de dados.');
                die('Erro ao atualizar perfil.');
            }

            // Atualiza os dados na sessão
            $_SESSION['utilizador']['nome_completo']    = $dadosAtualizados['nome_completo'];
            $_SESSION['utilizador']['email']            = $dadosAtualizados['email'];
            $_SESSION['utilizador']['data_nasc']        = $dadosAtualizados['data_nasc'];
            $_SESSION['utilizador']['telefone']         = $dadosAtualizados['telefone'];
            $_SESSION['utilizador']['area_formacao']    = $dadosAtualizados['area_formacao'];
            $_SESSION['utilizador']['curso_pretendido'] = $dadosAtualizados['curso_pretendido'];

            // Log após o update
            error_log('DEPOIS UPDATE: ' . session_id() . ' | ' . print_r($_SESSION, true));

            // Redireciona para a página de perfil com mensagem de sucesso
            header('Location: ?rota=meu_perfil&sucesso=1');
            exit;
        }

        // Obtém os dados do estudante para exibir no formulário
        $dados = $modelo->obterDadosEstudante($id_usuario);

        // Inclui a view
        require __DIR__ . '/../../visoes/utilizador/perfil_estudante.php';
    }
}