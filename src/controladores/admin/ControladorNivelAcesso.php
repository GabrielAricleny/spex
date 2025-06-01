<?php
declare(strict_types=1);

namespace App\controladores\admin;

use PDO;
use PDOException;

class ControladorNivelAcesso
{
    private static ?PDO $pdo = null;

    private static function inicializarConexao(): void
    {
        if (self::$pdo === null) {
            require_once __DIR__ . '/../../config/conexao_basedados.php';
            if (!isset($conexao)) {
                throw new PDOException("A variável \$conexao não foi definida.");
            }
            self::$pdo = $conexao;
        }
    }

    public function index(): void
    {
        self::inicializarConexao();

        $sql = 'SELECT * FROM nivel_acesso ORDER BY id_nivel DESC';
        $stmt = self::$pdo->query($sql);
        $niveis = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../../visoes/admin/nivel_acesso/index.php';
    }

    public function criar(): void
    {
        self::inicializarConexao();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome_nivel'] ?? '');

            if ($nome !== '') {
                $sql = 'INSERT INTO nivel_acesso (nome_nivel) VALUES (:nome)';
                $stmt = self::$pdo->prepare($sql);
                $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    header('Location: ?rota=admin_nivel_acesso');
                    exit;
                }
            }

            $erro = 'O nome do nível de acesso é obrigatório.';
        }

        require __DIR__ . '/../../visoes/admin/nivel_acesso/formulario.php';
    }

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
            $nome = trim($_POST['nome_nivel'] ?? '');

            if ($nome !== '') {
                $sql = 'UPDATE nivel_acesso SET nome_nivel = :nome WHERE id_nivel = :id';
                $stmt = self::$pdo->prepare($sql);
                $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    header('Location: ?rota=admin_nivel_acesso');
                    exit;
                }
            }

            $erro = 'O nome do nível de acesso é obrigatório.';
        }

        require __DIR__ . '/../../visoes/admin/nivel_acesso/formulario.php';
    }

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

        header('Location: ?rota=admin_nivel_acesso');
        exit;
    }
}
