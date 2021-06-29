<div class="profile-status-wrap">
    <div class="row align-items-center">
        <div class="col-md-4">
            <h2>Conversas</h2>
        </div>
        <div class="col-md-4">
        </div>

        <!--Pagina usuario editar uma Conversa-->   

    </div>

    <hr class="mt-20">
    
</div>
<div class="row pl-15 pr-15 pb-30">

    <div class="row g-0">

        <div class="col-sm-6 col-md-8 border border-black-600 text-center">
            
            <h3>Edite a conversa: </h3>
            <hr class="mt-20">
    

        <form action="{{ route('conversas.update', $conversas->id) }}" method="post">
            @csrf

            <label for="nome_conversa" class="control-label">Nome da conversa: </label>
            <input type="text" name="nome_conversa" placeholder="{{ $conversas->nome_conversa }}" value="{{ $conversas->nome_conversa }}" class="form-control">

            <hr class="mt-20">

            <label for="nome" class="control-label">Selecione a função: </label>
            <select name="nome" id="" class="form-control">
                <option value=""></option>    
                @foreach ($funcoes as $funcao )
                <option value="{{ $funcao->nome_func }}">{{ $funcao->nome_func }}</option>    
                @endforeach
            </select>

            <hr class="mt-20">

            <label for="pergunta" class="control-label">Selecione a Pergunta : </label>
            <select name="pergunta" id="" class="form-control">
                <option value=""></option>    
                @foreach ($perguntas as $pergunta)
                <option value="{{ $pergunta }}">{{ $pergunta }}</option>    
                @endforeach
            </select>


            <hr class="mt-20">

            <label for="resposta" class="control-label">Selecione a Resposta: </label>
            <select name="resposta" id="" class="form-control">
                <option value=""></option>    
                @foreach ($respostas as $resposta) 
                <option value="{{ $resposta }}">{{ $resposta }}</option>    
                @endforeach
            </select>

            <hr class="mt-20">

            <label for="nome_prox" class="control-label">Proxima pergunta: </label>
            <select name="nome_prox" id="nome_prox" class="form-control">
                <option value=""></option>    
                @foreach ($funcoes as $funcao) 
                <option value="{{ $funcao->nome_prox }}">{{ $funcao->nome_prox }}</option>    
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

    <hr class="mt-20">

    <div class="row pl-15 pr-15 pb-30">

        <div class="actions">
            <a href="{{ route('conversas.index') }}" class="p-2 m-4 bg-grey-500  btn btn-primary btn-sm">Voltar</a>
        </div>

    </div>
      
</div>
