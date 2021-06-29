<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>BotMan Studio</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('themes/user/assets/css/tinker.css') }}">

</head>
<body>
<div class="container">
    <div class="content" id="app">
        <botman-tinker api-endpoint="/botman"></botman-tinker>
    </div>
</div>

<script id="botmanWidget" src='{{ asset('js/app.js') }}'></script>

<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var CSRF_TOKEN = $('input[name="_token"]').val();

var form = new FormData();
form.append("driver", "web");
form.append("attachment", "file");
form.append("file", "");
form.append("_token", CSRF_TOKEN);

var settings = {
  "url": "/botman",
  "method": "POST",
  "timeout": 0,
  "processData": false,
  "mimeType": "multipart/form-data",
  "contentType": false,
  "data": form,
};

$.ajax(settings).done(function (response) {
  console.log(response);
});

</script>

</body>
</html>