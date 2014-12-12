<header class="header container">
    @if (Auth::check())
        <p> {{ 'Hello'.' '.Auth::user()->email }} </p>
    @else
        <p> {{ 'Hello'.' '.'Whoever you migh be ...' }} </p>
    @endif

</header>