<?php

namespace App\servicos;

use App\Modelos\ListaPerguntasExameUniversidade;

class ListaPerguntasExameUniversidadeServico
{
    public function listarTodos()
    {
        return ListaPerguntasExameUniversidade::todos();
    }

    public function buscarPorId($id)
    {
        return ListaPerguntasExameUniversidade::buscarPorId($id);
    }

    public function criar($dados)
    {
        $item = new ListaPerguntasExameUniversidade();
        $item->nome = $dados['nome'] ?? '';
        return $item->salvar();
    }

    public function atualizar($id, $dados)
    {
        $item = ListaPerguntasExameUniversidade::buscarPorId($id);
        if (!$item) return false;
        $item->nome = $dados['nome'] ?? $item->nome;
        return $item->salvar();
    }

    public function deletar($id)
    {
        $item = ListaPerguntasExameUniversidade::buscarPorId($id);
        if ($item) return $item->deletar();
        return false;
    }
}