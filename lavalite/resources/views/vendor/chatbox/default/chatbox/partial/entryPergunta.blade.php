<div class="container-fluid">
    <div class="row">
        <div class="col-9">
            <div class="app-entry-form-section" id="basic">
                <div class="section-title">Conversa Chatbox</div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="conversa" class="control-label">Nome da conversa</label>
                            <input type="text" id="conversa" name="conversa" class="form-control" required placeholder="Digite um nome para conversa" value="{{ $data->conversa}}">
                        </div>
                    </div> 
                    
                    <!--escolher o tipo de pergunta-->
                    <div class="btn-group">
                        <select id="tipoPergunta" class="btn m-1">
                            <option value="nada">Nenhum</option>
                            <option value="desabilitado">Desabilitado</option>
                            <option value="perguntaUnica">Pergunta</option>
                            <option value="respostaUnica">Resposta</option>
                            <option value="anexo">Anexo</option>
                            <option value="imagem">Imagem</option>
                        </select>
                    </div>                    
                </div>
            </div>    
            <div class="showFunc" id="showFunc"></div>

            <div class="app-entry-form-section m-2" id="meta">
                <div class="row">
                   <div class="col-auto">
                      <div class="form-group"><label for="tipo[]" class="control-label">Tipo</label><input type="hidden" name="tipo[]" id="tipo" value="Pergunta"><input type="text" class="form-control" disabled="true" value="Pergunta"></div>
                      <div class="form-group"><label for="nome[]" class="control-label">Nome da função</label><input type="text" class="form-control"  name="nome[]" id="nome" placeholder="Ex: 'email'" value="{{ $data->nome }}" ></div>
                   </div>
                   <div class="col-auto">
                      <div class="form-group"><label for="ouvir[]" class="control-label">Ouvir:</label><input type="hidden" name="ouvir[]" id="ouvir" value=""><input type="text" class="form-control" disabled="true" placeholder="Ex: 'Quero o meu extrato'"></div>
                      <div class="form-group">
                         <label for="validar[]" class="control-label">Validação</label>
                         <select type="text" class="form-control"  name="validar[]" id="validar">
                             @if ($data->validar)
                             <option value="{{ $data->validar }}" selected>{{ $data->validar }}</option>     
                             @endif
                            <option value="naovalidar">Não Validar</option>
                            <option value="cpf">CPF</option>
                            <option value="email">E-mail</option>
                            <option value="celular">Celular</option>
                         </select>
                      </div>
                   </div>
                   <div class="col-auto">
                      <div class="form-group"><label for="pergunta[]" class="control-label">Pergunta:</label><input type="text" class="form-control"  name="pergunta[]" id="pergunta" placeholder="Ex: 'Qual o seu email ? '" value="{{ $data->pergunta }}" ></div>
                      <div class="form-group"><label for="resposta[]" class="control-label">Resposta:</label><input type="text" class="form-control"  name="resposta[]" id="resposta" placeholder="Ex: 'Seu e-mail é '" value="{{ $data->resposta }}" ></div>
                   </div>
                   <div class="col-auto">
                      <div class="form-group"><label for="nome_prox[]" class="control-label">Nome da proxima função:</label><input type="text" class="form-control"  name="nome_prox[]" id="nome_prox" placeholder="Ex: 'cpf'" value="{{ $data->prox_func }}" ></div>
                   </div>
                </div>
             </div>
             

            
        </div>
        <div class="app-entry-form-section m-2" id="file">
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
        
            {!!Form::hidden('upload_folder') !!}
        
            </div>
        </div>
        
    </div>
</div>
<br />
<br />
<br />

