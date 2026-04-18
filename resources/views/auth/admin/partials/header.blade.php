<header id="page-topbar">

    <div class="navbar-header">

        <div class="d-flex align-items-center">

            <a href="{{ url('/') }}" class="app-logo">
                LAPORPPA-KBB
            </a>

            <button id="vertical-menu-btn" class="btn ms-3 header-icon">
                <i class="fa fa-bars"></i>
            </button>

        </div>

        <div class="d-flex align-items-center gap-3">

            <button class="btn header-icon" id="fullscreen-btn">
                <i class="bx bx-fullscreen"></i>
            </button>

            <button class="btn header-icon" id="theme-toggle">
                <i class="bx bx-moon"></i>
            </button>

            <div class="dropdown">
                <button class="btn d-flex align-items-center" data-bs-toggle="dropdown">

                    <img src="{{url('avatar/' . Auth::user()->photo)}}" class="rounded-circle" width="30">

                    <span class="ms-2">{{Auth::user()->username}}</span>

                </button>

                <div class="dropdown-menu dropdown-menu-end">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            Logout
                        </button>
                    </form>
                </div>

            </div>

        </div>

    </div>

</header>