<?php
declare(strict_types=1);

namespace App\controladores\utilizador;

use App\modelos\ExameModel;

class ControladorExames
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function listarExames(): void
    {
        $modelo = new ModeloExame($this->pdo);
        $exames = $modelo->listarExamesDisponiveis();
        
        $paginaCss = 'exames';
        require __DIR__ . '/../../visoes/utilizador/exames/arena.php';
    }

    public function iniciarExame(int $idExame): void
    {
        // Lógica para iniciar um exame
    }
}