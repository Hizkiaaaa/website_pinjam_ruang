<header class="mb-5">
    <div class="header-top">
        <div class="container">
            <div class="logo">
                <a href="index.html"><img src="{{ url('') }}/assets/images/logo/logo.svg" alt="Logo"></a>
            </div>
            <div class="header-top-right">

                <div class="dropdown">
                    <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend  "
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar avatar-md2">
                            <img src="{{ url('') }}/assets/images/faces/1.jpg" alt="Avatar">
                        </div>
                        @if(!Auth::check())
                        <div class="text">
                            <h6 class="user-dropdown-name">Guest</h6>
                            <p class="user-dropdown-status text-sm text-muted">guest</p>
                        </div>
                        @else
                        <div class="text">
                            <h6 class="user-dropdown-name">{{ Auth::user()->nama }}</h6>
                            <p class="user-dropdown-status text-sm text-muted">{{ Auth::user()->role->nama_role }}</p>
                        </div>
                        @endif
                    </a>

                </div>
                <!-- Burger button responsive -->
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </div>
        </div>
    </div>
    <nav class="main-navbar">
        <div class="container ">
            <ul>
                @if(!Auth::check())
                <li class="menu-item mx-auto">
                    <a href="/" class='menu-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Calendar</span>
                    </a>
                </li>
                @endif
                <li class="menu-item mx-auto">
                    <a href="/dashboard" class='menu-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if(!Auth::check())
                <li class="menu-item mx-auto">
                    <a href="/ruangan" class='menu-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Ruangan</span>
                    </a>
                </li>
                <li class="menu-item mx-auto">
                    <a href="/tentangkami" class='menu-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Tentang Kami</span>
                    </a>
                </li>
                <li class="menu-item mx-auto">
                    <a href="/login" class='menu-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Login</span>
                    </a>
                </li>
                @else
                @if(Auth::user()->role_id >= 1)
                <li class="menu-item active has-sub mx-auto">
                    <a href="#" class='menu-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Data Pinjaman</span>
                    </a>
                    <div class="submenu ">
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                @if(Auth::user()->role_id >= 3)
                                <li class="submenu-item  ">
                                    <a href="/pinjaman_arsip" class='submenu-link'>Pinjaman Arsip</a>
                                </li>
                                <li class="submenu-item  ">
                                    <a href="/pinjaman_masuk" class='submenu-link'>Pinjaman Masuk</a>
                                </li>
                                @endif
                                <li class="submenu-item  ">
                                    <a href="/pinjaman_saya" class='submenu-link'>Pinjaman Saya</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                @if(Auth::user()->role_id >= 4)
                <li class="menu-item active has-sub mx-auto">
                    <a href="#" class='menu-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Data Olah</span>
                    </a>
                    <div class="submenu ">
                        <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                <li class="submenu-item  ">
                                    <a href="/olahgedung" class='submenu-link'>Gedung</a>
                                </li>
                                <li class="submenu-item  ">
                                    <a href="/olahlaporan" class='submenu-link'>Laporan</a>
                                </li>
                                <li class="submenu-item  ">
                                    <a href="/olahruang" class='submenu-link'>Ruangan</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                @if(Auth::user()->role_id == 5)
                <li class="menu-item active has-sub mx-auto">
                    <a href="#" class='menu-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Data Master</span>
                    </a>
                    <div class="submenu ">
                        <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                <li class="submenu-item  ">
                                    <a href="/manajemen_user" class='submenu-link'>Manajemen User</a>
                                </li>
                                <li class="submenu-item  ">
                                    <a href="/manajemen_opd" class='submenu-link'>Manajemen OPD</a>
                                </li>
                                <li class="submenu-item  ">
                                    <a href="/manajemen_role" class='submenu-link'>Manajemen Role</a>
                                </li>
                                <li class="submenu-item  ">
                                    <a href="/manajemen_pinjaman" class='submenu-link'>Detail Pinjaman</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                @endif
                @endif
                @endif
                <li class="menu-item active has-sub mx-auto">
                    <a href="#" class='menu-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Pengaturan</span>
                    </a>
                    <div class="submenu ">
                        <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                        <div class="submenu-group-wrapper">
                            <ul class="submenu-group">
                                <li class="submenu-item">
                                    <a href="/profil" class='submenu-link'>Lihat Profil</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="/ganti_password" class='submenu-link'>Ganti Password</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="/logout" class='submenu-link'>Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </nav>
</header>
