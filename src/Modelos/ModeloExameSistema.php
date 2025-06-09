<?php
namespace App\Modelos;

use PDO;

class ModeloExameSistema
{
    private PDO $pdo;

    public function __construct(PDO $conexao)
    {
        $this->pdo = $conexao;
    }

    public function listar()
    {
        $sql = "SELECT * FROM exame_sistema ORDER BY criado_em DESC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM exame_sistema WHERE id_exame = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $duracao)
    {
        $sql = "UPDATE exame_sistema SET duracao = ?, actualizado_em = NOW() WHERE id_exame = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$duracao, $id]);
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM exame_sistema WHERE id_exame = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    
    public function criar($duracao)
    {
        $sql = "INSERT INTO exame_sistema (duracao, criado_em) VALUES (?, NOW())";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$duracao]);
    }

    public function criarExameSistemaAutomatico(PDO $pdo, $duracao, array $idsCursos, array $idsDisciplinas, array $idsTemas) {
        // 1. Cria o exame
        $stmt = $pdo->prepare("INSERT INTO exame_sistema (duracao, criado_em) VALUES (?, NOW())");
        $stmt->execute([$duracao]);
        $idExame = $pdo->lastInsertId();

        // 2. (Opcional) Associa o exame aos cursos (se houver tabela de associação)
        // foreach ($idsCursos as $idCurso) {
        //     $pdo->prepare("INSERT INTO exame_sistema_curso (id_exame, id_curso) VALUES (?, ?)")->execute([$idExame, $idCurso]);
        // }

        // 3. Seleciona perguntas compatíveis
        $inCursos = implode(',', array_fill(0, count($idsCursos), '?'));
        $inDisciplinas = implode(',', array_fill(0, count($idsDisciplinas), '?'));
        $inTemas = implode(',', array_fill(0, count($idsTemas), '?'));

        $sql = "SELECT p.id_pergunta
                FROM pergunta p
                JOIN disciplina d ON p.id_disciplina = d.id_disciplina
                JOIN disciplina_curso dc ON d.id_disciplina = dc.id_disciplina
                WHERE dc.id_curso IN ($inCursos)
                  AND p.id_disciplina IN ($inDisciplinas)
                  AND p.id_tema IN ($inTemas)";
        $params = array_merge($idsCursos, $idsDisciplinas, $idsTemas);
        $stmtPerguntas = $pdo->prepare($sql);
        $stmtPerguntas->execute($params);
        $perguntas = $stmtPerguntas->fetchAll(PDO::FETCH_COLUMN);

        // 4. Associa perguntas ao exame
        foreach ($perguntas as $idPergunta) {
            $pdo->prepare("INSERT INTO lista_perguntas_exame_sistema (id_exame, id_pergunta) VALUES (?, ?)")
                ->execute([$idExame, $idPergunta]);
        }

        return $idExame;
    }

    public function criarExameSistemaPersonalizado(
        string $duracao,
        array $idsCursos = [],
        array $idsDisciplinas = [],
        array $idsTemas = [],
        int $qtdDisciplinasAleatorias = 0,
        int $qtdTemasAleatorios = 0,
        int $qtdPerguntasAleatorias = 0
    ): int {
        // 1. Cria o exame
        $stmt = $this->pdo->prepare("INSERT INTO exame_sistema (duracao, criado_em) VALUES (?, NOW())");
        $stmt->execute([$duracao]);
        $idExame = $this->pdo->lastInsertId();

        // 2. Seleciona disciplinas
        if ($qtdDisciplinasAleatorias > 0 && !empty($idsCursos)) {
            $inCursos = implode(',', array_fill(0, count($idsCursos), '?'));
            $sql = "SELECT DISTINCT d.id_disciplina
                    FROM disciplina d
                    JOIN disciplina_curso dc ON d.id_disciplina = dc.id_disciplina
                    WHERE dc.id_curso IN ($inCursos)
                    ORDER BY RAND() LIMIT $qtdDisciplinasAleatorias";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($idsCursos);
            $idsDisciplinas = $stmt->fetchAll(PDO::FETCH_COLUMN);
        }

        // 3. Seleciona temas
        if ($qtdTemasAleatorios > 0 && !empty($idsDisciplinas)) {
            $inDisciplinas = implode(',', array_fill(0, count($idsDisciplinas), '?'));
            $sql = "SELECT DISTINCT t.id_tema
                    FROM tema t
                    JOIN pergunta p ON t.id_tema = p.tema
                    WHERE p.disciplina IN ($inDisciplinas)
                    ORDER BY RAND() LIMIT $qtdTemasAleatorios";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($idsDisciplinas);
            $idsTemas = $stmt->fetchAll(PDO::FETCH_COLUMN);
        }

        // 4. Seleciona perguntas
        $params = [];
        $where = [];
        if (!empty($idsCursos)) {
            $inCursos = implode(',', array_fill(0, count($idsCursos), '?'));
            $where[] = "dc.id_curso IN ($inCursos)";
            $params = array_merge($params, $idsCursos);
        }
        if (!empty($idsDisciplinas)) {
            $inDisciplinas = implode(',', array_fill(0, count($idsDisciplinas), '?'));
            $where[] = "p.disciplina IN ($inDisciplinas)";
            $params = array_merge($params, $idsDisciplinas);
        }
        if (!empty($idsTemas)) {
            $inTemas = implode(',', array_fill(0, count($idsTemas), '?'));
            $where[] = "p.tema IN ($inTemas)";
            $params = array_merge($params, $idsTemas);
        }
        $sql = "SELECT DISTINCT p.id_pergunta
                FROM pergunta p
                JOIN disciplina_curso dc ON p.disciplina = dc.id_disciplina";
        if ($where) {
            $sql .= " WHERE " . implode(' AND ', $where);
        }
        $sql .= " ORDER BY RAND()";
        if ($qtdPerguntasAleatorias > 0) {
            $sql .= " LIMIT $qtdPerguntasAleatorias";
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $perguntas = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // 5. Associa perguntas ao exame
        foreach ($perguntas as $idPergunta) {
            $this->pdo->prepare("INSERT INTO lista_perguntas_exame_sistema (id_exame, id_pergunta) VALUES (?, ?)")
                ->execute([$idExame, $idPergunta]);
        }

        return $idExame;
    }
}