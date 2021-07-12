<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="bi bi-chat-dots app-sec-title-icon"></i>
        <h2>{{__('Show')}} {!!$data->conversa!!}</h2>
        <div class="actions">
            <button type="button" class="btn btn-with-icon btn-link  btn-outline" data-action='EDIT'
                data-load-to="#app-entry" data-url="{{guard_url('chatbox/chatbox')}}/{!!$data->getRouteKey()!!}/edit"><i
                    class="las la-save"></i>{{__('Edit')}}</button>
            <button type="button" class="btn btn-with-icon btn-link  btn-outline" data-action='DELETE'
                data-load-to="#app-entry" data-list="#item-list"
                data-url="{{guard_url('chatbox/chatbox')}}/{!!$data->getRouteKey()!!}"><i
                    class="las la-trash"></i>{{__('Delete')}}</button>
        </div>
    </div>
    {!!Form::vertical_open()
    ->id('app-form-show')
    ->class('app-form-show')
    ->method('PUT')
    ->action(guard_url('chatbox/chatbox/'. $data->getRouteKey()))!!}

    @php
        $tipo = $data->tipo
    @endphp

    @if ($tipo == "Pergunta")

    @include('chatbox::chatbox.partial.entryPergunta', ['mode' => 'show'])

    @elseif ($tipo == "Resposta")

    @include('chatbox::chatbox.partial.entryResposta', ['mode' => 'show'])

    @elseif ($tipo == "Anexo")

    @include('chatbox::chatbox.partial.entryAnexo', ['mode' => 'show'])

    @elseif ($tipo == "Imagem")

    @include('chatbox::chatbox.partial.entryImagem', ['mode' => 'show'])

    @else 

    @include('chatbox::chatbox.partial.entry', ['mode' => 'show'])
        
    @endif

    {!!Form::close()!!}
</div>