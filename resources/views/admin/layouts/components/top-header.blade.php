<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button"
            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <x-coreui-icon class="icon icon-lg" icon="cil-menu" />
        </button>

        <a class="header-brand d-md-none" href="#">
            <svg width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="{{ asset('assets/brand/coreui.svg#full') }}"></use>
            </svg>
        </a>

        <div class="page-title-box">
            <h3>Bienvenue, {{ session('name', 'Invité') }}</h3>
        </div>

        <ul class="header-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.notifications.show') }}" id="notificationDropdown" aria-expanded="false">
                    <x-coreui-icon class="icon icon-lg" icon="cil-bell" />
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="badge bg-danger rounded-pill">{{ auth()->user()->unreadNotifications->count() }}</span>
                    @endif
                </a>
            </li>
        </ul>

      <!-- Menu de l'utilisateur avec avatar et options -->
<ul class="header-nav ms-3">
    <li class="nav-item dropdown">
        <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <div class="d-flex align-items-center">
               
                <div class="avatar avatar-md me-2">
                    <img class="avatar-img" src="{{ asset('assets/img/avatars/8.jpg') }}" alt="{{ auth()->user()->email }}">
                </div>
                <span class="badge bg-success" style="font-size: 14px;">
                   
                </span>
                
            </div>
        </a>

        <div class="dropdown-menu dropdown-menu-end pt-0">
            <div class="dropdown-header bg-light py-2">
                <div class="fw-semibold">Account</div>
            </div>

            
            <a class="dropdown-item" href="#">

                <x-coreui-icon class="icon me-2" icon="cil-envelope-open" />
                Notifications <span class="badge badge-sm bg-success ms-2">42</span>
            </a>

            <div class="dropdown-header bg-light py-2">
                <div class="fw-semibold">Settings</div>
            </div>

            <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                <x-coreui-icon class="icon me-2" icon="cil-user" />
                Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">
                    <x-coreui-icon class="icon me-2" icon="cil-account-logout" />
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </div>
    </li>
</ul>

    </div>
    <div class="header-divider"></div>
    @yield('breadcrum')
</header>
