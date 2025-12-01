@php
    $roles = [
        1 => 'Student',
        2 => 'Instructor',
        0 => 'Admin',
    ];
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container-fluid">
<span class="navbar-brand mb-0 h1">
    {{ $roles[(int) Auth::user()->role] ?? 'User' }} Dashboard

</span>

        <div class="d-flex">
            <div class="dropdown">
                <a class="btn btn-light dropdown-toggle" href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                   {{-- <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>--}}
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
