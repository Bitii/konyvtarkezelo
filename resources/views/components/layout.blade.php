<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>{{ env('APP_NAME') }}</title>
    @livewireStyles
</head>

<body>
    <div class="container">

        {{ $slot }}
    </div>
    @livewireScripts
</body>

</html>
