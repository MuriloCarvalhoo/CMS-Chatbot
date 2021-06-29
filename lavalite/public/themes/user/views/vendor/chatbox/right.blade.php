@include('chatbox::public.partials.header')

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="container">
            {!!$chatbox->content!!}
            </div>
        </div>
        <div class="col-md-3">
        @include('chatbox::public.partials.left')
        </div>
    </div>
</div>