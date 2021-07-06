<?php

return [

/*
 * Provider .
 */
    'provider' => 'litecms',

/*
 * Package .
 */
    'package' => 'chatbox',

/*
 * Modules .
 */
    'modules' => ['chatbox', 'category'],

/*
 * Views for the chatbox  .
 */
    'views' => ['default' => 'Default', 'left' => 'Left menu', 'right' => 'Right menu'],

// Modale variables for chatbox module.
    'chatbox' => [
        'model' => 'Litecms\Chatbox\Models\Chatbox',
        'table' => 'chatboxs',
        'primaryKey' => 'id',
        'hidden' => [],
        'visible' => [],
        'guarded' => ['*'],
        'dates' => ['deleted_at'],
        'fillable' => ['conversa', 'tipo', 'nome', 'ouvir', 'validar', 'pergunta', 'resposta', 'nome_prox', 'view', 'status', 'upload_folder'],
        'upload_folder' => '/chatbox/chatbox',
        'uploads' => [
            'file' => [
                'count' => 10,
                'type' => 'file',
            ],
        ],
        'encrypt' => ['id'],
        'revision' => ['conversa', 'nome'],
        'perChatbox' => '20',
        'search' => [

            'conversa' => 'like',
            'nome' => 'like',
        ],
    ],
];
