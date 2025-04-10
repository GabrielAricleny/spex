<?php
    session_start();
    require_once __DIR__ . '/../models/EstudanteModel.php';
    require_once __DIR__ . '/helpers/datetime_helper.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome_estudante = $_POST['nome_estudante'];
        $nome_usuario = $_POST['nome_usuario'];
        $data_nascimento = transform_date($_POST['data_nascimento']);
        $telefone_estudante = $_POST['telefone_estudante'];
        $email_estudante = $_POST['email_estudante'];
        $area_formacao = $_POST['area_formacao'];
        $curso_pretendido = $_POST['curso_pretendido'];
        $senha_estudante = $_POST['senha_estudante'];

        $senha_errada = 1;

        if ($senha_estudante === $_POST['senha_estudante_confirmada']) {
            Estudante::cadastrar($nome_estudante, $nome_usuario, $data_nascimento, $telefone_estudante, $email_estudante, $area_formacao, $curso_pretendido, $senha_estudante);

            header("Location: /src/views/login.php");
        }
        else {
            $senha_errada = true;
        }
    }
?>