<!DOCTYPE html>
<html>

<head>
  <?php include("includes/head.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php
    include('../koneksi/koneksi.php');
    if ((isset($_GET['aksi'])) && (isset($_GET['data']))) {
      if ($_GET['aksi'] == 'hapus') {
        $id_kat = $_GET['data'];
        //hapus kategori soal
        $sql_dh = "delete from `kategori_soal` where `id_kategori` = '$id_kat'";
        mysqli_query($koneksi, $sql_dh);

        header("Location:kategori_soal.php");
      }
    }
    ?>

    <?php include("includes/header.php") ?>

    <?php include("includes/sidebar.php") ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h3><i class="fas fa-user-tie"></i> Data Kategori Soal</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Data Kategori Soal</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Data Kategori Soal</h3>
            <div class="card-tools">
              <a href="tambah_kategori_soal.php" class="btn btn-sm btn-info float-right"><i class="fas fa-plus"></i> Tambah Kategori Soal</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="col-md-12">
              <form method="get" action="kategori_soal.php">
                <div class="row">
                  <div class="col-md-4 bottom-10">
                    <input type="text" class="form-control" id="kata_kunci" name="katakunci">
                  </div>
                  <div class="col-md-5 bottom-10">
                    <button type="submit" class="btn btn-primary">
                      <i class="fas fa-search"></i> Search</button>
                  </div>
                </div><!-- .row -->
              </form>
            </div>

            <br><br>
            <div class="col-sm-12">
              <?php if (!empty($_GET['notif'])) { ?>
                <?php if ($_GET['notif'] == "tambahberhasil") { ?>
                  <div class="alert alert-success" role="alert">
                    Data Berhasil Ditambahkan</div>
                <?php } else if ($_GET['notif'] == "editberhasil") { ?>
                  <div class="alert alert-success" role="alert">
                    Data Berhasil Diubah</div>
                <?php } ?>
              <?php } ?>
            </div>


            <table class="table table-bordered">
              <thead class="align-items-center">
                <tr>
                  <th width="5%">No</th>
                  <th width="35%">ID Kategori</th>
                  <th width="35%">Kategori Soal</th>
                  <th width="25%">
                    <center>Aksi</center>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                $batas = 5;
                if (!isset($_GET['halaman'])) {
                  $posisi = 0;
                  $halaman = 1;
                } else {
                  $halaman = $_GET['halaman'];
                  $posisi = ($halaman - 1) * $batas;
                }
                ?>
                <?php include('../koneksi/koneksi.php') ?>
                <?php
                //menampilkan data kategori soal
                $sql_ksoal = "select `id_kategori`, `kategori` from `kategori_soal`";
                if (isset($_GET["katakunci"])) {
                  $katakunci_ksoal = $_GET["katakunci"];
                  $sql_ksoal .= " where `id_kategori` LIKE '%$katakunci_ksoal%' 
                        OR `kategori` LIKE '%$katakunci_ksoal%'";
                }
                $sql_ksoal .= " order by `id_kategori` limit $posisi, $batas";

                $query_ksoal = mysqli_query($koneksi, $sql_ksoal);
                $no = $posisi + 1;
                while ($data_ksoal = mysqli_fetch_row($query_ksoal)) {
                  $id_kategori = $data_ksoal[0];
                  $kategori = $data_ksoal[1];
                ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $id_kategori; ?></td>
                    <td><?php echo $kategori; ?></td>
                    <td>
                      <a href="edit_ksoal.php?data=<?php echo $id_kategori; ?>" class="btn btn-xs btn-info" title="Edit">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $id_kategori . ' - ' . $kategori; ?>?')) window.location.href = 'kategori_soal.php?aksi=hapus&data=<?php echo $id_kategori; ?>'" class="btn btn-xs btn-warning">
                        <i class="fas fa-trash" title="Hapus"></i></a>
                    </td>
                  </tr>
                <?php $no++;
                } ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <?php
          //hitung jumlah semua data 
          $sql_jum = "select `id_kategori`, `kategori` from `kategori_soal`";
          if (isset($_GET["katakunci"])) {
            $katakunci_ksoal = $_GET["katakunci"];
            $sql_jum .= " where `kategori` LIKE '%$katakunci_ksoal%'";
          }
          $sql_jum .= " order by `id_kategori`";

          $query_jum = mysqli_query($koneksi, $sql_jum);
          $jum_data = mysqli_num_rows($query_jum);
          $jum_halaman = ceil($jum_data / $batas);
          ?>

          <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
              <?php
              if ($jum_halaman == 0) {
                //tidak ada halaman
              } else if ($jum_halaman == 1) {
                echo "<li class='page-item'><a class='page-link'>1</a></li>";
              } else {
                $sebelum = $halaman - 1;
                $setelah = $halaman + 1;
                if (isset($_GET["katakunci"])) {
                  $katakunci_ksoal = $_GET["katakunci"];
                  if ($halaman != 1) {
                    echo "<li class='page-item'><a class='page-link' href='kategori_soal.php?katakunci=$katakunci_ksoal&halaman=1'>First</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='kategori_soal.php?katakunci=$katakunci_ksoal&halaman=$sebelum'>«</a></li>";
                  }
                  for ($i = 1; $i <= $jum_halaman; $i++) {
                    if ($i != $halaman) {
                      echo "<li class='page-item'><a class='page-link' href='kategori_soal.php?katakunci=$katakunci_ksoal&halaman=$i'>$i</a></li>";
                    } else {
                      echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                    }
                  }
                  if ($halaman != $jum_halaman) {
                    echo "<li class='page-item'><a class='page-link'  href='kategori_soal.php?katakunci=$katakunci_ksoal&halaman=$setelah'>»</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='kategori_soal.php?katakunci=$katakunci_ksoal&=$jum_halaman'> Last</a></li>";
                  }
                } else {
                  if ($halaman != 1) {
                    echo "<li class='page-item'><a class='page-link' href='kategori_soal.php?halaman=1'> First</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='kategori_soal.php?halaman=$sebelum'>«</a></li>";
                  }
                  for ($i = 1; $i <= $jum_halaman; $i++) {
                    if ($i != $halaman) {
                      echo "<li class='page-item'><a class='page-link' href='kategori_soal.php?halaman=$i'>$i</a></li>";
                    } else {
                      echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                    }
                  }
                  if ($halaman != $jum_halaman) {
                    echo "<li class='page-item'><a class='page-link' href='kategori_soal.php?halaman=$setelah'>»</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='kategori_soal.php?halaman=$jum_halaman'>Last</a></li>";
                  }
                }
              } ?>
            </ul>
          </div>
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include("includes/footer.php") ?>

  </div>
  <!-- ./wrapper -->

  <?php include("includes/script.php") ?>
</body>

</html>