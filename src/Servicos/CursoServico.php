<?php

namespace App\servicos;

use App\Modelos\Curso;

class CursoServico
{
    public function listarTodos()
    {
        return Curso::todos();
    }

    public function buscarPorId($id)
    {
        return Curso::buscarPorId($id);
    }

    public function criar($dados)
    {
        $item = new Curso();
        $item->nome = $dados['nome'] ?? '';
        return $item->salvar();
    }

    public function atualizar($id, $dados)
    {
        $item = Curso::buscarPorId($id);
        if (!$item) return false;
        $item->nome = $dados['nome'] ?? $item->nome;
        return $item->salvar();
    }

    public function deletar($id)
    {
        $item = Curso::buscarPorId($id);
        if ($item) return $item->deletar();
        return false;
    }
}