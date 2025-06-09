<?php
<<<<<<<< HEAD:tests/unit/common/test_db.php
require_once __DIR__ . '/../src/config/database.php';
========
require_once __DIR__ . '/../../src/config/database.php';
>>>>>>>> f845488efedecbaf9c9e658ed0c9b39a6ea4a62c:tests/unit/test_db.php

try {
    // Executa uma consulta simples para verificar a conexão
    $stmt = $pdo->query("SELECT 'Conexão bem-sucedida!' AS mensagem");
    $resultado = $stmt->fetch();

    echo '------------------------------<br>';
    echo $resultado['mensagem'] . '<br>';
    echo '------------------------------<br>';

    try {
        // Executa uma consulta simples para verificar a conexão
<<<<<<<< HEAD:tests/unit/common/test_db.php
        $stmt = $pdo->query("SELECT * FROM curso WHERE nome_curso LIKE '%' ORDER BY id_curso");
========
        $stmt = $pdo->query("SELECT * FROM curso ORDER BY id_curso");
>>>>>>>> f845488efedecbaf9c9e658ed0c9b39a6ea4a62c:tests/unit/test_db.php
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo '<br>';
        
        echo '<table style="border:1px solid black; border-collapse:non-collapse;">';
            echo '<tr>';
                echo '<th style="border:1px solid black;">ID CURSO</th>';
                echo '<th style="border:1px solid black;">NOME DO CURSO</th>';
            echo '</tr>';
            
            foreach ($resultado as $result) {
                echo '<tr>';
                    echo '<td style="border:1px solid black; text-align:center;">' . $result['id_curso'] . '</td>';
                    echo '<td style="border:1px solid black;">' . $result['nome_curso'] . '</td>';
                echo '</tr>';
            }

        echo '</table>';

    } catch (PDOException $e) {
        echo "Erro ao consultar banco de dados: " . $e->getMessage();
    }
} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
<<<<<<<< HEAD:tests/unit/common/test_db.php
}
========
}
>>>>>>>> f845488efedecbaf9c9e658ed0c9b39a6ea4a62c:tests/unit/test_db.php
