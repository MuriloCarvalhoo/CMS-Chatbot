<?php

namespace Litecms\Chatbox;

use View;

/**
 *
 */
class Chatbox
{
    // Chatbox modal
    protected $model;

    /**
     * Initialize Chatbox facade.
     *
     * @param type \Litecms\Chatbox\Interfaces\ChatboxRepositoryInterface $chatbox
     *
     * @return none
     */
    public function __construct(\Litecms\Chatbox\Interfaces\ChatboxRepositoryInterface $chatbox)
    {
        $this->model = $chatbox;
    }

    /**
     * Calls chatbox repository function.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->model->$name($arguments[0]);
    }

    /**
     * @param int $perchatbox
     *
     * @return mixed
     */
    public function gadget($perchatbox = 10)
    {
        $data['chatbox'] = $this->model->paginate($perchatbox);

        return View::make('chatbox::admin.chatbox.gadget', $data);
    }

    /**
     * Return return field value of a chatbox.
     *
     * @param mixed  $idslug
     * @param string $field
     *
     * @return string
     */
    public function chatboxs($idslug, $field)
    {
        $chatbox = $this->model->getChatbox($idslug);

        return $chatbox[$field];
    }

    /**
     * Returns chatbox object.
     *
     * @param mixed  $idslug
     * @param string $field
     *
     * @return mixed
     */
    public function chatbox($idslug)
    {
        return  $this->model->getChatbox($idslug);
    }

    /**
     * Returns count of chatbox.
     *
     * @param array $filter
     *
     * @return int
     */
    public function count(array $filters = null)
    {
        return  $this->model->count();
    }
}
