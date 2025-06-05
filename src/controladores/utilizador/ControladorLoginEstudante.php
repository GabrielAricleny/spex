<?php
declare(strict_types=1);

namespace App\controladores\utilizador;

use App\Modelos\ModeloEstudante;

class ControladorLoginEstudante
{
    public function mostrarFormulario(): void
    {
        $paginaCss = 'inicio';
        require __DIR__ . '/../../visoes/utilizador/login_estudante.php';
    }

    public function processarLogin(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = $_POST['senha_estudante'] ?? '';

        $conexao = require __DIR__ . '/../../config/conexao_basedados.php';
        $modelo = new \App\Modelos\ModeloEstudante($conexao);

        // Usa o modelo diretamente para login
        $estudante = $modelo->login($email, $senha);

        if ($estudante) {
            $_SESSION['estudante'] = $estudante;
            header('Location: ?rota=dashboard_estudante');
            exit;
        } else {
            $_SESSION['erro_login'] = 'Email ou senha inválidos.';
            header('Location: ?rota=login_estudante');
            exit;
        }
    }

    public function terminarSessao(): void
    {
        unset($_SESSION['estudante']);
        session_destroy();
        header('Location: ?rota=login_estudante');
        exit;
    }
}
