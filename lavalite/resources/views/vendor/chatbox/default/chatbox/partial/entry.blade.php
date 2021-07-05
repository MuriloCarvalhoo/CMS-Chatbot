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
                    
                    <!--escolher o tipo de pergunta-->
                    <div class="btn-group">
                        <select id="tipoPergunta" class="btn m-1">
                            <option value="nada">Nenhum</option>
                            <option value="desabilitado">Desabilitado</option>
                            <option value="perguntaUnica">Pergunta</option>
                            <option value="respostaUnica">Resposta</option>
                        </select>
                    </div>                    
                                    
                    
                </div>
            </div>    
            <div class="showFunc" id="showFunc"></div>
            
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
<br />
<br />
<br />

