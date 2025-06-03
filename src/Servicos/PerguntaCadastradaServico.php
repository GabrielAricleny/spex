<?php

namespace App\servicos;

use App\Modelos\PerguntaCadastrada;

class PerguntaCadastradaServico
{
    public function listarTodos()
    {
        return PerguntaCadastrada::todos();
    }

    public function buscarPorId($id)
    {
        return PerguntaCadastrada::buscarPorId($id);
    }

    public function criar($dados)
    {
        $item = new PerguntaCadastrada();
        $item->nome = $dados['nome'] ?? '';
        return $item->salvar();
    }

    public function atualizar($id, $dados)
    {
        $item = PerguntaCadastrada::buscarPorId($id);
        if (!$item) return false;
        $item->nome = $dados['nome'] ?? $item->nome;
        return $item->salvar();
    }

    public function deletar($id)
    {
        $item = PerguntaCadastrada::buscarPorId($id);
        if ($item) return $item->deletar();
        return false;
    }
}