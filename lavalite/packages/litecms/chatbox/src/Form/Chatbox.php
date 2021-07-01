<?php
namespace Litecms\Chatbox\Form;

class Chatbox
{
    /**
     * Variable to store form configuration.
     *
     * @var collection
     */
    protected $form;

    /**
     * Variable to store form configuration.
     *
     * @var collection
     */
    protected $element;

    /**
     * Initialize the form.
     *
     * @return null
     */
    public function __construct()
    {
        $this->setForm();
    }

    /**
     * Return form elements.
     *
     * @return array.
     */
    public function form($element = 'fields', $grouped = true)
    {
        $item = collect($this->form->get($element));
        if ($element == 'fields' && $grouped == true) {
            return $item->groupBy(['tab', 'section']);
        }
        return $item;

    }

    /**
     * Sets the form and form elements.
     * @return null.
     */
    public function setForm()
    {
        $this->form = collect([
            'form' => [
                'store' => ['a'],
                'update' => ['b'],
            ],
            'tabs' => [
                'main' => 'Main',
                'meta' => "Meta",
            ],
            'fields' => [
                'heading' => [
                    "type" => 'text',
                    "label" => "",
                    "alt" => "",
                    "label" => "",
                    "rules" => 'required|max:100',
                    "tab" => "main",
                    "section" => "first",
                    "class" => [
                        'wrapper' => "",
                        "label" => 'a',
                        "input" => 'b',

                    ],
                ],
                'conversa' => [
                    "type" => 'text',
                    "label" => "",
                    "alt" => "",
                    "label" => "",
                    "tab" => "main",
                    "section" => "first",
                    "class" => [
                        'wrapper' => "",
                        "label" => 'a',
                        "input" => 'b',
                    ],
                ],
                'nome' => [
                    "type" => 'text',
                    "label" => "",
                    "alt" => "",
                    "label" => "",
                    "tab" => "main",
                    "section" => "first",
                    "class" => [
                        'wrapper' => "",
                        "label" => 'a',
                        "input" => 'b',

                    ],
                ],
                'ouvir' => [
                    "type" => 'text',
                    "label" => "",
                    "alt" => "",
                    "label" => "",
                    "tab" => "main",
                    "section" => "first",
                    "class" => [
                        'wrapper' => "",
                        "label" => 'a',
                        "input" => 'b',

                    ],
                ],
                'pergunta' => [
                    "type" => 'text',
                    "label" => "",
                    "alt" => "",
                    "label" => "",
                    "tab" => "main",
                    "section" => "first",
                    "class" => [
                        'wrapper' => "",
                        "label" => 'a',
                        "input" => 'b',

                    ],
                ],
                'resposta' => [
                    "type" => 'text',
                    "label" => "",
                    "alt" => "",
                    "label" => "",
                    "tab" => "main",
                    "section" => "first",
                    "class" => [
                        'wrapper' => "",
                        "label" => 'a',
                        "input" => 'b',

                    ],
                ],
                'nome_prox' => [
                    "type" => 'text',
                    "label" => "",
                    "alt" => "",
                    "label" => "",
                    "tab" => "main",
                    "section" => "first",
                    "class" => [
                        'wrapper' => "",
                        "label" => 'a',
                        "input" => 'b',

                    ],
                ],
                'file' => [
                    "type" => 'text',
                    "label" => "",
                    "alt" => "",
                    "label" => "",
                    "tab" => "meta",
                    "section" => "first",
                    "class" => [
                        'wrapper' => "",
                        "label" => 'a',
                        "input" => 'b',

                    ],
                ],
                'content' => [
                    "type" => 'text',
                    "label" => "",
                    "alt" => "",
                    "label" => "",
                    "tab" => "main",
                    "section" => "second",
                    "class" => [
                        'wrapper' => "",
                        "label" => 'a',
                        "input" => 'b',

                    ],
                ],
                
                //Tipo select
                'tipo' => [
                    "type" => 'text',
                    "label" => "",
                    "alt" => "",
                    "label" => "",
                    "tab" => "meta",
                    "section" => "first",
                    "class" => [
                        'wrapper' => "",
                        "label" => 'a',
                        "input" => 'b',

                    ],
                ],
                
                //Tipo select
                'validar' => [
                    "type" => 'text',
                    "label" => "",
                    "alt" => "",
                    "label" => "",
                    "tab" => "meta",
                    "section" => "first",
                    "class" => [
                        'wrapper' => "",
                        "label" => 'a',
                        "input" => 'b',

                    ],
                ]
            ],
        ]
        );

    }
}
