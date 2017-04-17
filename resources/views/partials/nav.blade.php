<nav class="navbar navbar-default">
    <div class="container-fluid">
        {{--Mobile Nav--}}
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{asset('img/nav-logo.jpg')}}" id="nav-logo"
                     alt="Ricardo Beverly Hills Logo">
            </a>
            <button type="button" class="navbar-toggle collapsed"
                    data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        {{--Desktop Nav--}}
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                @else
                    @role('ricardo-beverly-hills')
                        <li class="{{ Request::is('claim') ? 'active' : '' }}">
                            <a href="{{ route('claim-index') }}">
                                <span class="fa fa-file-text" aria-hidden="true"></span>&nbsp;
                                Claims
                            </a>
                        </li>
                        <li class="{{ Request::is('customer') ? 'active' : '' }}">
                            <a href="{{ route('customer') }}">
                                <span class="fa fa-user" aria-hidden="true"></span>
                                Customers
                            </a>
                        </li>
                        <li class="{{ Request::is('product') ? 'active' : '' }}">
                            <a href="{{ route('product') }}">
                                <span class="fa fa-suitcase" aria-hidden="true"></span>
                                Products
                            </a>
                        </li>
                        <li class="{{ Request::is('repair-center') ? 'active' : '' }}">
                            <a href="{{ route('repair-center') }}">
                                <span class="fa fa-cogs" aria-hidden="true"></span>
                                Repair Centers
                            </a>
                        </li>
                        <li class="{{ Request::is('damage-code') ? 'active' : '' }}">
                            <a href="{{ route('damage-code') }}">
                                <span class="fa fa-fire" aria-hidden="true"></span>
                                Damage Codes
                            </a>
                        </li>
                    @endrole

                    @role('part-company')
                        <li class="{{ Request::is('pc-claim-list') ? 'active' : '' }}">
                            <a href="{{ route('pc-claim-list') }}">
                                <span class="fa fa-file-text" aria-hidden="true"></span>&nbsp;
                                Claims</a>
                        </li>
                    @endrole

                    @role('repair-center')
                        <li><a href="{{ route('repair-center-claim') }}">Claim</a></li>
                    @endrole

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                           role="button" aria-expanded="false">
                           <span class="fa fa-user-circle"></span>
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