<?php 
    session_start();
    include('../koneksi/koneksi.php');
    if(isset($_GET['data'])){
      $kode_jawaban = $_GET['data'];
      $_SESSION['kode_jawaban']=$kode_jawaban;

    //get data hobi
    $sql_d = "select `jenis_jawaban` from `jenis_jawaban` where `id` = '$kode_jawaban'";
    $query_d = mysqli_query($koneksi,$sql_d);
    while($data_d = mysqli_fetch_row($query_d)){
      $jawaban= $data_d[0];
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
            <h3><i class="fas fa-edit"></i> Edit jawaban</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="jawaban.php">jawaban</a></li>
              <li class="breadcrumb-item active">Edit jawaban</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit jawaban</h3>
        <div class="card-tools">
          <a href="jawaban.php" class="btn btn-sm btn-warning float-right"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->

      <?php if(!empty($_GET['notif'])){?>
        <?php if($_GET['notif']=="editkosong"){?>
          <div class="alert alert-danger" role="alert">
          Maaf data jawaban wajib di isi</div>
        <?php }?>
      <?php }?>
      </div>

      <!-- form start -->
      <form class="form-horizontal" action="konfirmasi_edit_jawaban.php" method="post">
        <div class="card-body">
          <div class="form-group row">
            <label for="jenis_jawaban" class="col-sm-3 col-form-label">jenis_jawaban</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="jenis_jawaban" name="jenis_jawaban" value="<?php echo $jawaban;?>">
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
