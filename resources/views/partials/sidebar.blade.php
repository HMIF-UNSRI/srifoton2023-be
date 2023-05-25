<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="javascript:void()" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            @canany(['inti', 'competition'])
                <li>
                    <a href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-users"></i>
                        <span class="nav-text">Users</span>
                    </a>
                </li>
            @endcanany
            @canany(['inti', 'competition', 'competitive_programming'])
                <li>
                    <a href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-brain"></i>
                        <span class="nav-text">Comp. Programming</span>
                    </a>
                </li>
            @endcanany
            @canany(['inti', 'competition', 'uiux_design'])
                <li>
                    <a href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-paint-brush"></i>
                        <span class="nav-text">UI/UX Design</span>
                    </a>
                </li>
            @endcanany
            @canany(['inti', 'competition', 'web_development'])
                <li>
                    <a href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-laptop"></i>
                        <span class="nav-text">Web Development</span>
                    </a>
                </li>
            @endcanany
            @canany(['inti', 'competition', 'mobile_legends'])
                <li>
                    <a href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-gamepad"></i>
                        <span class="nav-text">Mobile Legend</span>
                    </a>
                </li>
            @endcanany
            @canany(['inti', 'seminar'])
                <li>
                    <a href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-microphone"></i>
                        <span class="nav-text">Seminar</span>
                    </a>
                </li>
            @endcanany
        </ul>
    </div>
</div>
