@extends('layouts.app')

@section('content')  
@if (session()->has('player1') && session()->has('player2'))
<div class="row">
    <!-- Player 1 -->
    <div class="col-sm-6">
        <h1 class="headerFont">Player 1</h1>
        <h4>Score: {{ session()->get('player1_score')}}</h4>
        <div class="card cardColor">
            @if (count($player1_card) > 1)
            <div class="card-header text-left">
                {{ $player1_card[0] . '  ' . $player1_card[1]}}
            </div>
            <div class="card-body d-flex justify-content-center align-items-center middlecard">
                {{ $player1_card[1] }}
            </div>
            <div class="card-footer text-right">
                {{ $player1_card[0] . '  ' . $player1_card[1]}}
            </div>
            @endif
        </div>
    </div>

    <!-- Player 2 -->
    <div class="col-sm-5">
        <h1 class="headerFont">Player 2</h1>
        <h4>Score: {{ session()->get('player2_score')}}</h4>
        <div class="card cardColor">
            @if (count($player2_card) > 1)
            <div class="card-header text-left">
                {{ $player2_card[0] . '  ' . $player2_card[1]}}
            </div>
            <div class="card-body d-flex justify-content-center align-items-center middlecard">
                {{ $player2_card[1] }}
            </div>
            <div class="card-footer text-right">
                {{ $player2_card[0] . '  ' . $player2_card[1]}}
            </div>
            @endif
        </div>
    </div>
</div>

@include('cardGame.games.footerButton')
@endif
@endsection