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
            'slug' => $chatbox->slug,
            'url' => $chatbox->slug.'.html',
            'name'   => $chatbox->name,
            'heading'   => $chatbox->heading,
            'title'   => $chatbox->title,
            'keyword'   => $chatbox->keyword,
            'description'   => $chatbox->description,
            'content' => $chatbox->content,
            'abstract' => $chatbox->abstract,
            'banner' => $chatbox->banner,
            'images' => $chatbox->images,
            'view' => $chatbox->view,
            'compiler' => $chatbox->compiler,
            'status' => $chatbox->status,
            'upload_folder' => $chatbox->upload_folder,
            'order' => $chatbox->order,
            'created_at' => $chatbox->created_at,
            'updated_at' => $chatbox->updated_at,
        ];
    }
}