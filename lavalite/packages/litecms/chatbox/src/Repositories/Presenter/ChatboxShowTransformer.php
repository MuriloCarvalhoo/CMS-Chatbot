<?php

namespace Litecms\Chatbox\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class ChatboxShowTransformer extends TransformerAbstract
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
            'file'  => $chatbox->file,
            'view' => 'chatbox',
            'status' => 'Show',
            'upload_folder' => $chatbox->upload_folder,
            'created_at' => $chatbox->created_at,
            'updated_at' => $chatbox->updated_at,
        ];
    }
}