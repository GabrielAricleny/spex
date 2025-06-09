<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/EstudanteModel.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['nome_arquivo'] === 'login_estudante.php') {
        $email = $_POST['email_estudante'];
        $senha = $_POST['senha_estudante'];

        $estudante = Estudante::login($email, $senha);

        if ($estudante) {
            $_SESSION['id_estudante'] = $estudante['id_estudante'];
            $_SESSION['nome_estudante'] = $estudante['nome_estudante'];
            $_SESSION['email_estudante'] = $estudante['email_estudante'];
            header("Location: ../views/dashboard.php");
            exit();
        } else {
            echo "Login inválido--!";
        }
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../../index.php");
    exit();
}
