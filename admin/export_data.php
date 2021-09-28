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
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-download"></i> Form Ekspor Data</h3>
          
        </div>
        <div class="box-body">

          <form class="form-inline"role="form" method="post" action="konfirmasi-export-data">
            <fieldset><legend>Silahkan melakukan ekspor data tracer study pada form dibawah ini.</legend>
            <div class="form-group">
              <label for="periode">&nbsp;&nbsp;&nbsp;Tahun Lulus</label>
              <select class="form-control" name="tahun_lulus">
                      <option value="0">--Semua Tahun Lulus--</option>
                                            <option value="2021">2021</option>             
                                            <option value="2020">2020</option>             
                                            <option value="2019">2019</option>             
                                            <option value="2018">2018</option>             
                                            <option value="2017">2017</option>             
                                            <option value="2016">2016</option>             
                                            <option value="2015">2015</option>             
                                            <option value="2014">2014</option>             
                                            <option value="2013">2013</option>             
                                            <option value="2012">2012</option>             
                                            <option value="2011">2011</option>             
                                            <option value="2010">2010</option>             
                        
              </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Ekspor</button><br><br>
          </fieldset>
        </form>
        </div>
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
