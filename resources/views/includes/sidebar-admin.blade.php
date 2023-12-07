<nav class="sidebar sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <div class="sidenav-menu-heading">Menu</div>
            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                href="{{ route('admin-dashboard') }}">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboard
            </a>
            <a class="nav-link {{ request()->is('admin/letter/surat-masuk', 'admin/letter/create-masuk') ? 'active' : '' }}"
                href="{{ route('surat-masuk') }}">
                <div class="nav-link-icon"><i data-feather="arrow-right"></i></div>
                Surat Masuk
            </a>
            <a class="nav-link {{ request()->is('admin/letter/surat-keluar', 'admin/letter/create-keluar') ? 'active' : '' }}"
                href="{{ route('surat-keluar') }}">
                <div class="nav-link-icon"><i data-feather="arrow-left"></i></div>
                Surat Keluar
            </a>
            @if (Auth::user()->role == 'Admin')
            <a class="nav-link {{ request()->is('admin/letter') ? 'active' : '' }}" href="{{ route('panduan') }}">
                <div class="nav-link-icon"><i data-feather="book"></i></div>
                Panduan Surat
            </a>
            @endif
            @if (Auth::user()->role == 'Super Admin')
            <ul class="nav flex-column" id="nav_accordion">
                <li class="nav-item has-submenu">
                    <a class="nav-links {{ request()->is('admin/letter/panduan' , 'admin/letter/panduan/create') ? 'active' : '' }}">
                        <div class="nav-link-icon"><i data-feather="book"></i></div>
                        Panduan Surat &nbsp;
                        <div class="nav-link-icon"><i data-feather="chevron-down"></i></div>
                    </a>
                    <ul class="submenu collapse">
                        <li><a class="nav-link" href="{{ route('panduan') }}">Panduan Surat</a></li>
                        <li><a class="nav-link" href="{{ route('create-panduan') }}" >Tambah Panduan</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav flex-column" id="nav_accordion">
                <li class="nav-item has-submenu">
                    <a class="nav-links {{ request()->is('admin/user*') ? 'active' : '' }}">
                        <div class="nav-link-icon"><i data-feather="user"></i></div>
                        User &nbsp;
                        <div class="nav-link-icon"><i data-feather="chevron-down"></i></div>
                    </a>
                    <ul class="submenu collapse">
                        <li><a class="nav-link" href="{{ route('user.index') }}">Data User</a></li>
                        <li><a class="nav-link" href="{{ route('user.create') }}">Tambah User</a></li>
                    </ul>
                </li>
            </ul>
            @endif
            <a class="nav-link {{ request()->is('admin/setting*') ? 'active' : '' }}"
                href="{{ route('setting.index') }}">
                <div class="nav-link-icon"><i data-feather="settings"></i></div>
                Profile
            </a>
        </div>
    </div>
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title">{{ Auth::user()->name }}</div>
        </div>
    </div>
</nav>

@push('sidenav-script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.sidebar .nav-links').forEach(function(element) {

                element.addEventListener('click', function(e) {

                    let nextEl = element.nextElementSibling;
                    let parentEl = element.parentElement;

                    if (nextEl) {
                        e.preventDefault();
                        let mycollapse = new bootstrap.Collapse(nextEl);

                        if (nextEl.classList.contains('show')) {
                            mycollapse.hide();
                        } else {
                            mycollapse.show();
                            // find other submenus with class=show
                            var opened_submenu = parentEl.parentElement.querySelector(
                                '.submenu.show');
                            // if it exists, then close all of them
                            if (opened_submenu) {
                                new bootstrap.Collapse(opened_submenu);
                            }
                        }
                    }
                }); // addEventListener
            }) // forEach
        });
    </script>
@endpush
