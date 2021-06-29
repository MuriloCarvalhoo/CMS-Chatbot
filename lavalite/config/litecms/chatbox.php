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
        'slugs' => ['slug' => 'name'],
        'dates' => ['deleted_at'],
        'fillable' => ['heading', 'meta_title', 'name', 'slug', 'order', 'view', 'compile', 'status', 'upload_folder', 'content', 'meta_keyword', 'meta_description', 'abstract'],
        'translatable' => ['name', 'heading', 'content', 'meta_title', 'meta_keyword', 'meta_description'],
        'upload_folder' => '/chatbox/chatbox',
        'uploads' => [
            'banner' => [
                'count' => 1,
                'type' => 'image',
            ],
            'images' => [
                'count' => 10,
                'type' => 'image',
            ],
        ],
        'casts' => [
            'banner' => 'array',
            'images' => 'array',
        ],
        'encrypt' => ['id'],
        'revision' => ['name', 'title'],
        'perChatbox' => '20',
        'search' => [

            'name' => 'like',
            'title' => 'like',
            'heading' => 'like',
            'slug' => 'like',
            'order' => 'like',
        ],
    ],
];
