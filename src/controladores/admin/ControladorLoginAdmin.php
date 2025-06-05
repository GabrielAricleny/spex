<?php
declare(strict_types=1);

namespace App\controladores\admin;

use App\Modelos\ModeloAdministrador;

class ControladorLoginAdmin
{
    private ModeloAdministrador $modelo;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->modelo = new ModeloAdministrador();
    }

    /**
     * Processa o formulário de login do administrador.
     */
    public function processarLogin(): void
    {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        // Debug
        echo "Email recebido: [$email]<br>";
        echo "Senha recebida: [$senha]<br>";

        $admin = ModeloAdministrador::login($email, $senha);

        if ($admin) {
            $_SESSION['utilizador'] = [
                'nome'          => $admin['nome_completo'],
                'email'         => $admin['email'],
                'nivel_acesso'  => 'admin',
            ];
            header('Location: ?rota=painel_admin');
            exit;
        }

        // Debug
        // echo "Login falhou<br>";
        $_SESSION['erro_login'] = 'Email ou senha inválidos.';
        header('Location: ?rota=login_admin');
        exit;
    }

    /**
     * Mostra o formulário de login do administrador.
     */  
    public function mostrarFormulario(): void
    {
        include __DIR__ . '/../../visoes/admin/login_admin.php';
    }

    /**
     * Termina a sessão do administrador.
     */
    public function terminarSessao(): void
    {
        session_destroy();
        header('Location: ?rota=inicio');
        exit;
    }
}

