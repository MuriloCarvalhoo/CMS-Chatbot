<?php

namespace Litecms\Chatbox\Policies;

use Litepie\User\Contracts\UserPolicy as User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Litecms\Chatbox\Models\Chatbox;

class ChatboxPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can view the Chatbox.
     *
     * @param User $user
     * @param Chatbox $chatbox
     *
     * @return bool
     */
    public function view(User $user, Chatbox $chatbox)
    {
        if ($user->canDo('chatbox.chatbox.view')) {
            return true;
        }

        return $user->id == $chatbox->user_id;
    }

    /**
     * Determine if the given user can create a chatbox.
     *
     * @param User $user
     * @param Chatbox $chatbox
     *
     * @return bool
     */
    public function create(User $user)
    {
        return $user->canDo('chatbox.chatbox.create');
    }

    /**
     * Determine if the given user can update the given chatbox.
     *
     * @param User $user
     * @param Chatbox $chatbox
     *
     * @return bool
     */
    public function update(User $user, Chatbox $chatbox)
    {

        if ($user->canDo('chatbox.chatbox.update')) {
            return true;
        }

        return $user->id == $chatbox->user_id;
    }

    /**
     * Determine if the given user can delete the given chatbox.
     *
     * @param User $user
     * @param Chatbox $chatbox
     *
     * @return bool
     */
    public function destroy(User $user, Chatbox $chatbox)
    {

        if ($user->canDo('chatbox.chatbox.delete')) {
            return true;
        }

        return $user->id == $chatbox->user_id;
    }

    /**
     * Determine if the user can perform a given action ve.
     *
     * @param [type] $user    [description]
     * @param [type] $ability [description]
     *
     * @return [type] [description]
     */
    public function before($user, $ability)
    {

        if ($user->isSuperuser()) {
            return true;
        }

    }

}
