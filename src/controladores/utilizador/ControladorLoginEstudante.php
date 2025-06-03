<?php
declare(strict_types=1);

namespace App\controladores\utilizador;

use App\modelos\ModeloEstudante;

class ControladorLoginEstudante
{
    public function mostrarFormulario(): void
    {
        $paginaCss = 'inicio';
        require __DIR__ . '/../../visoes/utilizador/login.php';
    }

    public function processarLogin(): void
    {
        $email = filter_input(INPUT_POST, 'email_estudante', FILTER_SANITIZE_EMAIL);
        $senha = $_POST['senha_estudante'] ?? '';

        $conexao = require __DIR__ . '/../../../config/conexao.php';
        $modelo = new ModeloEstudante($conexao);
        $estudante = $modelo->login($email, $senha);

        if ($estudante) {
            $_SESSION['estudante'] = $estudante;
            header('Location: ?rota=dashboard_estudante');
        } else {
            $_SESSION['erro_login'] = 'Credenciais inválidas';
            header('Location: ?rota=login_estudante');
        }
    }

    public function terminarSessao(): void
    {
        session_destroy();
        header('Location: ?rota=login_estudante');
        exit;
    }
}
