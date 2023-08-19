<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ route('dashboard') }}" aria-expanded="false">
                    <i class="bi bi-speedometer2 fs-2"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            @can('inti')
                <li>
                    <a href="{{ route('users') }}" aria-expanded="false">
                        <i class="bi bi-people fs-2"></i>
                        <span class="nav-text">Users</span>
                    </a>
                </li>
            @endcan
            @canany(['inti', 'seminar', 'finance'])
                <li>
                    <a href="{{ route('seminar') }}" aria-expanded="false">
                        <i class="bi bi-easel fs-2"></i>
                        <span class="nav-text">Seminar</span>
                    </a>
                </li>
            @endcanany
            @canany(['inti', 'competition', 'competitive_programming', 'finance'])
                <li>
                    <a href="{{ route('competition.cp') }}" aria-expanded="false">
                        <i class="bi bi-laptop fs-2"></i>
                        <span class="nav-text">Programming</span>
                    </a>
                </li>
            @endcanany
            @canany(['inti', 'competition', 'uiux_design', 'finance'])
                <li>
                    <a href="{{ route('competition.uiux') }}" aria-expanded="false">
                        <i class="bi bi-palette fs-2"></i>
                        <span class="nav-text">UI/UX Design</span>
                    </a>
                </li>
            @endcanany
            @canany(['inti', 'competition', 'web_development', 'finance'])
                <li>
                    <a href="{{ route('competition.webdev') }}" aria-expanded="false">
                        <i class="bi bi-code-slash fs-2"></i>
                        <span class="nav-text">Web Development</span>
                    </a>
                </li>
            @endcanany
        </ul>
    </div>
</div>
