@php 
    $user = Auth::user();
@endphp

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Boolfolio</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="{{ route('admin.project.index') }}" role="button" aria-expanded="false">
                        Projects
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="{{ route('admin.project.create') }}" role="button" aria-expanded="false">
                        New Project
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="{{ route('admin.project.trashed') }}" role="button" aria-expanded="false">
                        Bin
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{$user->name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}">Edit profile</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button>Logout</button>

                            </form>
                        </li>
                    </ul>
                </li>
            </ul>

            {{-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> --}}
        </div>
    </div>
</nav>