<link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.css'); ?>">

<div class="sidebar">
    <div class="profile">
        <img src="<?php echo base_url('assets/images/user.png'); ?>" alt="User Image">
        <h3>Admin</h3>
    </div>
    <ul>
        <li class="<?php echo ($this->uri->segment(1) == 'dashboard') ? 'active' : ''; ?>">
            <a href="dashboard"><i class="fas fa-home"></i> Dashboard</a>
        </li>
        <li class="<?php echo ($this->uri->segment(1) == 'pendataan_kapal') ? 'active' : ''; ?>">
            <a href="pendataan_kapal"><i class="fas fa-ship"></i> Pendataan Kapal</a>
        </li>
        <li class="<?php echo ($this->uri->segment(1) == 'jadwal_kapal') ? 'active' : ''; ?>">
            <a href="jadwal_kapal"><i class="fas fa-calendar-alt"></i> Jadwal Kapal</a>
        </li>
        <li class="<?php echo ($this->uri->segment(1) == 'cargo') ? 'active' : ''; ?>">
            <a href="cargo"><i class="fas fa-box"></i> Aktivitas Bongkar Muat</a>
        </li>
        <li class="<?php echo ($this->uri->segment(1) == 'warehouse') ? 'active' : ''; ?>">
            <a href="warehouse"><i class="fas fa-warehouse"></i> Manajemen Gudang</a>
        </li>
        <li>
            <a href="logout" style="color: red; text-decoration: none;">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </li>
    </ul>
</div>
