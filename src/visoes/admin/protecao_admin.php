<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (
    !isset($_SESSION['utilizador']) ||
    !isset($_SESSION['utilizador']['nivel_acesso']) ||
    $_SESSION['utilizador']['nivel_acesso'] !== 'admin'
) {
    header('Location: ?rota=inicio');
    exit;
}
?>