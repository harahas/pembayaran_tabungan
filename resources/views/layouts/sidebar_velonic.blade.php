<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="/" class="logo logo-light">
        <span class="logo-lg">
            <img src="/assets/images/logo.png" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="/assets/images/logo-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="/" class="logo logo-dark">
        <span class="logo-lg">
            <img src="/assets/images/logo-dark.png" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="/assets/images/logo-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">Main</li>

            <li class="side-nav-item">
                <a href="/" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span> Dashboard </span>
                </a>
            </li>
            @if( auth()->user()->role == 'ADMIN')
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Mater </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/tahun_ajaran">Tahun Ajaran</a>
                        </li>
                    </ul>
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/kelas">Kelas</a>
                        </li>
                    </ul>
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/histori-kelas">Histori Kelas/Naik Kelas</a>
                        </li>
                    </ul>
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/teacher">Guru</a>
                        </li>
                    </ul>
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/wali_kelas">Wali Kelas</a>
                        </li>
                    </ul>
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/student">Siswa</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            @if(auth()->user()->role == 'ADMIN')
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages3" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Keuangan </span>
                    <span class="menu-arrow"></span>
                </a>
                @endif
                <div class="collapse" id="sidebarPages3">
                    @if(auth()->user()->role == 'ADMIN')
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/jenis_pembayaran">Jenis Pembayaran</a>
                        </li>
                    </ul>
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/setting_tagihan">Setting Tagihan</a>
                        </li>
                    </ul>
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/generate_tagihan">Generate Tagihan</a>
                        </li>
                    </ul>
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/tagihan_siswa">Tagihan Siswa</a>
                        </li>
                    </ul>
                    @endif
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages4" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span> Tabungan Siswa </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages4">
                    @if(auth()->user()->role == 'ADMIN')
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="/inputTabungan">Input Tabungan</a>
                        </li>
                    </ul>
                    @endif
                </div>
            </li>
        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
