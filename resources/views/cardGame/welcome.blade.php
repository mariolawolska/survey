@extends('cardGame.layouts.app')

@section('content')
<ul class="nobullet">
    <li>This is a two player simulation card game</li>
    <li>The game starts with a deck of cards</li>
    <li>The cards are dealt out to both players</li>
</ul>

<div class="my-5 pb-4">
    <a href="{{ route('startgame') }}" class="btn btn-warning">Start game</a>
</div>
@endsection