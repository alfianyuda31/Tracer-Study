<?php
session_start();
include('../koneksi/koneksi.php');
if (isset($_GET['data'])) {
  $id_kat = $_GET['data'];
  $_SESSION['id_kategori'] = $id_kat;

  //get data kategori
  $sql_kat = "select `id_kategori`, `kategori` from `kategori_soal` where `id_kategori` = '$id_kat'";
  $query_kat = mysqli_query($koneksi, $sql_kat);
  while ($data_kat = mysqli_fetch_row($query_kat)) {
    $id_kategori = $data_kat[0];
    $kategori = $data_kat[1];
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
          <h3><i class="fas fa-edit"></i> Edit Kategori Soal</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="kategori_soal.php">Kategori Soal</a></li>
            <li class="breadcrumb-item active">Edit Kategori Soal</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title" style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Kategori Soal</h3>
        <div class="card-tools">
          <a href="kategori_soal.php" class="btn btn-sm btn-warning float-right"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->
    </div>

    <?php
    if (!empty($_GET['notif'])) {
      if ($_GET['notif'] == "editkosong") {
    ?>
        <div class="alert alert-danger" role="alert">Maaf data wajib di isi</div>
    <?php
      }
    }
    ?>

    <!-- form start -->
    <form class="form-horizontal" action="konfirmasi_edit_ksoal.php" method="post">
      <div class="card-body">
        <div class="form-group row">
          <label for="id_kat" class="col-sm-3 col-form-label">ID Kategori</label>
          <div class="col-sm-7">
            <input type="text" class="form-control" id="id_kategori" name="id_kategori" value="<?php echo $id_kategori; ?>" disabled>
          </div>
        </div>
        <div class="form-group row">
          <label for="kategori" class="col-sm-3 col-form-label">KategoriSoal</label>
          <div class="col-sm-7">
            <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $kategori; ?>">
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> Simpan</button>
        </div>
      </div>
      <!-- /.card-footer -->
    </form>
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