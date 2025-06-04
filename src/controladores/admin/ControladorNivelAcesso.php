<?php
declare(strict_types=1);

namespace App\controladores\admin;

use PDO;
use PDOException;

class ControladorNivelAcesso
{
    private static ?PDO $pdo = null;

    // Inicializa a conexão PDO usando o arquivo de configuração
    private static function inicializarConexao(): void
    {
        if (self::$pdo === null) {
            self::$pdo = require __DIR__ . '/../../config/conexao_basedados.php';
            if (!(self::$pdo instanceof PDO)) {
                throw new PDOException("A conexão com o banco de dados não foi estabelecida.");
            }
        }
    }

    // Lista todos os níveis de acesso
    public function index(): void
    {
        self::inicializarConexao();

        $sql = 'SELECT * FROM nivel_acesso ORDER BY id_nivel DESC';
        $stmt = self::$pdo->query($sql);
        $niveis = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../../visoes/admin/nivel_acesso/index.php';
    }

    // Cria um novo nível de acesso
    public function criar(): void
    {
        self::inicializarConexao();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descricao = trim($_POST['descricao'] ?? '');

            if ($descricao !== '') {
                $sql = 'INSERT INTO nivel_acesso (descricao) VALUES (:descricao)';
                $stmt = self::$pdo->prepare($sql);
                $stmt->bindValue(':descricao', $descricao, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    header('Location: ?rota=crud_nivel_acesso');
                    exit;
                }
            }

            $erro = 'A descrição do nível de acesso é obrigatória.';
        }

        require __DIR__ . '/../../visoes/admin/nivel_acesso/formulario.php';
    }

    // Edita um nível de acesso existente
    public function editar(): void
    {
        self::inicializarConexao();

        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        if ($id <= 0) {
            http_response_code(400);
            echo "ID inválido.";
            exit;
        }

        $sql = 'SELECT * FROM nivel_acesso WHERE id_nivel = :id LIMIT 1';
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $nivel = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$nivel) {
            http_response_code(404);
            echo "Nível de acesso não encontrado.";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descricao = trim($_POST['descricao'] ?? '');

            if ($descricao !== '') {
                $sql = 'UPDATE nivel_acesso SET descricao = :descricao WHERE id_nivel = :id';
                $stmt = self::$pdo->prepare($sql);
                $stmt->bindValue(':descricao', $descricao, PDO::PARAM_STR);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    header('Location: ?rota=crud_nivel_acesso');
                    exit;
                }
            }

            $erro = 'A descrição do nível de acesso é obrigatória.';
        }

        require __DIR__ . '/../../visoes/admin/nivel_acesso/formulario.php';
    }

    // Remove um nível de acesso
    public function eliminar(): void
    {
        self::inicializarConexao();

        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

        if ($id <= 0) {
            http_response_code(400);
            echo "ID inválido.";
            exit;
        }

        $sql = 'DELETE FROM nivel_acesso WHERE id_nivel = :id';
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header('Location: ?rota=crud_nivel_acesso');
        exit;
    }

    // Roteia as ações CRUD
    public function crud(): void
    {
        $acao = $_GET['acao'] ?? 'index';
        switch ($acao) {
            case 'criar':
                $this->criar();
                break;
            case 'editar':
                $this->editar();
                break;
            case 'eliminar':
                $this->eliminar();
                break;
            default:
                $this->index();
        }
    }
}
