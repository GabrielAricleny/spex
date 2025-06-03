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
            // Pegue os dados do formulário
            $dados = [
                'nome_estudante'   => trim($_POST['nome_estudante'] ?? ''),
                'data_nasc'        => trim($_POST['data_nasc'] ?? ''),
                'telefone'         => trim($_POST['telefone'] ?? ''),
                'email'            => trim($_POST['email'] ?? ''),
                'area_formacao'    => trim($_POST['area_formacao'] ?? ''),
                'curso_pretendido' => trim($_POST['curso_pretendido'] ?? ''),
                'nome_usuario'     => trim($_POST['nome_usuario'] ?? ''),
                'senha_estudante'  => password_hash($_POST['senha_estudante'] ?? '', PASSWORD_DEFAULT),
            ];

            try {
                $servico = new EstudanteServico();
                $resultado = $servico->criar($dados);

                if ($resultado) {
                    $sucesso = true;
                } else {
                    $erro = 'Erro ao criar conta. Verifique os dados e tente novamente.';
                }
            } catch (\Throwable $e) {
                $erro = 'Erro ao criar conta: ' . $e->getMessage();
            }
        }

        require __DIR__ . '/../../../visoes/utilizador/cadastro_estudante.php';
    }
}