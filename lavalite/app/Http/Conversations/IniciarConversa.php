<?php

namespace App\Http\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use App\Models\SimulacaoEmprestimo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

class IniciarConversa extends Conversation
{

    public function askConversa()
    {

        $question = Question::create('Vamos falar sobre o que ?')
        ->fallback('Não posso conversar no momento')
        ->callbackId('Falar sobre:')
        ->addButtons([
            Button::create('Simulação de empréstimo')->value('emprestimo'),
            Button::create('Situação da proposta')->value('proposta'),
            Button::create('Extrato')->value('extrato'),
        ]);

        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue();
                $selectedValue = $answer->getText();

            }
        });
    }

    public function run()
    {
        $this->askConversa();
    }
}
