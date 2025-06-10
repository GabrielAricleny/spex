<?php

namespace Src\Ajudantes;

class Funcoes
{
    public static function limparEntrada(string $entrada): string
    {
        return htmlspecialchars(strip_tags(trim($entrada)), ENT_QUOTES, 'UTF-8');
    }

    public static function redirecionar(string $url): void
    {
        header("Location: $url");
        exit;
    }

    public static function gerarToken(): string
    {
        return bin2hex(random_bytes(32));
    }

    public static function verificarMetodoPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public static function formatarData(string $data): string
    {
        return date('d/m/Y H:i', strtotime($data));
    }
}
