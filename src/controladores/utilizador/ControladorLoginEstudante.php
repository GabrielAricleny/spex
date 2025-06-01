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

        $modelo = new ModeloEstudante();
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
        unset($_SESSION['estudante']);
        header('Location: ?rota=inicio');
    }
}
