<?php 
  include('../koneksi/koneksi.php');
    if((isset($_GET['aksi']))&&(isset($_GET['data']))){
      if($_GET['aksi']=='hapus'){
      $kode_hobi = $_GET['data'];
      
      //hapus hobi
      $sql_dh = "delete from `hobi` 
      where `kode_hobi` = '$kode_hobi'";
      mysqli_query($koneksi,$sql_dh);
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
       
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Hobi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

      <div class="col-md-12">
        <form method="get" action="hobi.php">
          <div class="row">
            
          
          </div><!-- .row -->
        </form>
      </div><br> 
    </section>

    <!-- Main content -->
    <section class="content">
     
              
    <!-- /.card-header -->
  <!-- Default box -->
  <div class="box">
  <section class="content-header">

      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-edit"></i> Form Impor Data Tracer Study</h3>
          
        </div>
        <div class="box-body">
            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data"  action="konfirmasi-import-data">
              <fieldset><legend>Silahkan melakukan impor data pada form dibawah ini.</legend>
                <div class="form-group">
                  <label for="alamatSitus" class="col-sm-2 control-label">Browse Data Excel</label>
                  <div class="col-sm-5">
                    <input class="filestyle" name="file" data-buttonText="Cari file" data-buttonName="btn-primary" id="prestasiJPG" type="file">
                  </div>
                </div><br />
               <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-5">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-download"></i>&nbsp; Impor Data</button>
                  </div>
                </div>
              </fieldset>
            </form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="alert alert-info" role="alert">
              <span>Catatan :</span>
                    <ul>
                        <li>Digunakan untuk import data tracer study format excell</li>
                    </ul>
            </div>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.card-body --> 




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
