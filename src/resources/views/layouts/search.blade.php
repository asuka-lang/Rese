<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    @yield('css')
    @livewireStyles
    @yield('script')
</head>

<body>
    <header class="header">
        @livewireScripts
        @livewire('menu')
        <form class="search__form" action="/search" method="get">
            @csrf
            <div class="search__table">
                <div class="search-area">
                    <select class="area" name="area_id">
                        <option value="">All area</option>
                        @foreach($areas as $area)
                        <option value="{{ $area['id'] }}">{{ $area['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="search-genre">
                    <select class="genre" name="genre_id">
                        <option value="">All genre</option>
                        @foreach($genres as $genre)
                        <option value="{{ $genre['id'] }}">{{ $genre['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-text">
                    <button class="search-button" type="submit">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    </button>
                    <input class="search-text" type="search" name="keyword" placeholder="Search..." value="{{ old('keyword') }}" />
                </div>
            </div>
        </form>
    </header>
    <main class="main">
        @yield('content')
    </main>
</body>

</html>