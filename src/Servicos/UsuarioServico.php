<?php
namespace App\Servicos;

require_once __DIR__ . '/../config/conexao_basedados.php'; // <-- Adicione esta linha

use App\Modelos\Usuario;

class UsuarioServico
{
    public function listarTodos()
    {
        return Usuario::todos();
    }

    public function criar($dados)
    {
        if (empty($dados['id_nivel_acesso'])) {
            throw new \Exception('O campo Nível de Acesso é obrigatório.');
        }

        // Verifica se já existe nome de usuário
        $pdo = \obterConexao();
        $stmt = $pdo->prepare("SELECT 1 FROM usuario WHERE nome_usuario = ?");
        $stmt->execute([$dados['nome_usuario']]);
        if ($stmt->fetch()) {
            throw new \Exception('Nome de usuário já existe. Escolha outro.');
        }

        $usuario = new Usuario();
        $usuario->nome_usuario = $dados['nome_usuario'] ?? '';
        $usuario->nome_completo = $dados['nome_completo'] ?? '';
        $usuario->email = $dados['email'] ?? '';
        $usuario->senha = password_hash($dados['senha'] ?? '', PASSWORD_DEFAULT);
        $usuario->id_nivel_acesso = $dados['id_nivel_acesso'];
        $usuario->salvar();

        // Sincroniza tabelas auxiliares
        $this->sincronizarTabelasPorNivelAcesso($usuario->id_usuario, $usuario->id_nivel_acesso, $dados);

        return $usuario;
    }

    public function buscarPorId($id)
    {
        return Usuario::buscarPorId($id);
    }

    public function atualizar($id, $dados)
    {
        $usuario = Usuario::buscarPorId($id);
        if (!$usuario) {
            return false;
        }
        $usuario->nome_usuario = $dados['nome_usuario'] ?? $usuario->nome_usuario;
        $usuario->email = $dados['email'] ?? $usuario->email;
        if (!empty($dados['senha'])) {
            $usuario->senha = password_hash($dados['senha'], PASSWORD_DEFAULT);
        }
        $usuario->nome_completo = $dados['nome_completo'] ?? $usuario->nome_completo;
        $usuario->id_nivel_acesso = $dados['id_nivel_acesso'] ?? $usuario->id_nivel_acesso;
        $usuario->salvar();

        // Sincroniza tabelas auxiliares
        $this->sincronizarTabelasPorNivelAcesso($usuario->id_usuario, $usuario->id_nivel_acesso, $dados);

        return $usuario;
    }

    public function deletar($id)
    {
        $usuario = Usuario::buscarPorId($id);
        if ($usuario) {
            return Usuario::deletar($id);
        }
        return false;
    }

    /**
     * Sincroniza as tabelas administrador e estudante conforme o nível de acesso.
     */
    private function sincronizarTabelasPorNivelAcesso($id_usuario, $novo_nivel, $dadosExtras = [])
    {
        $pdo = \obterConexao();

        if ($novo_nivel == 2) { // Estudante
            // Remove da tabela administrador se existir
            $stmt = $pdo->prepare("DELETE FROM administrador WHERE id_usuario = ?");
            $stmt->execute([$id_usuario]);

            // Verifica se já existe em estudante
            $stmt = $pdo->prepare("SELECT 1 FROM estudante WHERE id_usuario = ?");
            $stmt->execute([$id_usuario]);
            if (!$stmt->fetch()) {
                // Insere se não existir
                $stmt = $pdo->prepare("INSERT INTO estudante (id_usuario, data_nasc, telefone, area_formacao, curso_pretendido) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([
                    $id_usuario,
                    $dadosExtras['data_nasc'] ?? null,
                    $dadosExtras['telefone'] ?? null,
                    $dadosExtras['area_formacao'] ?? null,
                    $dadosExtras['curso_pretendido'] ?? null
                ]);
            } else {
                // Atualiza se já existir
                $stmt = $pdo->prepare("UPDATE estudante SET data_nasc = ?, telefone = ?, area_formacao = ?, curso_pretendido = ? WHERE id_usuario = ?");
                $stmt->execute([
                    $dadosExtras['data_nasc'] ?? null,
                    $dadosExtras['telefone'] ?? null,
                    $dadosExtras['area_formacao'] ?? null,
                    $dadosExtras['curso_pretendido'] ?? null,
                    $id_usuario
                ]);
            }
        } elseif ($novo_nivel == 1) { // Administrador
            // Remove da tabela estudante se existir
            $stmt = $pdo->prepare("DELETE FROM estudante WHERE id_usuario = ?");
            $stmt->execute([$id_usuario]);

            // Verifica se já existe em administrador
            $stmt = $pdo->prepare("SELECT 1 FROM administrador WHERE id_usuario = ?");
            $stmt->execute([$id_usuario]);
            if (!$stmt->fetch()) {
                // Insere se não existir
                $stmt = $pdo->prepare("INSERT INTO administrador (id_usuario) VALUES (?)");
                $stmt->execute([$id_usuario]);
            }
        }
    }
}