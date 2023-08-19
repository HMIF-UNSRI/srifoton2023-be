<div class="nav-header">
    <a href="index.html" class="brand-logo">
        <img style="width:fit-content; height:40px"
        src="{{ asset('images/LOGO SRIFOTON 2023.png') }}" alt="">
    </a>
    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>

<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar text-primary">
                    </div>
                    
                </div>
                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown  header-profile">
                        <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                            <img src="{{ asset('images/user.png') }}" width="56" alt="">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end align-items-center align-middle">
                            <a class="dropdown-item ai-icon mb-1">
                                <em class="ni ni-account-setting me-2"></em>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <a href="{{ route('logout')}}" class="dropdown-item ai-icon align-items-center align-middle">
                                <i class="ni ni-signout me-2"></i><span >Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>