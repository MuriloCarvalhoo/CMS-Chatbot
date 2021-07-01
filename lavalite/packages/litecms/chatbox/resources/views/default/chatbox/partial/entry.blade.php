<div class="container-fluid">
    <div class="row">
        <div class="col-9">
            <div class="app-entry-form-section" id="basic">
                <div class="section-title">Conversa Chatbox</div>
                <div class="row">
                    <div class="col-12">
                        {!! Form::text('conversa')
                        -> label('Nome da conversa')
                        -> required()
                        -> placeholder('Digite um nome para conversa')
                        !!}
                    </div>
                    <div class="col-12">
                        {!! Form::select('tipo')
                        -> options(trans('chatbox::chatbox.options.tipo'))
                        -> label('chatbox::chatbox.label.tipo')
                        -> placeholder('chatbox::chatbox.placeholder.tipo')
                        !!}

                        {!! Form::text('nome')
                        -> label('Nome da função')
                        -> placeholder('Ex: "email"')
                        !!}

                        {!! Form::text('ouvir')
                        -> label('Ouvir: ')
                        -> placeholder('Ex: "Quero o meu extrato"')
                        !!}
                        {!! Form::select('validar')
                        -> options(trans('chatbox::chatbox.options.validar'))
                        -> label('chatbox::chatbox.label.validar')
                        -> placeholder('chatbox::chatbox.placeholder.validar')
                        !!}
                    </div>
                </div>
            </div>
            <div class="app-entry-form-section" id="file">
                <div class="section-title">Arquivos</div>
                <div class="row">
                    @if ($mode == 'create')
                    <div class="form-group">
                        <label for="file" class="control-label col-lg-12 col-sm-12 text-left">
                            Enviar arquivo...
                        </label>
                        <div class='col-12'>
                            {!! $data->files('file')
                            ->url($data->getUploadUrl('file'))
                            ->uploader()!!}
                        </div>
                    </div>
                    @elseif ($mode == 'edit')
                    <div class="form-group">
                        <label for="file" class="control-label col-lg-12 col-sm-12 text-left">
                            {{trans('chatbox::chatbox.label.file') }}
                        </label>
                        <div class='col-12'>
                            {!! $data->files('file')
                            ->url($data->getUploadUrl('file'))
                            ->uploader()!!}
                        </div>
                    </div>
                    @elseif ($mode == 'show')
                    <div class='col-12'>
                        {!! $data->files('banner') !!}
                    </div>
                    <div class='col-12'>
                        {!! $data->files('file') !!}
                    </div>
                    @endif
                </div>
                {!! Form::hidden('file') !!}
            </div>
        </div>
        <div class="col-md-3">
            <aside class="app-create-steps">
                <h5 class="steps-header">Passos</h5>
                <div class="steps-wrap" id="steps_nav">
                    <a class="step-item active" href="#basic"><span>1</span> Formulario</a>
                    <a class="step-item" href="#file"><span>2</span> Enviar arquivo</a>
                </div>
            </aside>
        </div>
    </div>
</div>
<br />
<br />
<br />