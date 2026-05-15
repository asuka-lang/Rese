<div>
    <div class="homepage_ttl">
        <button class="button" wire:click="openMenu()" type="button">
            <input class="rese-icon" type="image" src="{{ asset('img/icon.jpg') }}" alt="rese" width="50" height="50" />
        </button>
        <h1 class="ttl-name">Rese</h1>
    </div>
    @if($Menu)
    <div class="menu-page">
        <button class="close-icon" wire:click="closeMenu()" type="button">×</button>
        <nav class="nav">
            <ul class="nav__list">
                @if(str_contains($currentUrl,'/admin'))
                @if(Auth::guard('admin')->check())
                <li class="nav__item">
                    <a class="navigate" href="/admin/mail/user">Mail</a>
                </li>
                <li class="nav__item">
                    <a class="navigate" href="/admin/lists">Members</a>
                </li>
                <li class="nav__item">
                    <form class="logout-form" action="/admin/logout" method="get">
                        @csrf
                        <button type="submit" class="logout">
                            <span class="navigate">Logout</span>
                        </button>
                    </form>
                </li>
                @endif
                @elseif(str_contains($currentUrl,'/manager'))
                @if(Auth::guard('manager')->check())
                <li class="nav__item">
                    <a class="navigate" href="/manager/booking">BookingList</a>
                </li>
                <li class="nav__item">
                    <form class="logout-form" action="/manager/logout" method="get">
                        @csrf
                        <button type="submit" class="logout">
                            <span class="navigate">Logout</span>
                        </button>
                    </form>
                </li>
                @endif
                @else
                @if(Auth::guard('web')->check())
                <li class="nav__item">
                    <a class="navigate" href="/">Home</a>
                </li>
                <li class="nav__item">
                    <form class="logout-form" action="/logout" method="post">
                        @csrf
                        <button type="submit" class="logout">
                            <span class="navigate">Logout</span>
                        </button>
                    </form>
                </li>
                <li class="nav__item">
                    <a class="navigate" href="/mypage">Mypage</a>
                </li>
                @else
                <li class="nav__item">
                    <a class="navigate" href="/">Home</a>
                </li>
                <li class="nav__item">
                    <a class="navigate" href="/register">Registration</a>
                </li>
                <li class="nav__item">
                    <a class="navigate" href="/login">Login</a>
                </li>
                @endif
                @endif
            </ul>
        </nav>
    </div>
    @endif
</div>