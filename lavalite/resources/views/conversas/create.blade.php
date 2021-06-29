<div class="profile-status-wrap">
    <div class="row align-items-center">
        <div class="col-md-4">
            <h2>Conversas</h2>
        </div>

        <!--Pagina usuario criar Conversas-->   

    </div>


    <hr class="mt-20">
</div>

<div class="row pl-15 pr-15 pb-30 ">

    <div class="row">
        <div class=" p-2 m-4 border border-black-600 text-center">
            
            <h3>Crie uma Conversa para o Robo:</h3>

            <hr class="mt-20">


            <form action="{{ route('conversas.store') }}" method="post" class="form-vertical ">
                @csrf

                <label for="nome_conversa" class="control-label">Nome da conversa: </label>
                <input type="text" name="nome_conversa" placeholder="{{ $conversas->nome_conversa }}" value="{{ old('nome_conversa') }} " class="form-control">

                <hr class="mt-20">

                <label for="ordem" class="control-label">Ordem: </label>
                <input type="text" name="ordem" placeholder="{{ $conversas->ordem }}" value="{{ old('ordem') }}" class="form-control">
                
                <hr class="mt-20">

                <label for="nome" class="control-label">Selecione a função: </label>
                <select name="nome" id="" class="form-control">
                    @foreach ($funcoes as $funcao )
                    <option value="{{ $funcao }}">{{ $funcao }}</option>    
                    @endforeach
                </select>

                <hr class="mt-20">

                <label for="pergunta" class="control-label">Selecione a Pergunta : </label>
                <select name="pergunta" id="" class="form-control">
                    @foreach ($perguntas as $pergunta)
                    <option value="{{ $pergunta }}">{{ $pergunta }}</option>    
                    @endforeach
                </select>


                <hr class="mt-20">

                <label for="resposta" class="control-label">Selecione a Resposta: </label>
                <select name="resposta" id="" class="form-control">
                    @foreach ($respostas as $resposta) 
                    <option value="{{ $resposta }}">{{ $resposta }}</option>    
                    @endforeach
                </select>


                <hr class="mt-20">

                <input type="submit" class="p-2 m-4 bg-grey-500  btn btn-primary btn-sm">
            </form>

            @if ( isset($errors) && count($errors) > 0)
                <div class="p-2 m-2 text-red-600 text-lg">
            
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

        </div>                        

    </div>  

    <hr class="mt-20">

    <div class="row pl-15 pr-15 pb-30">

        <div class="actions">
            <a href="{{ route('conversas.index') }}" class="p-2 m-4 bg-grey-500  btn btn-primary btn-sm">Voltar</a>
        </div>

    </div>
</div>
