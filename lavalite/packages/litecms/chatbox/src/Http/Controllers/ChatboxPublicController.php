<?php

namespace Litecms\Chatbox\Http\Controllers;

use App\Http\Controllers\PublicController as BaseController;
use Litepie\Http\Controllers\ResourceController;


class ChatboxPublicController extends ResourceController
{
    /**
     * Constructor.
     *
     * @param type \Litecms\Chatbox\Interfaces\ChatboxInterface $chatbox
     *
     * @return type
     */
    public function __construct(\Litecms\Chatbox\Interfaces\ChatboxRepositoryInterface $chatbox)
    {
        parent::__construct();
        $this->model = $chatbox;
    }

    /**
     * Show Chatbox.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function getChatbox($slug)
    {
        // get Chatbox by slug
        $chatbox = $this->model->getChatbox($slug);

        if (is_null($chatbox)) {
            abort(404);
        }

        //Set theme variables
        $view = $chatbox->view;
        $view = view()->exists('chatbox::' . $view) ? $view : 'default';

        if ($chatbox->compile) {
            $chatbox->content = blade_compile($chatbox->content);
        }

        return $this->response
            ->setMetaKeyword(strip_tags($chatbox->meta_keyword))
            ->setMetaDescription(strip_tags($chatbox->meta_description))
            ->setMetaTitle(strip_tags($chatbox->meta_title))
            ->view('chatbox::' . $view)
            ->data(compact('chatbox'))
            ->output();

    }

}
