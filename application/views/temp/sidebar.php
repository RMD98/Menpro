<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('dist/img/user2-160x160.jpg')?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
         <!-- <a href="<?php echo site_url();?>main/profil"><span class="glyphicon glyphicon-user"></span> &nbsp<?php echo $this->session->userdata('username'); ?> </a> -->
        <a><span class="glyphicon glyphicon-user"></span> &nbsp<?php echo $this->session->userdata('nama'); ?> 
        <span>(<?php echo $this->session->userdata('status');?>) </span> </a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-4">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation + Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Boxed</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-topnav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Navbar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-footer.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Footer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collapsed Sidebar</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header"><a href="<?php echo site_url()?>/welcome/logedin">Home</a></li>
          <li class="nav-item">
            <a href="<?php echo site_url()?>/welcome/agenda" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                agenda
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo site_url()?>/Welcome/pegawai" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Pegawai
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mailbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url()?>/welcome/surat" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Surat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url()?>/welcome/data_surat" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Keluar/Masuk Surat</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo site_url()?>/welcome/account" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Account
              </p>
            </a>
            </li>
            <li class="nav-item">
            <a href="<?php echo site_url()?>/welcome/departemen" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Departemen
              </p>
            </a>
            </li>
            <li class="nav-item">
            <a href="<?php echo site_url()?>/welcome/mom" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Mom
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