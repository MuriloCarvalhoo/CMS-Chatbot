<div class="profile-status-wrap">
    <div class="row align-items-center">
        <div class="col-md-4">
            <h2>Perguntas</h2>
        </div>
        <div class="col-md-4">
        </div>

        <!--Pagina usuario editar uma pergunta-->   

    </div>
    <hr class="mt-20">
</div>
<div class="row pl-15 pr-15 pb-30">

    <div class="row g-0">

        <form action="{{ route('perguntas.update', $perguntas->id) }}" method="post">
            @csrf
            <label for="nome">Edite a pergunta: </label>
            <input type="text" name="pergunta" value="{{ $perguntas->nome }}">
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
        <a href="{{ route('perguntas.index') }}" class="bg-grey-500 font-semibold rounded-lg shadow-md hover:bg-grey-900 focus:outline-none focus:ring-2 focus:ring-grey-400 focus:ring-opacity-75">Voltar</a>
        </button> 
    </div>

      
</div>
