<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="homepage_ttl">
            <input class="rese-icon" type="image" src="{{ asset('img/icon.jpg') }}" alt="rese" width="50" height="50" />
            <h1 class="ttl-name">Rese</h1>
        </div>
    </header>
    <main class="main">
        @yield('content')
        @yield('script')
    </main>
</body>

</html>