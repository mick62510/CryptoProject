<div class="navbar-container content">
    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="nav navbar-nav float-right ml-auto">
            <li class="dropdown dropdown-user nav-item">
                <a class="dropdown-toggle nav-link dropdown-user-link"
                   href="#" data-toggle="dropdown">
                    <span class="avatar avatar-online">
                        <img
                            src="{{Vite::asset('resources/images/avatar-s-19.png')}}"
                            alt="avatar"><i></i></span><span class="user-name">John Doe</span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{route('profile.edit')}}">
                        <i class="material-icons">person_outline</i> Edit Profil
                    </a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('logout')}}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="material-icons">power_settings_new</i>
                        Logout</a>
                </div>
            </li>
        </ul>
    </div>
</div>
