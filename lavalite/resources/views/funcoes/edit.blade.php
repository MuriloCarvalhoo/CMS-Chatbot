<div class="profile-status-wrap">
    <div class="row align-items-center">
        <div class="col-md-4">
            <h2>Funcões</h2>
        </div>
        <div class="col-md-4">
        </div>

        <!--Pagina usuario editar uma funcao-->   

    </div>
    <hr class="mt-20">
</div>
<div class="row pl-15 pr-15 pb-30">

    <div class="row g-0">

        <div class="col-sm-6 col-md-8 border border-black-600 text-center">
            
            <h3>Edite a função: </h3>
            <hr class="mt-20">
    

        <form action="{{ route('funcoes.update', $funcoes->id) }}" method="post">
            @csrf
            <label for="nome">Edite a função: </label>
            <input type="text" name="nome" value="{{ $funcoes->nome }}">

            <label for="nome">Tipo: </label>
            <input type="text" name="tipo" value="{{ $funcoes->tipo }}">

            <hr class="mt-20">


            <label for="nome">Nome: </label>
            <input type="text" name="nome" value="{{ $funcoes->nome }}">


            <label for="nome">Parte 1 funcão: </label>
            <input type="text" name="func_1"  value="{{ $funcoes->func_1 }}">

            <hr class="mt-20">

            <label for="nome">Nome da função: </label>
            <input type="text" name="nome_func" value="{{ $funcoes->nome_func }}">


            <label for="nome">Parte 2 funcão: </label>
            <input type="text" name="func_2" value="{{ $funcoes->func_2 }}">

            <hr class="mt-20">

            <label for="nome">Parte 3 funcão: </label>
            <input type="text" name="func_3" value="{{ $funcoes->func_3 }}">


            <label for="nome">Parte 4 funcão: </label>
            <input type="text" name="func_4" value="{{ $funcoes->func_4 }}">

            <hr class="mt-20">

            <label for="nome">Nome da proxima função: </label>
            <input type="text" name="nome_prox" value="{{ $funcoes->nome_prox }}">


            <label for="nome">Parte 5 funcão: </label>
            <input type="text" name="func_5" value="{{ $funcoes->func_5 }}">

            <hr class="mt-20">



            <input type="submit" class="p-2 m-4 bg-grey-500  font-semibold rounded-lg shadow-md hover:bg-grey-900 focus:outline-none focus:ring-2 focus:ring-grey-400 focus:ring-opacity-75">
        </form>

        @if ( isset($errors) && count($errors) > 0)
        <div class="p-2 m-2 text-red-600 text-lg">
       
           @foreach ($errors->all() as $error)
               <p>{{ $error }}</p>
           @endforeach
       
       </div>                        
       @endif



    </div>


    <div class="row g-0">
        
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <button class="p-2 m-4 bg-grey-500  font-semibold rounded-lg shadow-md hover:bg-grey-900 focus:outline-none focus:ring-2 focus:ring-grey-400 focus:ring-opacity-75">
        <a href="{{ route('funcoes.index') }}" class="bg-grey-500 font-semibold rounded-lg shadow-md hover:bg-grey-900 focus:outline-none focus:ring-2 focus:ring-grey-400 focus:ring-opacity-75">Voltar</a>
        </button> 
    </div>

      
</div>
