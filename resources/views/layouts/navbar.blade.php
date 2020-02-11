<nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #850015">
    <div class="container">
        <a class="navbar-brand" href="#"> {{ config('app.name') }} </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item {{ \Illuminate\Support\Facades\Route::is("user.*") ? "active" : "" }}">
                        <a href="{{ route("user.index") }}" class="nav-link">
                            Manajemen User
                        </a>
                    </li>
                    <li class="nav-item {{ \Illuminate\Support\Facades\Route::is("network-router-status.*") ? "active" : "" }}">
                        <a href="{{ route("network-router-status.index") }}" class="nav-link">
                            Status Router
                        </a>
                    </li>
                @endauth
            </ul>

            <div class="ml-auto">
                <form class="d-inline-block" action="{{ route("logout") }}" method="POST">
                    @csrf
                    <button class="btn btn-danger" type="submit">
                        Log Out
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>