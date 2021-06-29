<?php

namespace Litecms\Chatbox\Repositories\Presenter;

use Litepie\Repository\Presenter\FractalPresenter;

class ChatboxListPresenter extends FractalPresenter
{

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ChatboxListTransformer();
    }
}
