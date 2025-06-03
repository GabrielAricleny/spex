<?php

namespace App\servicos;

use App\Modelos\StatusPergunta;

class StatusPerguntaServico
{
    public function listarTodos()
    {
        return StatusPergunta::todos();
    }

    public function buscarPorId($id)
    {
        return StatusPergunta::buscarPorId($id);
    }

    public function criar($dados)
    {
        $item = new StatusPergunta();
        $item->nome = $dados['nome'] ?? '';
        return $item->salvar();
    }

    public function atualizar($id, $dados)
    {
        $item = StatusPergunta::buscarPorId($id);
        if (!$item) return false;
        $item->nome = $dados['nome'] ?? $item->nome;
        return $item->salvar();
    }

    public function deletar($id)
    {
        $item = StatusPergunta::buscarPorId($id);
        if ($item) return $item->deletar();
        return false;
    }
}