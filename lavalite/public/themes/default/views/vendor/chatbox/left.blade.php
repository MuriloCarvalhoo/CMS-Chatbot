@include('chatbox::public.partials.header')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="container">
                @include('chatbox::public.partials.left')
            </div>
        </div>
        <div class="col-md-9">
            {!!$chatbox->content!!}
        </div>
    </div>
</div>