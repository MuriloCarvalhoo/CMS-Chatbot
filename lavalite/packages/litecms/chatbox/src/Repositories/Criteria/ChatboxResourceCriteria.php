<?php

namespace Litecms\Chatbox\Repositories\Criteria;

use Litepie\Repository\Contracts\CriteriaInterface;
use Litepie\Repository\Contracts\RepositoryInterface;

class ChatboxResourceCriteria implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        return $model;
    }
}