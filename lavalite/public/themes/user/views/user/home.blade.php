    <div class="profile-status-wrap">
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="profile-name-info">
                    <p>Welcome</p>
                    <h2 class="profile-name">{{user()->name}}</h2>
                    <h4 class="designation">{{user()->designation}}</h4>
                </div>
            </div>
        </div>
        <hr class="mt-20">
    </div>
    <div class="row pl-15 pr-15 pb-30">
        <div class="col-md-9">
            <div class="todays-app-wrap">
                <div class="app-sec-title">
                    <h2>Chatbox</h2>
                </div>

                <div class="todays-app-wrap-inner">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="app-item">
                                <div class="app-title">
                                    <h4>Criar nova pergunta</h4>
                                    <span class="app-status-check"></span>
                                </div>
                                <a class="btn btn-theme" href="{{ route('perguntas.index') }}">Criar</a>                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="app-item">
                                <div class="app-title">
                                    <h4>Criar nova resposta</h4>
                                    <span class="app-status-check"></span>
                                </div>
                                <a class="btn btn-theme" href="{{ route('respostas.index') }}">Criar</a>                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="app-item">
                                <div class="app-title">
                                    <h4>Criar nova conversa</h4>
                                    <span class="app-status-check"></span>
                                </div>
                                <a class="btn btn-theme" href="{{ route('conversas.index') }}">Criar</a>                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="app-item">
                                <div class="app-title">
                                    <h4>Criar nova função</h4>
                                    <span class="app-status-check"></span>
                                </div>
                                <a class="btn btn-theme" href="{{ route('funcoes.index') }}">Criar</a>                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="app-item">
                                <div class="app-title">
                                    <h4>Criar classe</h4>
                                    <span class="app-status-check"></span>
                                </div>
                                <a class="btn btn-theme" href="{{ route('classes.index') }}">Criar</a>                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="app-item">
                                <div class="app-title">
                                    <h4>Criar Conversa dinamica</h4>
                                    <span class="app-status-check"></span>
                                </div>
                                <a class="btn btn-theme" href="{{ route('dinamica.index') }}">Criar</a>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
