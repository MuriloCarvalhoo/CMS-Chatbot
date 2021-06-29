<div class="profile-status-wrap">
    <div class="row align-items-center">
        <div class="col-md-4">
            <h2>Perguntas</h2>
        </div>
        <div class="col-md-4">
        </div>

        <!--Pagina usuario criar pergunta-->   

    </div>

    <hr class="mt-20">

</div>

<div class="row pl-15 pr-15 pb-30">

    <div class="row pl-15 pr-15 pb-30">
        
        <form action="{{ route('perguntas.create') }}" method="get" class="flex-initial ">
                
            <button class="p-2 m-2 btn btn-link btn-outline">
              Cadastrar
            </button> 
          </form>

          @if (Session::has('succesfunçõess'))
          <div class="p-2 m-2 text-lg text-green-600">
            {{ Session::get('success') }}
          </div>

        @endif

    </div>

    <hr class="mt-20">

    <div class="row pl-15 pr-15 pb-30">

        @foreach ($perguntas as $pergunta)

            <div class="col-sm-6 col-md-6 border border-black-600">{{ $pergunta->pergunta }}</div>  

            <div class="col-sm-4 col-md-4 border border-black-600">

                <a href="{{ route('perguntas.edit', $pergunta->id) }}" class="btn btn-with-icon btn-link  btn-outline"><i class="las la-save"></i> {{__('Edit')}}</a>
                <a href="{{ route('perguntas.show', $pergunta->id) }}" class="btn btn-with-icon btn-link  btn-outline"><i class="las la-trash"></i> {{__('Delete')}}</a>

            </div>

            <hr class="mt-20">
        
        @endforeach

    </div>

    <hr class="mt-20">

    <div class="actions">
        <a href="{{ URL::route('guard.home', ['guard' => 'user']) }}" class="btn btn-with-icon btn-link btn-outline ">Voltar</a>
    </div>

      
</div>
