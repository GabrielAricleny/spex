<?php
// Carregar autoload
require_once __DIR__ . '/autoload.php';

// Função para carregar variáveis do .env
function carregarVariaveisAmbiente($ficheiro = __DIR__ . '/../../.env')
{
    if (!file_exists($ficheiro)) {
        return;
    }

    $linhas = file($ficheiro, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($linhas as $linha) {
        if (strpos(trim($linha), '#') === 0) {
            continue;
        }

        list($chave, $valor) = explode('=', $linha, 2);
        putenv("$chave=$valor");
        $_ENV[$chave] = $valor;
        $_SERVER[$chave] = $valor;
    }
}

// Carregar automaticamente
carregarVariaveisAmbiente();

