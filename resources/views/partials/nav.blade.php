<nav class="navbar navbar-default">
    <div class="container-fluid">
        {{--Mobile Nav--}}
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed"
                    data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">
                Ricardo Beverly Hills
            </a>
        </div>

        {{--Desktop Nav--}}
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                @else
                    @role('ricardo-beverly-hills')
                    <li><a href="{{ route('claim-index') }}">Claim</a></li>
                    <li><a href="{{ route('customer') }}">Customer</a></li>
                    <li><a href="{{ route('product') }}">Product</a></li>
                    <li><a href="{{ route('repair-center') }}">Repair Center</a>
                    @endrole

                    @role('part-company')
                    <li><a href="{{ route('part-company-claim') }}">Claim</a></li>
                    @endrole

                    @role('repair-center')
                    <li><a href="{{ route('repair-center-claim') }}">Claim</a></li>
                    @endrole

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                           role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            @role('ricardo-beverly-hills')
                            <li>
                                <a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ url('/register') }}">Register User</a>
                            </li>
                            @endrole

                            <li>
                                <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}"
                                      method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>