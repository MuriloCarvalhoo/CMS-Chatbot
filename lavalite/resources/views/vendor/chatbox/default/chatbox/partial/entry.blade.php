<div class="container-fluid">
    <div class="row">
        <div class="col-9">
            <div class="app-entry-form-section" id="basic">
                <div class="section-title">Conversa Chatbox</div>
                <div class="row">
                    @php
                    $include = @include('chatbox::chatbox.partial.entry')    
                    @endphp
                    <div class="col-12">
                        {!! Form::text('conversa')
                        -> label('Nome da conversa')
                        -> required()
                        -> placeholder('Digite um nome para conversa')
                        !!}
                    </div>
                    
                    <div class="col-12 ">
                        <button class="btn btn-success btn-sm" type="button" id="addFunc">Add Funcao</button>
                    </div>
                    <div class="col-12 ">
                        <button class="btn btn-danger btn-sm" type="button" id="addFile">Add File</button>
                    </div>

                </div>
            </div>    
            <div class="showFunc" id="showFunc"></div>
        </div>
    </div>
</div>
<br />
<br />
<br />

