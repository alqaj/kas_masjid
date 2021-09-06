<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user panel (optional) -->

  @if(Auth::check())
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{{ asset('vendor/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    </div>
    <div class="info">
      <a href="#" class="d-block">{{ Auth::user()->name }}</a>
    </div>
  </div>
  @endif

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="{{ route('website.home') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Beranda
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Mutasi Kas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('website.kas.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Input Mutasi Kas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('website.kas.show_history', ['filter' => 'bulan']) }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lihat Mutasi Kas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('website.proposal.history') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lihat History Proposal</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('website.kas.show_grup_report') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Kas</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('website.tabungan.index') }}" class="nav-link">
              <i class="nav-icon fas fas fa-address-card"></i>
              <p>
                Tabungan Qurban
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('website.akun.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Akun</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('website.proposal.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Proposal</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->