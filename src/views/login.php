<?php
session_start();

if (isset($_SESSION['id_estudante'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPEX</title>
    <link rel="stylesheet" href="../../public/css/bulma/css/bulma.min.css">
    <link rel="stylesheet" href="../../public/css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/login.css">
</head>

<body>
    <div class="container">
        <div class="login-container">
            <div class="brand-logo">
                <h1 class="title is-3" style="color: #3a0ca3;">SPEX</h1>
                <p class="subtitle is-6" style="color: #7a7a7a;">Sistema de Preparação para Exames</p>
            </div>

            <div class="login-card">
                <h2 class="login-title">Acesse sua conta</h2>

                <form action="../controllers/AuthController.php" method="post">
                    <input type="text" name="nome_arquivo" id="nome_arquivo" value="login_estudante.php" style="display: none;">
                    <div class="input-field">
                        <label for="email">E-mail</label>
                        <div class="input-control">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" id="email" name="email_estudante" placeholder="Digite seu e-mail" required>
                        </div>
                    </div>

                    <div class="input-field">
                        <label for="password">Senha</label>
                        <div class="input-control">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="password" name="senha_estudante" placeholder="Digite sua senha" required>
                        </div>
                    </div>

                    <button type="submit" class="login-button">
                        <i class="fas fa-sign-in-alt"></i> Entrar
                    </button>
                </form>

                <div class="login-footer">
                    <p>Não tem uma conta? <a href="cadastro_estudante.php">Criar Conta</a></p>
                    <p class="mt-2"><a href="recuperar_senha.php">Esqueceu sua senha?</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="../../public/js/login.js"></script>
</body>

</html>