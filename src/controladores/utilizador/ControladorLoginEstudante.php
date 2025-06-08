<?php
declare(strict_types=1);

namespace App\controladores\utilizador;

use App\Modelos\ModeloEstudante;

class ControladorLoginEstudante
{
    public function mostrarFormulario(): void
    {
        if (isset($_SESSION['utilizador']) && ($_SESSION['utilizador']['nivel_acesso'] ?? '') === 'estudante') {
            header('Location: ?rota=dashboard_estudante');
            exit;
        }
        $paginaCss = 'inicio';
        require __DIR__ . '/../../visoes/utilizador/login_estudante.php';
    }

    public function processarLogin(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = $_POST['senha_estudante'] ?? '';

        $conexao = require __DIR__ . '/../../config/conexao_basedados.php';
        $modelo = new ModeloEstudante($conexao);

        $estudante = $modelo->login($email, $senha);

        if ($estudante) {
            $_SESSION['utilizador'] = $estudante;
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
        unset($_SESSION['utilizador']);
        session_destroy();
        header('Location: ?rota=inicio');
        exit;
    }
}
