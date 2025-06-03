<?php
namespace App\servicos;

use App\Modelos\PerguntaAcertadaExameSistema;

class PerguntaAcertadaExameSistemaServico
{
    public function listarTodos()
    {
        return PerguntaAcertadaExameSistema::todos();
    }

    public function buscarPorId($id)
    {
        return PerguntaAcertadaExameSistema::buscarPorId($id);
    }

    public function criar($dados)
    {
        $item = new PerguntaAcertadaExameSistema();
        $item->nome = $dados['nome'] ?? '';
        return $item->salvar();
    }

    public function atualizar($id, $dados)
    {
        $item = PerguntaAcertadaExameSistema::buscarPorId($id);
        if (!$item) return false;
        $item->nome = $dados['nome'] ?? $item->nome;
        return $item->salvar();
    }

    public function deletar($id)
    {
        $item = PerguntaAcertadaExameSistema::buscarPorId($id);
        if ($item) return $item->deletar();
        return false;
    }
}