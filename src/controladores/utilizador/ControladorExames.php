<?php
declare(strict_types=1);

namespace App\controladores\utilizador;

use PDO;
use PDOException;

require_once __DIR__ . '/../../modelos/ModeloExame.php';

use App\modelos\ModeloExame;

class ControladorExames
{
    private PDO $pdo;

    public function __construct()
    {
        $this->inicializarConexao();
    }

    private function inicializarConexao(): void
    {
        if (!isset($this->pdo)) {
            require_once __DIR__ . '/../../config/conexao_basedados.php';

            if (!isset($conexao) || !$conexao instanceof PDO) {
                throw new PDOException("A variável \$conexao não foi definida ou não é uma instância de PDO.");
            }

            $this->pdo = $conexao;
        }
    }

    public function listarExames(): void
    {
        // Listar exames disponíveis para o estudante
        echo "Lista de exames para o estudante";
    }

    public function iniciarExame(int $idExame): void
    {
        // Exemplo de uso da variável $idExame para evitar erro de variável não usada
        // Você pode substituir por lógica real conforme necessário
        if ($idExame > 0) {
            // Lógica para iniciar um exame com o ID fornecido
            // Por exemplo, buscar o exame no banco de dados
        }
    }
}
