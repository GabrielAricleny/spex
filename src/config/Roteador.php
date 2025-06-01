<?php
declare(strict_types=1);

namespace App\config;

// session_start();

class Roteador
{
    private array $rotas = [];
    private array $middlewares = [];

    /**
     * Adiciona uma rota ao sistema.
     *
     * @param string   $metodo      Método HTTP (GET, POST, etc.)
     * @param string   $caminho     Caminho da rota (ex: "login_admin")
     * @param callable $acao        Função a ser executada quando a rota for chamada
     * @param array    $middlewares Lista de middlewares associados à rota
     */
    public function adicionar(string $metodo, string $caminho, callable $acao, array $middlewares = []): void
    {
        $metodo = strtoupper($metodo);
        $this->rotas[$metodo][$caminho] = $acao;
        $this->middlewares[$caminho] = $middlewares;
    }

    /**
     * Despacha a rota solicitada pelo utilizador.
     *
     * @param string $rota Caminho da rota passada via query string
     */
    public function despachar(string $rota): void
    {
        $metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        if (!isset($this->rotas[$metodo])) {
            $this->mostrarErro404();
            return;
        }

        foreach ($this->rotas[$metodo] as $padrao => $acao) {
            $regex = preg_replace('#\{[a-zA-Z_][a-zA-Z0-9_]*\}#', '([^/]+)', $padrao);
            $regex = "#^$regex$#";

            if (preg_match($regex, $rota, $parametros)) {
                array_shift($parametros);

                $this->executarMiddlewares($padrao);
                call_user_func_array($acao, $parametros);
                return;
            }
        }

        $this->mostrarErro404();
    }

    /**
     * Executa os middlewares associados a uma rota.
     *
     * @param string $rota Caminho da rota
     */
    private function executarMiddlewares(string $rota): void
    {
        if (empty($this->middlewares[$rota])) {
            return;
        }

        require_once __DIR__ . '/middlewares.php';

        foreach ($this->middlewares[$rota] as $middleware) {
            if (function_exists($middleware)) {
                $middleware();
            }
        }
    }

    /**
     * Mostra página de erro 404 - Rota não encontrada.
     */
    private function mostrarErro404(): void
    {
        http_response_code(404);
        require __DIR__ . '/../visoes/templates/erro404.php';
        exit;
    }

    /**
     * Mostra página de erro 403 - Acesso proibido.
     */
    private function mostrarErro403(): void
    {
        http_response_code(403);
        require __DIR__ . '/../visoes/templates/erro403.php';
        exit;
    }

    private function verificarMiddleware(array $middlewares): bool
    {
        foreach ($middlewares as $middleware) {
            if ($middleware === 'autenticadoAdmin' && (!isset($_SESSION['utilizador']) || $_SESSION['utilizador']['nivel_acesso'] !== 'admin')) {
                header('Location: ?rota=login_admin');
                exit;
            }
        }
    
        return true;
    }

}
