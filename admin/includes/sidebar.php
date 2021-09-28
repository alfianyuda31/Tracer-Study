<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminTracerStudy</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="profil.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profil
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <em class="nav-icon fas fa-user-tie"></em>
              <p>
                Manjemen Kuisioner
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ml-3">
              <li class="nav-item">
                <a href="kategori_kuisioner.php" class="nav-link">
                  <i class="nav-icon fas fa-address-card"></i>
                  <p>
                  Kategori Kuisioner
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="jenis_soal.php" class="nav-link">
                  <i class="nav-icon fas fa-address-card"></i>
                  <p>
                  Jenis Soal
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="soal.php" class="nav-link">
                  <i class="fas fa-pencil-alt"></i>
                  <p>
                  Soal
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="data_kuisioner.php" class="nav-link">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
               Data Kuisioner
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="export_data.php" class="nav-link">
              <i class="nav-icon fas fa-file-export"></i>
              <p>
                Export Data
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="import_data.php" class="nav-link">
              <i class="nav-icon fas fa-upload"></i>
              <p>
                Import Data
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="grafik.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie  "></i>
              <p>
                Grafik
              </p>
            </a>
          </li>
          <?php 
          if (isset($_SESSION['level'])){
            if ($_SESSION['level']=="superadmin"){?>

          <li class="nav-item">
            <a href="user.php" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Pengaturan User
              </p>
            </a>
          </li>
            <?php }?>   
          <?php }?>
          <li class="nav-item">
            <a href="sign_out.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Sign Out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>