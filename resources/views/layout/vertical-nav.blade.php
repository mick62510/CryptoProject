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
            <li class=" nav-item">
                <a href="#">
                    <i class="material-icons">token</i>
                    <span class="menu-title" data-i18n="Crypto">Gestion de vos données</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{route('crypto.entries.create')}}">
                            <i class="material-icons"></i>
                            <span data-i18n="1 column">Créer</span>
                        </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{route('crypto.entries.index')}}">
                            <i class="material-icons"></i>
                            <span data-i18n="1 column">Liste non validés</span>
                        </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{route('crypto.entries.valide.index')}}">
                            <i class="material-icons"></i>
                            <span data-i18n="1 column">Liste validés</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
