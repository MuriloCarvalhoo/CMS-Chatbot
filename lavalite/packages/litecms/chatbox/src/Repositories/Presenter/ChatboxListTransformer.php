<?php

namespace Litecms\Chatbox\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class ChatboxListTransformer extends TransformerAbstract
{
    public function transform(\Litecms\Chatbox\Models\Chatbox $chatbox)
    {
        return [
            'id'      => $chatbox->getRouteKey(),
            'slug'    => $chatbox->slug,
            'url'     => $chatbox->slug . '.html',
            'name'    => $chatbox->name,
            'heading' => $chatbox->heading,
            'title'   => $chatbox->title,
            'keyword' => $chatbox->keyword,
            'status'  => $chatbox->status,
            'category'  => $chatbox->category,
            'order'   => $chatbox->order,
        ];
    }
}
