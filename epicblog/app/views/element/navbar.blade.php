<div class="navigation container">
    <div class='row clearfix'>
        <ul class="nav navbar-nav navbar-default navbar-left">
            <li> {{ link_to_route('post.index', 'Index') }}</li>
            @if (! Auth::check())
                <li> {{ link_to_route('user.create', 'Register') }}</li>
                <li> {{ link_to_route('user.login', 'Login') }} </li>
            @else
                <li> {{ link_to('#', Auth::user()->email) }}</li>
                <li> {{ link_to_route('user.logout', 'logout') }} </li>
            @endif
        </ul>
    </div>
</div>