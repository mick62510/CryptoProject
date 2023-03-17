<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    @include('layout.partial.user-profil')
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item">
                <a href="{{route('home')}}">
                    <i class="material-icons">important_devices</i>
                    <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>

            <li class=" navigation-header">
                <span>Support</span>
                <i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right"
                   data-original-title="Support">more_horiz</i>
            </li>
            <li class=" nav-item">
                <a href="https://pixinvent.ticksy.com/" target="_blank">
                    <i class="material-icons">local_offer</i>
                    <span class="menu-title" data-i18n="Raise Support">Raise Support</span>
                </a>
            </li>
            <li class=" nav-item">
                <a href="https://pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/documentation"
                   target="_blank">
                    <i class="material-icons">format_size</i>
                    <span class="menu-title" data-i18n="Documentation">Documentation</span>
                </a>
            </li>
        </ul>
    </div>
</div>
