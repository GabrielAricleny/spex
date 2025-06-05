<?php
namespace App\Modelos;

class Administrador
{
    public $id_administrador;
    public $id_usuario;
    public $telefone;
    public $nome_completo;
    public $email;

    public static function todos()
    {
        $pdo = self::getConexao();
        $sql = "SELECT 
                    a.id_usuario, 
                    a.telefone, 
                    a.criado_em, 
                    a.actualizado_em, 
                    u.nome_completo, 
                    u.nome_usuario, 
                    u.email 
                FROM administrador a
                JOIN usuario u ON a.id_usuario = u.id_usuario";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function inserirSeAdministrador($id_usuario)
    {
        $pdo = self::getConexao();
        // Verifica se o usuário já é administrador
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM administrador WHERE id_usuario = :id_usuario");
        $stmt->execute(['id_usuario' => $id_usuario]);
        if ($stmt->fetchColumn() > 0) {
            return false; // Já é administrador
        }

        // Verifica se o usuário tem nível de acesso de administrador (ajuste o valor conforme necessário)
        $stmt = $pdo->prepare("SELECT id_nivel_acesso FROM usuario WHERE id_usuario = :id_usuario");
        $stmt->execute(['id_usuario' => $id_usuario]);
        $nivel = $stmt->fetchColumn();

        if ($nivel == 1) { // Supondo que 1 é o nível de administrador
            $stmt = $pdo->prepare("INSERT INTO administrador (id_usuario) VALUES (:id_usuario)");
            return $stmt->execute(['id_usuario' => $id_usuario]);
        }
        return false;
    }

    public function salvar()
    {
        $pdo = self::getConexao();

        // Verifica se já existe um administrador com esse id_usuario
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM administrador WHERE id_usuario = :id_usuario");
        $stmt->execute(['id_usuario' => $this->id_usuario]);
        $existe = $stmt->fetchColumn();

        if ($existe) {
            // Atualiza telefone
            $stmt = $pdo->prepare("UPDATE administrador SET telefone = :telefone WHERE id_usuario = :id_usuario");
            return $stmt->execute([
                'telefone' => $this->telefone,
                'id_usuario' => $this->id_usuario
            ]);
        } else {
            // Insere novo administrador
            $stmt = $pdo->prepare("INSERT INTO administrador (id_usuario, telefone) VALUES (:id_usuario, :telefone)");
            return $stmt->execute([
                'id_usuario' => $this->id_usuario,
                'telefone' => $this->telefone
            ]);
        }
    }

    public static function buscarPorId($id_usuario)
    {
        $pdo = self::getConexao();
        $sql = "SELECT 
                    a.id_usuario, 
                    a.telefone, 
                    u.nome_completo, 
                    u.email 
                FROM administrador a
                JOIN usuario u ON a.id_usuario = u.id_usuario
                WHERE a.id_usuario = :id_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_usuario' => $id_usuario]);
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    private static function getConexao()
    {
        require_once __DIR__ . '/../config/conexao_basedados.php';
        return obterConexao();
    }
}