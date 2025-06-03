<?php

namespace App\servicos;

use App\Modelos\ListaPerguntasExameSistema;

class ListaPerguntasExameSistemaServico
{
    public function listarTodos()
    {
        return ListaPerguntasExameSistema::todos();
    }

    public function buscarPorId($id)
    {
        return ListaPerguntasExameSistema::buscarPorId($id);
    }

    public function criar($dados)
    {
        $item = new ListaPerguntasExameSistema();
        $item->nome = $dados['nome'] ?? '';
        return $item->salvar();
    }

    public function atualizar($id, $dados)
    {
        $item = ListaPerguntasExameSistema::buscarPorId($id);
        if (!$item) return false;
        $item->nome = $dados['nome'] ?? $item->nome;
        return $item->salvar();
    }

    public function deletar($id)
    {
        $item = ListaPerguntasExameSistema::buscarPorId($id);
        if ($item) return $item->deletar();
        return false;
    }
}