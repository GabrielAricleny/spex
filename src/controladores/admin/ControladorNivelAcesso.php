<?php
declare(strict_types=1);

namespace App\controladores\admin;

use App\Modelos\NivelAcesso;  // Alterado para App\Modelos\NivelAcesso

class ControladorNivelAcesso
{
    // Lista todos os níveis de acesso
    public function index(): void
    {
        $niveisAcesso = NivelAcesso::todos();  // Alterado para NivelAcesso::todos()
        require __DIR__ . '/../../visoes/admin/nivel_acesso/index.php';
    }

    // Cria um novo nível de acesso
    public function criar(): void
    {
        $erro = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descricao = $_POST['descricao'] ?? '';
            if (empty($descricao)) {
                $erro = 'Descrição é obrigatória.';
            } else {
                $pdo = require __DIR__ . '/../../config/conexao_basedados.php';
                $nivelAcessoModelo = new \App\Modelos\NivelAcesso($pdo);
                $nivelAcessoModelo->criar($descricao);
                header('Location: ?rota=nivel_acesso_index');
                exit;
            }
        }
        require __DIR__ . '/../../visoes/admin/nivel_acesso/formulario.php';
    }

    // Edita um nível de acesso existente
    public function editar($id): void
    {
        $erro = '';
        $pdo = require __DIR__ . '/../../config/conexao_basedados.php';
        $nivelAcessoModelo = new \App\Modelos\NivelAcesso($pdo);
        $nivel = $nivelAcessoModelo->encontrar($id);

        if (!$nivel) {
            $erro = 'Nível de acesso não encontrado.';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descricao = $_POST['descricao'] ?? '';
            if (empty($descricao)) {
                $erro = 'Descrição é obrigatória.';
            } else {
                $nivelAcessoModelo->actualizar($id, $descricao);
                header('Location: ?rota=nivel_acesso_index');
                exit;
            }
        }
        require __DIR__ . '/../../visoes/admin/nivel_acesso/formulario.php';
    }

    // Remove um nível de acesso
    public function eliminar(int $id): void
    {
        $pdo = require __DIR__ . '/../../config/conexao_basedados.php';
        $nivelAcessoModelo = new NivelAcesso($pdo);
        $nivelAcessoModelo->eliminar($id);

        header('Location: ?rota=nivel_acesso_index');
        exit;
    }
}
