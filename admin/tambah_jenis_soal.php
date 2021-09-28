<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php") ?> 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include("includes/header.php") ?>

  <?php include("includes/sidebar.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-plus"></i> Tambah Jenis Soal</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="mahasiswa.php">Data Kuisioner</a></li>
              <li class="breadcrumb-item active">Tambah Jenis Soal</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Tambah Jenis Soal</h3>
        <div class="card-tools">
          <a href="jenis_soal.php" class="btn btn-sm btn-warning float-right"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->

      </br></br>
        <div class="col-sm-10">
          <?php if((!empty($_GET['notif']))&&(!empty($_GET['jenis']))){?>
          <?php if($_GET['notif']=="tambahkosong"){?>
          <div class="alert alert-danger" role="alert">Maaf data 
          <?php echo $_GET['jenis'];?> wajib di isi</div>
          <?php }?>
          <?php }?>
        </div>

      <!-- form start -->
      <?php	include('../koneksi/koneksi.php') ?>
      <form class="form-horizontal" method="post" enctype="multipart/form-data" action="konfirmasi_tambah_mahasiswa.php">
        <div class="card-body">
          <div class="form-group row">
            <label for="judul" class="col-sm-12 col-form-label">
              <span class="text-info"><i class="fas fa-user-circle"></i> <u>
              Data Jenis Soal</u></span></label>
          </div>
          <div class="form-group row">
            <label for="nim" class="col-sm-3 col-form-label">Kode Jenis Soal</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="nim" id="nim" value="<?php if(!empty($_SESSION['nim'])){ 
                echo $_SESSION['nim'];} ?>">
              </div>
          </div>
          <div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Jenis Soal</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="nama" id="nama" value="<?php if(!empty($_SESSION['nama'])){ 
                echo $_SESSION['nama'];} ?>">
              </div>
          </div>
          
            <div class="col-sm-12">
              <button type="submit" class="btn btn-info float-right">
                <i class="fas fa-plus"></i> Tambah</button>
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
