<div class="row mt-5">
    <div class="offset-53">
        <a href="{{ route('nextturn') }}" class="btn btn-warning">
            @if(Route::currentRouteName() === 'startgame')
            Start game
            @else
            Next turn
            @endif
        </a>
    </div>
</div>

<div class="row my-4">
    <div class="offset-525">
        <a href="{{ route('startgame') }}" class="btn btn-danger">New game</a>
    </div>
</div>