<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/beranda" class="nav-link {{Request::is('beranda') ? 'active' : ''}}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    BERANDA
                </p>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="/antrian" class="nav-link {{Request::is('antrian') ? 'active' : ''}}">
                <i class="nav-icon fas fa-tasks"></i>
                <p>
                    ANTRIAN
                </p>
            </a>
        </li> --}}
        <li class="nav-item has-treeview {{Request::is('entri/data*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{Request::is('entri/data*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    ENTRI DATA
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/entri/data/pasien" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>PASIEN</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/entri/data/pendaftaran" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>PENDAFTARAN</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/entri/data/pelayanan" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>PELAYANAN</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview {{Request::is('lihat/data*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{Request::is('lihat/data*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    LIHAT DATA
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/lihat/data/peserta/terdaftar" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>PESERTA TERDAFTAR</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview {{Request::is('datamaster/data*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{Request::is('datamaster/data*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    DATA MASTER
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/datamaster/data/diagnosa" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>DIAGNOSA</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/datamaster/data/dokter" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>DOKTER</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/datamaster/data/kesadaran" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>KESADARAN</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/datamaster/data/poli" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>RUANG/POLI</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/datamaster/data/provider" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>PROVIDER</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/datamaster/data/statuspulang" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>STATUS PULANG</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/datamaster/data/spesialis" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>SPESIALIS</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/datamaster/data/tindakan" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>TINDAKAN</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/datamaster/data/obat" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>OBAT</p>
                    </a>
                </li>
            </ul>
        </li>


        <li class="nav-item has-treeview {{Request::is('setting/data*') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{Request::is('setting/data*') ? 'active' : ''}}">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    SETTING
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/setting/data/bpjs" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>BPJS</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/setting/data/gantipass" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>GANTI PASSWORD</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="/logout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    Logout
                </p>
            </a>
        </li>
    </ul>
</nav>