<div class="profile-status-wrap">
    <div class="row align-items-center">
        <div class="col-md-4">
            <h2>Criar dinamica</h2>
        </div>

        <!--Pagina usuario criar dinamica-->   

    </div>


    <hr class="mt-20">
</div>

<div class="row pl-15 pr-15 pb-30 ">

    <div>
        <div class=" p-2 m-4 border border-black-600 text-center">
            
            <h3>Crie uma conversa dinamica:</h3>

            <hr class="mt-20">


            <form action="" method="post" class="form-vertical">
                @csrf

                

            </form>


            <form action="{{ route('dinamica.store') }}" method="post" class="form-vertical ">
                @csrf

                <label for="parte_1" class="control-label">Nome da conversa: </label>
                <input type="text" name="parte_1" placeholder="usar somente letras" value="" class="form-control">

                <hr class="mt-20">

                <table class="table table-sm table-bordered" >
                    <thead>
                        <tr>
                            <th> Tipo </th>
                            <th> Nome </th>
                            <th> Ouvir </th>
                            <th> Validação </th>
                            <th> Pergunta </th>
                            <th> Resposta </th>
                            <th> Nome do próximo </th>
                            <th> Enviar arquivo </th>

                        </tr>
                    </thead>
                
                    <tbody id="addRow" class="addRow">
                        <!--Pergunta com Anexo-->
                        <tr>
                            <td>
                               <div class="form-control"> Pergunta c/ Anexo </div>
                            <td>
                                <input type="text" name="nome_fun[]" value="" placeholder="Nome da funcao" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="ouvir[]" value="" placeholder="Palavra para iniciar funcao" class="form-control">
                            </td>
                            <td>
                                <select name="validacao" id="" class="form-control form-select-sm">
                                    <option value="">Não validar</option>
                                    <option value="">CPF</option>
                                    <option value="">Email</option>    
                                    <option value="">Celular</option>    
                                </select>
                            </td>
                            <td>
                                <input type="text" name="pergunta[]" value="" placeholder="Texto pergunta" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="resposta[]" value="" placeholder="Texto resposta" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="nome_prox[]" value="" placeholder="Nome da proxima funcao" class="form-control">
                            </td>
                            <td >
                                <input type="file" name="arquivo[]" value="" placeholder="Arquivo para enviar" class="form-control p-1">
                            </td>
                        </tr>

                        <!--Resposta sem anexo-->
                        <tr>
                            <td>
                            <div class="form-control"> Resposta s/ Aenxo </div>
                            <td>
                                <input type="text" name="nome_fun[]" value="" placeholder="Nome da funcao" class="form-control">
                            </td>
                            <td>
                                <input disabled type="text" name="ouvir[]" value="" placeholder="Palavra para iniciar funcao" class="form-control">
                            </td>
                            <td>
                                <select name="validacao" id="" class="form-control form-select-sm">
                                    <option value="">Não validar</option>
                                    <option value="">CPF</option>
                                    <option value="">Email</option>
                                    <option value="">Celular</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="pergunta[]" value="" placeholder="Texto pergunta" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="resposta[]" value="" placeholder="Texto resposta" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="nome_prox[]" value="" placeholder="Nome da proxima funcao" class="form-control">
                            </td>
                            <td >
                                <input disabled type="file" name="arquivo[]" value="" placeholder="Arquivo para enviar" class="form-control p-1">
                            </td>
                        </tr>
                    

                    </tbody>
                </table>
                
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
            <a href="{{ route('dinamica.index') }}" class="p-2 m-4 bg-grey-500  btn btn-primary btn-sm">Voltar</a>
        </div>

    </div>
</div>
