<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="<?php echo site_url()?>/welcome/departemen" class="brand-link">
      <img src="<?php echo base_url('dist/img/AdminLTELogo.png')?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> -->
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('dist/img/user2-160x160.jpg')?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">

        <a><span class="glyphicon glyphicon-user"></span> &nbsp<?php echo $this->session->userdata('username'); ?> (<?php echo $this->session->userdata('Nama');?>) </a>

     

        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <!-- <li class="nav-header">EXAMPLES</li> -->
          <li class="nav-item ">
            <a href="<?php echo site_url()?>/welcome/surat" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                SK
                <!-- <i class="fas fa-angle-left right"></i> -->
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="<?php echo site_url()?>/welcome/inbox" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Surat Masuk
                <!-- <i class="fas fa-angle-left right"></i> -->
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="<?php echo site_url()?>/welcome/outbox" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Surat Keluar
                 <i class="fas fa-angle-left right"></i> 
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="<?php echo site_url()?>/welcome/agenda" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Rapat
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo site_url()?>/welcome/validation" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Validasi Surat
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="<?php echo site_url()?>/welcome/logout" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Logout
              </p>
            </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
