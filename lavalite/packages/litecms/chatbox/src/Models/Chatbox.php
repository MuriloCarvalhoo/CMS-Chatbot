<?php

namespace Litecms\Chatbox\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Activities\Traits\LogsActivity;
use Litepie\Database\Model;
use Litepie\Database\Traits\Sluggable;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Trans\Traits\Translatable;

class Chatbox extends Model
{
    use Filer, SoftDeletes, Hashids, Sluggable, Translatable, LogsActivity;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'litecms.chatbox.chatbox';

    // /**
    //  * Set the chatboxs title and heading.
    //  *
    //  * @param  string  $value
    //  * @return void
    //  */
    public function setNameAttribute($value)
    {
        
        if (empty($this->attributes['conversa'])) {
            $this->attributes['conversa'] = $value;
        }

        if (empty($this->attributes['tipo'])) {
            $this->attributes['tipo'] = $value;
        }
        if (empty($this->attributes['nome'])) {
            $this->attributes['nome'] = $value;
        }
        if (empty($this->attributes['ouvir'])) {
            $this->attributes['ouvir'] = $value;
        }
        if (empty($this->attributes['validar'])) {
            $this->attributes['validar'] = $value;
        }
        if (empty($this->attributes['pergunta'])) {
            $this->attributes['pergunta'] = $value;
        }
        if (empty($this->attributes['resposta'])) {
            $this->attributes['resposta'] = $value;
        }
        if (empty($this->attributes['nome_prox'])) {
            $this->attributes['nome_prox'] = $value;
        }


    }

}
