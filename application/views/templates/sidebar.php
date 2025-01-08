<!-- Sidebar -->
<ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon">
      <i class="fas fa-bill payment"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Tagihan Pelanggan</div>

  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Menu
  </div>

  <?php if ($this->session->userdata('role_id') == 1) : ?>

    <!-- Menu Dashboard -->
    <li class="nav-item <?= current_url() == base_url('dashboard-admin') ? 'active' : '' ?>">
      <a class="nav-link" href="<?= base_url('dashboard-admin'); ?>">
        <i class="fas fa-fw fa-mobile"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <!-- Menu Tutorial Pembayaran -->
    <li class="nav-item <?= current_url() == base_url('tutorial_pembayaran') ? 'active' : '' ?>">
      <a class="nav-link" href="<?= base_url('tutorial_pembayaran'); ?>">
        <i class="fas fa-fw fa-mobile"></i>
        <span>Tutorial Pembayaran</span>
      </a>
    </li>

    <!-- Menu Data Pelanggan -->
    <li class="nav-item <?= current_url() == base_url('data-pelanggan') ? 'active' : '' ?>">
      <a class="nav-link" href="<?= base_url('data-pelanggan'); ?>">
        <i class="fas fa-fw fa-users"></i>
        <span>Data Pelanggan</span>
      </a>
    </li>

    <!-- Menu Data Langganan -->
    <li class="nav-item <?= current_url() == base_url('data-langganan') ? 'active' : '' ?>">
      <a class="nav-link" href="<?= base_url('data-langganan'); ?>">
        <i class="fas fa-fw fa-server"></i>
        <span>Data Langganan</span>
      </a>
    </li>

    <!-- Menu Data Invoice -->
    <li class="nav-item <?= current_url() == base_url('data-invoice') ? 'active' : '' ?>">
      <a class="nav-link" href="<?= base_url('data-invoice'); ?>">
        <i class="fas fa-fw fa-file-invoice"></i>
        <span>Data Invoice</span>
      </a>
    </li>

    <!-- Menu Cetak Laporan -->
    <li class="nav-item <?= current_url() == base_url('laporan-pengaduan') ? 'active' : '' ?>">
      <a class="nav-link" href="<?= base_url('laporan-pengaduan'); ?>">
        <i class="fas fa-fw fa-print"></i>
        <span>Cetak Laporan</span>
      </a>
    </li>

  <?php endif; ?>

  <?php if ($this->session->userdata('role_id') == 2) : ?>

    <!-- Menu Dashboard -->
    <li class="nav-item <?= current_url() == base_url('dashboard-pelanggan') ? 'active' : '' ?>">
      <a class="nav-link" href="<?= base_url('dashboard-pelanggan'); ?>">
        <i class="fas fa-fw fa-mobile"></i>
        <span>Dashboard</span>
      </a>
    </li>

  <?php endif; ?>

  <!-- Ubah Password -->
  <li class="nav-item <?= current_url() == base_url('ubah-password') ? 'active' : '' ?>">
    <a class="nav-link" href="<?= base_url('ubah-password'); ?>">
      <i class="fas fa-fw fa-key"></i>
      <span>Ubah Password</span></a>
  </li>

  <!-- Logout -->
  <li class="nav-item">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Logout</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header badge-primary">
        <h5 class="modal-title" id="logoutModalLabel">Yakin ingin keluar?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Klik "logout" jika ingin mengakhiri sesi ini.</div>
      <div class="modal-footer">
        <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
        <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
      </div>
    </div>
  </div>
</div>