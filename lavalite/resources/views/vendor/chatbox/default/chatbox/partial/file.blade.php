<div class="app-entry-form-section" id="file">
    <div class="section-title">Arquivos</div>
    <div class="row">
        @if ($mode == 'create')

            <div class="form-group">
                <label for="file" class="control-label col-lg-12 col-sm-12 text-left">
                    Enviar arquivo...
                </label>

                <div class='col-12'>
                    {!!$data -> files('file')
                        -> url($data -> getUploadUrl('file'))
                        -> uploader()!!}
                </div>            
            </div>

        @elseif ($mode == 'edit')

        <div class="form-group">
            <label for="file" class="control-label col-lg-12 col-sm-12 text-left">
                {{ trans('chatbox::chatbox.label.file') }}
            </label>

            <div class='col-12'>
                {!!$data -> files('file')
                    -> url($data -> getUploadUrl('file'))
                    -> uploader()!!}
            </div>            
        </div>

        @elseif ($mode == 'show')

        <div class='col-12'>
            {!!$data -> files('file')!!}
        </div>

        @endif

    </div>

    {!!Form::hidden('file') !!}

    </div>
</div>
