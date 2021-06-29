<div class="profile-status-wrap">
    <div class="row align-items-center">
        <div class="col-md-4">
            <h2>Criar Classes</h2>
        </div>

        <!--Pagina usuario criar Classes-->   

    </div>


    <hr class="mt-20">
</div>

<div class="row pl-15 pr-15 pb-30 ">

    <div class="row">
        <div class=" p-2 m-4 border border-black-600 text-center">
            
            <h3>Crie uma classe para o Robo:</h3>

            <hr class="mt-20">


            <form action="{{ route('classes.store') }}" method="post" class="form-vertical ">
                @csrf

                <label for="parte_1" class="control-label">Texto da classe: </label>
                <input type="text" name="parte_1" placeholder="{{ $classes->parte_1 }}" value="{{ $classes->parte_1 }}" class="form-control">

                <hr class="mt-20">

                <label for="nome_classe" class="control-label">Selecione nome da classe: </label>
                <select name="nome_classe" id="" class="form-control">
                    @foreach ($conversas as $conversa )
                    <option value="{{ $conversa }}">{{ $conversa }}</option>    
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
            <a href="{{ route('classes.index') }}" class="p-2 m-4 bg-grey-500  btn btn-primary btn-sm">Voltar</a>
        </div>

    </div>
</div>
