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
        $linha = trim($linha);
        if ($linha === '' || strpos($linha, '#') === 0) {
            continue;
        }
        if (strpos($linha, '=') === false) {
            continue;
        }
        list($chave, $valor) = explode('=', $linha, 2);
        $chave = trim($chave);
        $valor = trim($valor);
        putenv("$chave=$valor");
        $_ENV[$chave] = $valor;
        $_SERVER[$chave] = $valor;
    }
}

// Carregar automaticamente
carregarVariaveisAmbiente();

