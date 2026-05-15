@extends('layouts.search')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('script')
<script src="https://kit.fontawesome.com/6ab37a39bf.js" crossorigin="anonymous"></script>
@endsection

@section('content')
<div class="shop_all__content">
    @foreach($shops as $shop)
    <div class="shop">
        <img class="shop__img" src="{{ asset('storage/shop-img/'.$shop['image']) }}" alt="画像" />
        <div class="shop__text">
            <h2 class="shop__title">{{ $shop['title'] }}</h2>
            <span class="shop__area">#{{ $shop['area']['name'] }}</span>
            <span class="shop__genre">#{{ $shop['genre']['name'] }}</span>
            <div class="buttons">
                <form class="detail-form" action="/detail/{shop_id}" method="get">
                    @csrf
                    <input type="hidden" name="id" value="{{ $shop['id'] }}" />
                    <button class="detail__btn" type="submit">詳しく見る</button>
                </form>
                @auth
                @if($shop->favorite->where('user_id',$userId)->count() > 0)
                @foreach($shop->favorite->where('user_id',$userId) as $like)
                <form class="delete-form" action="{{ route('delete',$shop) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="id" value="{{ $like->id }}" />
                    <button class="favorite__btn" type="submit">
                        <i class="fa-solid fa-heart fa-2x" style="color: rgb(229,75,76);"></i>
                    </button>
                </form>
                @endforeach
                @else
                <form class="like-form" action="{{ route('favorite',$shop) }}" method="post">
                    @csrf
                    <button class="favorite__btn" type="submit">
                        <i class="fa-solid fa-heart fa-2x" style="color: #e8eaed;"></i>
                    </button>
                </form>
                @endif
                @endauth
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

</html>