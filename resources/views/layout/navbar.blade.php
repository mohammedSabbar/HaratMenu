<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{url('/')}}"><img style="width: 100% !important; height: 50px;" src="{{asset('theme/images/trend.png')}}" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{url('/')}}"><img src="{{asset('theme/images/trend.png')}}" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <!-- Image loader -->
            <div class="circle-loader" id="loader" style="width: 30px;height: 30px;display: none">

            </div>
            <!-- Image loader -->
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
{{--                    <p>{{auth()->user()->user_name}}</p>--}}
                    <p>Admin</p>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item" >
                            <i class="mdi mdi-logout text-primary"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
