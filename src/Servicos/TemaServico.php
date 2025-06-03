<?php

namespace App\servicos;

use App\Modelos\Tema;

class TemaServico
{
    public function listarTodos()
    {
        return Tema::todos();
    }

    public function buscarPorId($id)
    {
        return Tema::buscarPorId($id);
    }

    public function criar($dados)
    {
        $item = new Tema();
        $item->nome = $dados['nome'] ?? '';
        return $item->salvar();
    }

    public function atualizar($id, $dados)
    {
        $item = Tema::buscarPorId($id);
        if (!$item) return false;
        $item->nome = $dados['nome'] ?? $item->nome;
        return $item->salvar();
    }

    public function deletar($id)
    {
        $item = Tema::buscarPorId($id);
        if ($item) return $item->deletar();
        return false;
    }
}