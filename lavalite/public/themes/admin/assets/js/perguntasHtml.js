var formPergunta2 = 
<div class="app-entry-form-section" id="meta">
<div class="row">
    <div class="col-auto">

        {!!Form::text('tipo[]')
            -> label('Tipo')
            -> value('Pergunta')
            ->setAttribute('disabled', 'true')
        !!}

        {!!Form::text('nome[]')
            -> label('Nome da função')
            -> placeholder("Ex: 'email'")
        !!}            
    </div>
    <div class="col-auto">

        {!!Form::text('ouvir')
            ->label('Ouvir: ')
            ->placeholder("Ex: 'Quero o meu extrato'")
        !!}


        {!!Form::select('validar')
            -> options(['nv' => 'Não Validar', 'cpf' => 'CPF', 'email' => 'E-mail', 'celular' => 'Celular'])
            -> label('Validação')
        !!}

    </div>
    <div class="col-auto">

        {!!Form::text('pergunta')
            -> label('Pergunta: ')
            -> placeholder("Ex: 'Qual seu email'")
        !!}

        {!!Form::text('resposta')
            -> label('Resposta: ')
            -> placeholder("Ex: 'Seu e-mail é '")
        !!}            
    </div>
    <div class="col-auto">

        {!!Form::text('nome_prox')
            -> label('Nome da proxima funçao: ')
            -> placeholder("Ex: 'cpf'")
        !!}

    <div class="app-entry-form-section" id="file">
        <div class="section-title">Arquivos</div>
        <div class="row">
            @if ($mode == 'create')

                <div class="form-group">
                    <label for="file" class="control-label col-lg-12 col-sm-12 text-left">
                        Enviar arquivo...
                    </label>
    
                    <div class='col-12'>
                        {!!$data -> files('file')
                            -> url($data -> getUploadUrl('file'))
                            -> uploader()!!}
                    </div>            
                </div>

            @elseif ($mode == 'edit')

            <div class="form-group">
                <label for="file" class="control-label col-lg-12 col-sm-12 text-left">
                    {{ trans('chatbox::chatbox.label.file') }}
                </label>

                <div class='col-12'>
                    {!!$data -> files('file')
                        -> url($data -> getUploadUrl('file'))
                        -> uploader()!!}
                </div>            
            </div>

            @elseif ($mode == 'show')

            <div class='col-12'>
                {!!$data -> files('file')!!}
            </div>

            @endif

        </div>

        {!!Form::hidden('file') !!}

        </div>
    </div>
</div>
</div>
;


var formPergunta = '<!--isso nao vai existir-->'
'<div class="app-entry-form-section" id="meta">'
'<div class="row">'
'<div class="col-auto">'

"{!! Form::text('tipo[]')"
"-> label('Tipo')"
"-> value('Pergunta')"
"->setAttribute('disabled', 'true')"
"!!}"

"{!! Form::text('nome[]')"
"-> label('Nome da função')"
"-> placeholder('Ex: 'email'')"
"!!}"

"</div>"
'<div class="col-auto">'

"{!! Form::text('ouvir')"
"-> label('Ouvir: ')"
"-> placeholder('Ex: 'Quero o meu extrato'')"
'!!}'


"{!! Form::select('validar')"
"-> options(['nv' => 'Não Validar', 'cpf' => 'CPF', 'email' => 'E-mail', 'celular' => 'Celular'])"
"-> label('Validação')"
"!!}"

"</div>"
'<div class="col-auto">'

"{!! Form::text('pergunta')"
"-> label('Pergunta: ')"
"-> placeholder('Ex: 'Qual seu email'')"
"!!}"

"{!! Form::text('resposta')"
"-> label('Resposta: ')"
"-> placeholder('Ex: 'Seu e-mail é '')"
"!!}"

"</div>"
'<div class="col-auto">'

"{!! Form::text('nome_prox')"
"-> label('Nome da proxima funçao: ')"
"-> placeholder('Ex: 'cpf'')"
"!!}"

'<div class="app-entry-form-section" id="file">'
'<div class="section-title">Arquivos</div>'
'<div class="row">'
"@if ($mode == 'create')"

'<div class="form-group">'
'<label for="file" class="control-label col-lg-12 col-sm-12 text-left">'
'Enviar arquivo...'
'</label>'

"<div class='col-12'>"
"{!! $data->files('file')"
"->url($data->getUploadUrl('file'))"
'->uploader()!!}'
'</div>'

'</div>'

"@elseif ($mode == 'edit')"

'<div class="form-group">'
'<label for="file" class="control-label col-lg-12 col-sm-12 text-left">'
"{{trans('chatbox::chatbox.label.file') }}"
'</label>'

"<div class='col-12'>"
"{!! $data->files('file')"
"->url($data->getUploadUrl('file'))"
"->uploader()!!}"
"</div>"

'</div>'

"@elseif ($mode == 'show')"

"<div class='col-12'>"
"{!! $data->files('file') !!}"
"</div>"

"@endif"

'</div>'

"{!! Form::hidden('file') !!}"
'</div>'
'</div>'
"</div>"
"</div>"
"</div>";
