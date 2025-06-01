<?php
declare(strict_types=1);

namespace App\controladores\admin;

require_once __DIR__ . '/../../../config/conexao_basedados.php';

class ControladorPainelAdmin
{
    private \PDO $pdo;

    public function __construct()
    {
        global $conexao;
        $this->pdo = $conexao;
    }

    public function painel(): void
    {
        // Lista de tabelas e seus rótulos
        $tabelas = [
            'administrador'        => 'Administradores',
            'estudante'            => 'Estudantes',
            'universidade'         => 'Universidades',
            'curso'                => 'Cursos',
            'disciplina'           => 'Disciplinas',
            'exame_sistema'        => 'Exames do Sistema',
            'pergunta_cadastrada'  => 'Perguntas',
            'historico_exames'     => 'Histórico de Exames',
            'usuario'              => 'Usuários',
        ];

        $resumos = [];

        foreach ($tabelas as $tabela => $titulo) {
            $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM $tabela");
            $resumos[$tabela] = [
                'titulo' => $titulo,
                'total'  => $stmt->fetchColumn(),
            ];
        }

        require __DIR__ . '/../../visoes/admin/painel_admin.php';
    }
}
