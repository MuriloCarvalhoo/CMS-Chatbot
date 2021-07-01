<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="bi bi-chat-dots app-sec-title-icon"></i>
        <h2>{{__('Create')}} {{ trans('chatbox::chatbox.name') }}</h2>
        <div class="actions">
            <button type="button" class="btn btn-with-icon btn-link app-create btn-outline" 
                data-action='STORE'
                data-form="#form-create" 
                data-load-to="#app-entry" 
                data-list="#item-list">
                <i class="las la-save"></i>{{__('Create')}}
            </button>
        </div>
    </div>
    {!!Form::vertical_open()
    ->id('form-create')
    ->method('POST')
    ->files('true')
    ->action(guard_url('chatbox/chatbox'))!!}

    @include('chatbox::chatbox.partial.entry', ['mode' => 'create'])

    {!! Form::close() !!}
</div>