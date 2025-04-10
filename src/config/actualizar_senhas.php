<?php
/* Execute este arquivo apenas uma vez!
** Ele vai sobrescrever as senhas. 
** Faça backup antes, se necessário.
**/

require_once __DIR__ . '/database.php';

function encriptar_senhas() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Buscar todas as senhas que ainda estão em texto puro
        $stmt = $pdo->query("SELECT id_estudante, senha_estudante FROM estudante");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id_estudante'];
            $senha_actual = $row['senha_estudante'];

            // Evita re-hash se a senha já estiver encriptada (opcional)
            if (preg_match('/^\$2[aby]\$.{56}$/', $senha_actual)) {
                continue; // já está encriptada
            }

            $senha_hash = password_hash($senha_actual, PASSWORD_BCRYPT);

            $update = $pdo->prepare("UPDATE estudante SET senha_estudante = ? WHERE id_estudante = ?");
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