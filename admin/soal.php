<?php 
  include('../koneksi/koneksi.php');
    if((isset($_GET['aksi']))&&(isset($_GET['data']))){
      if($_GET['aksi']=='hapus'){
      $kode_jurusan = $_GET['data'];
      
      //hapus hobi
      $sql_dh = "delete from `jurusan` 
      where `kode_jurusan` = '$kode_jurusan'";
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
            <h3><i class="fas fa-database"></i> Jenis Soal</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Soal</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

      <div class="col-md-12">
        <form method="get" action="jurusan.php">
          <div class="row">
            <div class="col-md-4 bottom-10">
            <input type="text" class="form-control" 
              id="kata_kunci" name="katakunci">
            </div>
          <div class="col-md-5 bottom-10">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-search"></i>  Search</button>
            </div>
          </div><!-- .row -->
        </form>
      </div><br>
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar Soal</h3>
                <div class="card-tools">
                  <a href="tambah_jenis_soal.php" class="btn btn-sm btn-info float-right"><i class="fas fa-plus"></i> Tambah Soal</a>
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
                      <th width="35%">Kode Soal</th>
                      <th width="35%">Soal</th>
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

                      //menampilkan data hobi
                      $sql_dh = "SELECT `kode_jurusan`, `jurusan` FROM `jurusan` ";
                      if (isset($_GET["katakunci"])){
                      $katakunci_jurusan = $_GET["katakunci"];
                      $sql_dh .= " where `jurusan` LIKE '%$katakunci_jurusan%'";
                      } 
                      $sql_dh .= " order by `jurusan` limit $posisi, $batas ";
                          
                        $query_dh = mysqli_query($koneksi,$sql_dh);
                        $no=$posisi+1;
                        while($data_dh = mysqli_fetch_row($query_dh)){
                        $kode_jurusan = $data_dh[0];
                        $jurusan = $data_dh[1];

                      ?>	
                        <tr>
                          <td><?php echo $no;?></td>
                          <td><?php echo $kode_jurusan;?></td>
                          <td><?php echo $jurusan;?></td>
                          <td>
                            <a href="edit_jurusan.php?data=<?php echo $kode_jurusan;?>" 
                            class="btn btn-xs btn-info">
                          <i class="fas fa-edit"></i> Edit</a>
                            <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $jurusan; ?>?'))
                            window.location.href = 'jurusan.php?aksi=hapus&data=<?php echo $kode_jurusan;?>'" 
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
                $sql_jum = "select `kode_jurusan`, `jurusan` from `jurusan`"; 
                  if (isset($_GET["katakunci"])){
                    $katakunci_jurusan = $_GET["katakunci"];
                    $sql_jum .= " where `hobi` LIKE '%$katakunci_jurusan%'";
                } 
                $sql_jum .= " order by `kode_jurusan`";

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
                            $katakunci_jurusan = $_GET["katakunci"];
                            if($halaman!=1){
                              echo "<li class='page-item'><a class='page-link' href='jurusan.php?katakunci=$katakunci_jurusan&halaman=1'>First</a></li>";
                              echo "<li class='page-item'><a class='page-link' href='jurusan.php?katakunci=$katakunci_jurusan&halaman=$sebelum'>«</a></li>";
                            }
                            for($i=1; $i<=$jum_halaman; $i++){
                              if($i!=$halaman){
                                echo "<li class='page-item'><a class='page-link' href='jurusan.php?katakunci=$katakunci_jurusan&halaman=$i'>$i</a></li>";
                              }else{
                                echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                              }
                            }
                            if($halaman!=$jum_halaman){
                              echo "<li class='page-item'><a class='page-link'  href='jurusan.php?katakunci=$katakunci_jurusan&halaman=$setelah'>»</a></li>";
                              echo "<li class='page-item'><a class='page-link' href='jurusan.php?katakunci=$katakunci_jurusan&=$jum_halaman'> Last</a></li>";
                            }
                        }else{
                          if($halaman!=1){
                              echo "<li class='page-item'><a class='page-link' href='jurusan.php?halaman=1'> First</a></li>";
                              echo "<li class='page-item'><a class='page-link' href='jurusan.php?halaman=$sebelum'>«</a></li>";
                          }
                          for($i=1; $i<=$jum_halaman; $i++){
                          if($i!=$halaman){
                            echo "<li class='page-item'><a class='page-link' href='jurusan.php?halaman=$i'>$i</a></li>";
                          }else{
                            echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                            }
                          }
                        if($halaman!=$jum_halaman){
                          echo "<li class='page-item'><a class='page-link' href='jurusan.php?halaman=$setelah'>»</a></li>";
                          echo "<li class='page-item'><a class='page-link' href='jurusan.php?halaman=$jum_halaman'>Last</a></li>";
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
