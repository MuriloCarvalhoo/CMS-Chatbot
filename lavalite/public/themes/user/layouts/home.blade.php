<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ Theme::getMetaTitle() }} - {{__('app.name')}}</title>
    <meta name="description" content="{{ Theme::getMetaDesctiption() }}">
    <meta name="keyword" content="{{ Theme::getMetaKeyword() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! Theme::asset()->styles() !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script> 

</head>

<body>
    <div class="site-wrapper">
        {!! Theme::partial('header') !!}
        {!! Theme::content() !!}
        {!! Theme::partial('footer') !!}
    </div>
</body>
{!! Theme::asset()->container('footer')->scripts() !!}

<script>
    var botmanWidget = {
        desktopHeight: 500,
        desktopWidth: 390,   
    };
</script>
    
<script  src="{{ asset('themes/user/assets/js/widget.js') }}"></script>


</html>