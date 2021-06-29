<?php

namespace Litecms\Chatbox\Repositories\Eloquent;

use Litecms\Chatbox\Interfaces\ChatboxRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class ChatboxRepository extends BaseRepository implements ChatboxRepositoryInterface
{

    /**
     * Booting the repository.
     *
     * @return null
     */
    public function boot()
    {
        $this->fieldSearchable = config('litecms.chatbox.chatbox.search');
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('litecms.chatbox.chatbox.model');
    }

    /**
     * Get chatbox by id or slug.
     *
     * @return void
     */
    public function getChatbox($var)
    {
        return $this->findBySlug($var);
    }
}
