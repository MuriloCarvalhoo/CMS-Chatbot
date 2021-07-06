<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Http\Conversations\teste;
use App\Http\Conversations\OnboardingConversation;
use App\Http\Conversations\IniciarConversa;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Messages\Attachments\File;
use BotMan\BotMan\Messages\Attachments\Audio;
use BotMan\BotMan\Cache\LaravelCache;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

class BotManController extends Controller
{
    
    public function handle()
    {
        
        //Driver
        $botman = app('botman');

        //Iniciar conversas
        $botman->hears('conversar', function (BotMan $bot) {
            $bot->startConversation(new IniciarConversa());
        });

        //Conversas criadas
        $botman->hears('s', function (BotMan $bot) {
            $bot->startConversation(new OnboardingConversation());
        });

        //Testes        
        $botman->hears('q', function (BotMan $bot) {
            // Create attachment
            $attachment = new Image('https://botman.io/img/logo.png', [
                'custom_payload' => true,
            ]);

            // Build message object
            $message = OutgoingMessage::create('This is my text')
                        ->withAttachment($attachment);
        
            // Reply message object
            $bot->reply($message);
        });

        $botman->hears('w', function (BotMan $bot) {
            // Create attachment
            $attachment = new File('https://americalatina.dint.fgv.br/sites/americalatina.dint.fgv.br/files/teste33.pdf', [
                'custom_payload' => true,
            ]);

            // Build message object
            $message = OutgoingMessage::create('Arquivo')
                        ->withAttachment($attachment);
        
            // Reply message object
            $bot->reply($message);
        });

        $botman->hears('stop', function(BotMan $bot) {
            $bot->reply('stopped');
        })->stopsConversation();
        
        $botman->hears('pause', function(BotMan $bot) {
            $bot->reply('stopped');
        })->skipsConversation();
        
        $botman->listen();
    }

    public function tinker()
    {
        return view('botman-web::chat');
    }

}