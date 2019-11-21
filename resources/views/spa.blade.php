<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div id="app">
        <editor-component :title="Sunwarul"></editor-component>
        <div class="input-group"></div>
        <div class="form-group"></div>
        {{-- <form action="{{ route('form.store') }}" method="POST">
        @csrf
        <input type="text" name="id">
        <editor-component></editor-component>
        <input type="submit">
        </form> --}}
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
