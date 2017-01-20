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
                <li><a href="{{ route('claim') }}">Claim</a></li>
                <li><a href="{{ route('customer') }}">Customer</a></li>
                <li><a href="{{ route('part-order') }}">Part Order</a></li>
                <li><a href="{{ route('product') }}">Product</a></li>
                <li><a href="{{ route('repair-center') }}">Repair Center</a></li>
                <li><a href="{{ route('home') }}">Login</a></li>
            </ul>
        </div>
    </div>
</nav>