<?php
declare(strict_types=1);

spl_autoload_register(function (string $class): void {
    // Namespace base esperado
    $prefixo = 'App\\';
    // Diretório base para carregar arquivos
    $base_dir = __DIR__ . '/../';

    // Verifica se a classe usa o namespace base esperado
    $comprimento = strlen($prefixo);
    if (strncmp($prefixo, $class, $comprimento) !== 0) {
        // Não é uma classe do namespace 'App', ignora
        return;
    }

    // Obtém o caminho relativo da classe (removendo o prefixo do namespace)
    $nome_relativo = substr($class, $comprimento);

    // Converte namespace para caminho de arquivo
    $arquivo = $base_dir . str_replace('\\', DIRECTORY_SEPARATOR, $nome_relativo) . '.php';

    // Inclui o arquivo, se existir
    if (file_exists($arquivo)) {
        require_once $arquivo;
    }
});

