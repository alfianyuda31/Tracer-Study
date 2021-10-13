<?php 
  include('../koneksi/koneksi.php');
    if((isset($_GET['aksi']))&&(isset($_GET['data']))){
      if($_GET['aksi']=='hapus'){
      $kode_jawaban = $_GET['data'];
      
      //hapus jawaban
      $sql_dh = "delete from `jenis_jawaban` 
      where `id` = '$kode_jawaban'";
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
            <h3><i class="fas fa-database"></i>Jenis Jawaban</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Jawaban</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

      <div class="col-md-12">
        <form method="get" action="jawaban.php">
          <div class="row">
            <div class="col-md-4 bottom-10">
            <input type="text" class="form-control" 
              id="kata_kunci" name="katakunci">
            </div>
          <div class="col-md-5 bottom-10">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-search"></i>Search</button>
            </div>
          </div><!-- .row -->
        </form>
      </div><br>
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar Jawaban</h3>
                <div class="card-tools">
                  <a href="tambah_jenis_jawaban.php" class="btn btn-sm btn-info float-right"><i class="fas fa-plus"></i> Tambah Jawaban</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <div class="col-sm-12">
                <?php if(!empty($_GET['notif'])){?>
                <?php if($_GET['notif']=="tambahberhasil"){?>
                  <div class="alert alert-success" role="alert">
                  Data Berhasil Ditambahkan</div>
                <?php } else if($_GET['notif']=="editberhasil"){?>
                  <div class="alert alert-success" role="alert">
                  Data Berhasil Diubah</div>
                <?php }?>
                <?php }?>
              </div>

                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th width="5%">No</th>
                      <th width="35%">Jenis Jawaban</th>
                      <th width="25%"><center>Aksi</center></th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php 
                      $batas = 2;
                      if(!isset($_GET['halaman'])){
                        $posisi = 0;
                        $halaman = 1;
                      }else{
                        $halaman = $_GET['halaman'];
                        $posisi = ($halaman-1) * $batas;
                      } 
                  ?>
                    <?php	include('../koneksi/koneksi.php') ?>
                    <?php

                      //menampilkan data jawaban
                      $sql_dh = "SELECT * FROM `jenis_jawaban` ";
                      if (isset($_GET["katakunci"])){
                      $katakunci_jawaban = $_GET["katakunci"];
                      $sql_dh .= " where `jenis_jawaban` LIKE '%$katakunci_jawaban%'";
                      } 
                      $sql_dh .= " order by `id` limit $posisi, $batas ";
                          
                        $query_dh = mysqli_query($koneksi,$sql_dh);
                        $no=$posisi+1;
                        while($data_dh = mysqli_fetch_row($query_dh)){
                        $jenis_jawaban = $data_dh[1];
                        $kode_jawaban = $data_dh[0];
                      ?>	
                        <tr>
                          <td><?php echo $no;?></td>
                          <td><?php echo $jenis_jawaban;?></td>
                          <td>
                            <a href="edit_jawaban.php?data=<?php echo $kode_jawaban;?>" 
                            class="btn btn-xs btn-info">
                          <i class="fas fa-edit"></i> Edit</a>
                            <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $jenis_jawaban; ?>?'))
                            window.location.href = 'jawaban.php?aksi=hapus&data=<?php echo $kode_jawaban;?>'" 
                            class="btn btn-xs btn-warning"><i class="fas fa-trash"></i> Hapus 
                            </a> 
                          </td>
                        </tr>
                        <?php
                        $no++;
                      }?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <?php
                //hitung jumlah semua data 
                $sql_jum = "select * from `jenis_jawaban`"; 
                  if (isset($_GET["katakunci"])){
                    $katakunci_jawaban = $_GET["katakunci"];
                    $sql_jum .= " where `jenis_jawaban` LIKE '%$katakunci_jawaban%'";
                } 
                $sql_jum .= " order by `id`";

                $query_jum = mysqli_query($koneksi,$sql_jum);
                $jum_data = mysqli_num_rows($query_jum);
                $jum_halaman = ceil($jum_data/$batas);
              ?>

              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                <?php 
                  if($jum_halaman==0){
                  //tidak ada halaman
                  }else if($jum_halaman==1){
                    echo "<li class='page-item'><a class='page-link'>1</a></li>";
                  }else{
                    $sebelum = $halaman-1;
                    $setelah = $halaman+1;
                    if (isset($_GET["katakunci"])){
                            $katakunci_jawaban = $_GET["katakunci"];
                            if($halaman!=1){
                              echo "<li class='page-item'><a class='page-link' href='jawaban.php?katakunci=$katakunci_jawaban&halaman=1'>First</a></li>";
                              echo "<li class='page-item'><a class='page-link' href='jawaban.php?katakunci=$katakunci_jawaban&halaman=$sebelum'>«</a></li>";
                            }
                            for($i=1; $i<=$jum_halaman; $i++){
                              if($i!=$halaman){
                                echo "<li class='page-item'><a class='page-link' href='jawaban.php?katakunci=$katakunci_jawaban&halaman=$i'>$i</a></li>";
                              }else{
                                echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                              }
                            }
                            if($halaman!=$jum_halaman){
                              echo "<li class='page-item'><a class='page-link'  href='jawaban.php?katakunci=$katakunci_jawaban&halaman=$setelah'>»</a></li>";
                              echo "<li class='page-item'><a class='page-link' href='jawaban.php?katakunci=$katakunci_jawaban&=$jum_halaman'> Last</a></li>";
                            }
                        }else{
                          if($halaman!=1){
                              echo "<li class='page-item'><a class='page-link' href='jawaban.php?halaman=1'> First</a></li>";
                              echo "<li class='page-item'><a class='page-link' href='jawaban.php?halaman=$sebelum'>«</a></li>";
                          }
                          for($i=1; $i<=$jum_halaman; $i++){
                          if($i!=$halaman){
                            echo "<li class='page-item'><a class='page-link' href='jawaban.php?halaman=$i'>$i</a></li>";
                          }else{
                            echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                            }
                          }
                        if($halaman!=$jum_halaman){
                          echo "<li class='page-item'><a class='page-link' href='jawaban.php?halaman=$setelah'>»</a></li>";
                          echo "<li class='page-item'><a class='page-link' href='jawaban.php?halaman=$jum_halaman'>Last</a></li>";
                          }
                        }
                    }?>
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
