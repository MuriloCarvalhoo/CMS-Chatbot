<div class="app-entry-form-wrap">
    <div class="app-sec-title app-sec-title-with-icon app-sec-title-with-action">
        <i class="lab la-product-hunt app-sec-title-icon"></i>
        <h2>{{__('Show')}} {!!$contact->name!!}</h2>
        <div class="actions">
            <button type="button" class="btn btn-with-icon btn-link  btn-outline" data-action='EDIT'
                data-load-to="#app-entry"
                data-url="{{guard_url('contact/contact')}}/{!!$contact->getRouteKey()!!}/edit"><i
                    class="las la-save"></i>{{__('Edit')}}</button>
            <button type="button" class="btn btn-with-icon btn-link  btn-outline" data-action='DELETE'
                data-load-to="#app-entry" data-list="#item-list"
                data-url="{{guard_url('contact/contact')}}/{!!$contact->getRouteKey()!!}"><i
                    class="las la-trash"></i>{{__('Delete')}}</button>

        </div>
    </div>
    {!!Form::vertical_open()
    ->id('contact-contact-show')
    ->method('PUT')
    ->files('true')
    ->action(guard_url('contact/contact'.$contact->getRouteKey()))!!}

    @include('contact::contact.partial.entry', ['mode' => 'show'])

    {!! Form::close() !!}
</div>