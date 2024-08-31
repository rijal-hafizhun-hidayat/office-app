<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="#">Office App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.index') }}">Home</a>
                    </li>
                    @if (Auth::user()->roles[0]->name == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.index') }}">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('role.index') }}">Role</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('overtime-letter.index') }}">Pengajuan Lembur</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="{{ route('logout') }}">Log out</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
