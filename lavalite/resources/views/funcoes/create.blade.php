<div class="profile-status-wrap">
    <div class="row align-items-center">
        <div class="col-md-4">
            <h2>Funcoes</h2>
        </div>
        <div class="col-md-4">
        </div>

        <!--Pagina usuario criar Funcoes-->   

    </div>
    <hr class="mt-20">
</div>
<div class="row pl-15 pr-15 pb-30">
            
        <h3>Crie uma função para o Robo:</h3>

        <hr class="mt-20">


        <form action="{{ route('funcoes.store') }}" method="post"  class="form-group">
            @csrf


            <label for="nome" class="control-label">Tipo: </label>
            <input class="form-control" type="text" name="tipo" placeholder="{{ $funcoes->tipo }}" value="{{ old('tipo') }}">

            <hr class="mt-20">

            <label for="nome" class="control-label">Nome: </label>
            <input class="form-control" type="text" name="nome" placeholder="{{ $funcoes->nome }}" value="{{ old('nome') }}">

            <hr class="mt-20">

            <label class="control-label" for="nome">Parte 1 funcão: </label>
            <input class="form-control" type="text" name="func_1" placeholder="{{ $funcoes->func_1 }}" value="{{ old('func_1') }}">

            <hr class="mt-20">

            <label class="control-label" for="nome">Nome da função: </label>
            <input class="form-control" type="text" name="nome_func" placeholder="{{ $funcoes->nome_func }}" value="{{ old('nome_func') }}">

            <hr class="mt-20">

            <label class="control-label" for="nome">Parte 2 funcão: </label>
            <input class="form-control" type="text" name="func_2" placeholder="{{ $funcoes->func_2 }}" value="{{ old('func_2') }}">

            <hr class="mt-20">

            <label class="control-label" for="nome">Parte 3 funcão: </label>
            <input class="form-control" type="text" name="func_3" placeholder="{{ $funcoes->func_3 }}" value="{{ old('func_3') }}">

            <hr class="mt-20">

            <label class="control-label" for="nome">Parte 4 funcão: </label>
            <input class="form-control" type="text" name="func_4" placeholder="{{ $funcoes->func_4 }}" value="{{ old('func_4') }}">

            <hr class="mt-20">

            <label class="control-label" for="nome">Nome da proxima função: </label>
            <input class="form-control" type="text" name="nome_prox" placeholder="{{ $funcoes->nome_prox }}" value="{{ old('nome_prox') }}">

            <hr class="mt-20">

            <label class="control-label" for="nome">Parte 5 funcão: </label>
            <input class="form-control" type="text" name="func_5" placeholder="{{ $funcoes->func_5 }}" value="{{ old('func_5') }}">



            <input type="submit" class="p-2 m-4 bg-grey-500  font-semibold rounded-lg shadow-md hover:bg-grey-900 focus:outline-none focus:ring-2 focus:ring-grey-400 focus:ring-opacity-75">
        </form>

        @if ( isset($errors) && count($errors) > 0)
        <div class="p-2 m-2 text-red-600 text-lg">
       
           @foreach ($errors->all() as $error)
               <p>{{ $error }}</p>
           @endforeach
       
       </div>                        
       @endif

       <hr class="mt-20">

       <div class="actions">
           <a href="{{ URL::route('guard.home', ['guard' => 'user']) }}" class="btn btn-with-icon btn-link btn-outline ">Voltar</a>
       </div>
      
</div>
