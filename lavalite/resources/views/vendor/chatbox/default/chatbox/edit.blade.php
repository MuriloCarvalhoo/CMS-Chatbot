<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="lab la-product-hunt app-sec-title-icon"></i>
        <h2>{{__('Edit')}} {!!$data->conversa!!}</h2>
        <div class="actions">
            <button type="button" class="btn btn-with-icon btn-link  btn-outline" 
                data-action='UPDATE'
                data-form="#form-edit" 
                data-load-to="#app-entry" 
                data-list="#item-list">
                <i class="las la-save"></i>{{__('Save')}}
            </button>
            <button type="button" class="btn btn-with-icon btn-link  btn-outline"
                data-action='SHOW'
                data-load-to="#app-entry" 
                data-url="{{guard_url('chatbox/chatbox')}}/{!!$data->getRouteKey()!!}">
                <i class="las la-window-close"></i>{{__('Cancel')}}
            </button>
        </div>
    </div>

    {!!Form::vertical_open()
    ->method('PUT')
    ->id('form-edit')
    ->enctype('multipart/form-data')
    ->action(guard_url('chatbox/chatbox/'. $data->getRouteKey()))!!}

    @php
    $tipo = $data->tipo
    @endphp

    @if ($tipo == "Pergunta")

    @include('chatbox::chatbox.partial.entryPergunta', ['mode' => 'show'])

    @elseif ($tipo == "Resposta")

    @include('chatbox::chatbox.partial.entryResposta', ['mode' => 'show'])

    @elseif ($tipo == "Anexo")

    @include('chatbox::chatbox.partial.entryAnexo', ['mode' => 'edit'])

    @elseif ($tipo == "Imagem")

    @include('chatbox::chatbox.partial.entryImagem', ['mode' => 'edit'])

    @else 

    @include('chatbox::chatbox.partial.entry', ['mode' => 'show'])

    @endif

    {!!Form::close()!!}
</div>