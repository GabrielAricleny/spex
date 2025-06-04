<?php
/* Execute este arquivo apenas uma vez!
** Ele vai sobrescrever as senhas. 
** Faça backup antes, se necessário.
**/

require_once __DIR__ . '/../config/conexao_basedados.php';

function encriptar_senhas() {
    try {
        $pdo = obterConexao();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Buscar todas as senhas da tabela usuario
        $stmt = $pdo->query("SELECT id_usuario, senha FROM usuario");

        $total = 0;
        $ja_encriptadas = 0;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id_usuario'];
            $senha_actual = $row['senha'];

            // Pula se a senha já está encriptada (bcrypt)
            if (preg_match('/^\$2[aby]\$.{56}$/', $senha_actual)) {
                $ja_encriptadas++;
                continue;
            }

            // Pula se a senha está vazia
            if (empty($senha_actual)) {
                echo "Usuário $id com senha vazia, pulando.<br>";
                continue;
            }

            $senha_hash = password_hash($senha_actual, PASSWORD_BCRYPT);

            $update = $pdo->prepare("UPDATE usuario SET senha = ? WHERE id_usuario = ?");
            $update->execute([$senha_hash, $id]);
            $total++;
            echo "Usuário $id senha atualizada.<br>";
        }

        echo "<br>Senhas atualizadas com sucesso!<br>";
        echo "Total de senhas encriptadas: $total<br>";
        echo "Senhas já encriptadas: $ja_encriptadas<br>";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}

// Executa a função ao carregar arquivo.
encriptar_senhas();
?>