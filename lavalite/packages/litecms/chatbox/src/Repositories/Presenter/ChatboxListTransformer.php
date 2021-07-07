<?php

namespace Litecms\Chatbox\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class ChatboxListTransformer extends TransformerAbstract
{
    public function transform(\Litecms\Chatbox\Models\Chatbox $chatbox)
    {
        return [
            'id'      => $chatbox->getRouteKey(),
            'conversa'    => $chatbox->conversa,
            'tipo'     => $chatbox->tipo,
            'nome'    => $chatbox->nome,
            'ouvir' => $chatbox->ouvir,
            'validar'   => $chatbox->validar,
            'pergunta' => $chatbox->pergunta,
            'resposta'  => $chatbox->resposta,
            'nome_prox'  => $chatbox->nome_prox,
        ];
    }
}
