<?php
/* Execute este arquivo apenas uma vez!
** Ele vai sobrescrever as senhas. 
** Faça backup antes, se necessário.
**/

require_once __DIR__ . '/../config/conexao_basedados.php';

function encriptar_senhas() {
    try {
        $pdo = new PDO("mysql:host=" . BD_SERVIDOR . ";dbname=" . BD_BASEDADOS, BD_USUARIO, BD_SENHA);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Buscar todas as senhas que ainda estão em texto puro
        $stmt = $pdo->query("SELECT id_usuario, senha FROM usuario");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id_usuario'];
            $senha_actual = $row['senha'];

            // Evita re-hash se a senha já estiver encriptada (opcional)
            if (preg_match('/^\$2[aby]\$.{56}$/', $senha_actual)) {
                continue; // já está encriptada
            }

            $senha_hash = password_hash($senha_actual, PASSWORD_BCRYPT);

            $update = $pdo->prepare("UPDATE usuario SET senha = ? WHERE id_usuario = ?");
            $update->execute([$senha_hash, $id]);
        }

        echo "Senhas atualizadas com sucesso!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

// Executa a função ao carregar arquivo.
encriptar_senhas();
?>