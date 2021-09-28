<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php") ?> 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php 
  include('../koneksi/koneksi.php');
  if((isset($_GET['aksi']))&&(isset($_GET['data']))){
    if($_GET['aksi']=='hapus'){
    $nim = $_GET['data'];
  
    //get foto
    $sql_f = "SELECT `foto` FROM `mahasiswa` WHERE `nim`='$nim'";
    $query_f = mysqli_query($koneksi,$sql_f);
    $jumlah_f = mysqli_num_rows($query_f);
    if($jumlah_f>0){
    while($data_f = mysqli_fetch_row($query_f)){
    $foto = $data_f[0];
  
    //menghapus foto dalam folder foto
    unlink("foto/$foto");
    }
  }
    //hapus hobi
    $sql_dh = "delete from `hobi_mahasiswa` where `nim` = '$nim'";
    mysqli_query($koneksi,$sql_dh);
    //hapus data mahasiswa
    $sql_dm = "delete from `mahasiswa` where `nim` = '$nim'";
    mysqli_query($koneksi,$sql_dm);
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
            <h3><i class="fas fa-user-tie"></i> Data Kategori Kuisioner</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Data Kategori Kuisioner</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Data Kategori Kuisioner</h3>
                <div class="card-tools">
                  <a href="tambah_kategori_kuisioner.php" class="btn btn-sm btn-info float-right"><i class="fas fa-plus"></i> Tambah Kuisioner</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="col-md-12">
                  <form method="get" action="mahasiswa.php"> 
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

                </div><br><br><br>

                <br><br>
                <div class="col-sm-12">
                    <?php if(!empty($_GET['notif'])){?>
                    <?php if($_GET['notif']=="tambahberhasil"){?>
                  <div class="alert alert-success" role="alert">
                  Data Berhasil Ditambahkan</div>
                  <?php }?>
                  <?php }?>
                </div>
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
                    <thead class="align-items-center">                  
                      <tr>
                        <th width="5%">No</th>
                        <th width="35%">Kode Kuisioner</th>
                        <th width="35%">Jenis Kuisioner</th>
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
                        //menampilkan data mahasiswa 
                        $sql_mhs = "select `m`.`nim`, `m`.`nama`, `j`.`jurusan` 
                                  from `mahasiswa` `m`
                                  inner join `jurusan` `j` 
                                  on `m`.`kode_jurusan` = `j`.`kode_jurusan` "; 
                        if (isset($_GET["katakunci"])){
                        $katakunci_mhs = $_GET["katakunci"];
                        $sql_mhs .= " where `nim` LIKE '%$katakunci_mhs%' 
                        OR `nama` LIKE '%$katakunci_mhs%'";
                        } 
                        $sql_mhs .= " order by `m`.`nim` limit $posisi, $batas";

                          $query_mhs = mysqli_query($koneksi,$sql_mhs);
                          $no=$posisi+1;
                          while($data_mhs = mysqli_fetch_row($query_mhs)){
                          $nim = $data_mhs[0];
                          $nama = $data_mhs[1];
                          $jurusan = $data_mhs[2];
                        ?>
                        <tr>
                        <td><?php echo $no;?></td>
                        <td><?php echo $nim;?></td>
                        <td><?php echo $nama;?></td>
                        <td>
                        <a href="edit_mahasiswa.php?data=<?php echo $nim;?>" 
                        class="btn btn-xs btn-info" title="Edit">
                        <i class="fas fa-edit"></i></a>
                        <a href="javascript:if(confirm('Anda yakin ingin menghapus data 
                        <?php echo $nim.' - '.$nama; ?>?'))
                        window.location.href = 'mahasiswa.php?aksi=hapus&data=<?php echo $nim;?>'" 
                        class="btn btn-xs btn-warning">
                        <i class="fas fa-trash" title="Hapus"></i></a>
                        </td>
                        </tr>
                        <?php $no++; }?>
                    </tbody>
                  </table>  
              </div>
              <!-- /.card-body -->
              <?php
                //hitung jumlah semua data 
                $sql_jum = "select `m`.`nim`, `m`.`nama`, `j`.`jurusan` 
                            from `mahasiswa` `m`
                            inner join `jurusan` `j` 
                            on `m`.`kode_jurusan` = `j`.`kode_jurusan` ";
                  if (isset($_GET["katakunci"])){
                    $katakunci_mhs = $_GET["katakunci"];
                    $sql_jum .= " where `hobi` LIKE '%$katakunci_mhs%'";
                } 
                $sql_jum .= " order by`m`.`nim`";

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
                            $katakunci_mhs = $_GET["katakunci"];
                            if($halaman!=1){
                              echo "<li class='page-item'><a class='page-link' href='mahasiswa.php?katakunci=$katakunci_mhs&halaman=1'>First</a></li>";
                              echo "<li class='page-item'><a class='page-link' href='mahasiswa.php?katakunci=$katakunci_mhs&halaman=$sebelum'>«</a></li>";
                            }
                            for($i=1; $i<=$jum_halaman; $i++){
                              if($i!=$halaman){
                                echo "<li class='page-item'><a class='page-link' href='mahasiswa.php?katakunci=$katakunci_mhs&halaman=$i'>$i</a></li>";
                              }else{
                                echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                              }
                            }
                            if($halaman!=$jum_halaman){
                              echo "<li class='page-item'><a class='page-link'  href='mahasiswa.php?katakunci=$katakunci_mhs&halaman=$setelah'>»</a></li>";
                              echo "<li class='page-item'><a class='page-link' href='mahasiswa.php?katakunci=$katakunci_mhs&=$jum_halaman'> Last</a></li>";
                            }
                        }else{
                          if($halaman!=1){
                              echo "<li class='page-item'><a class='page-link' href='mahasiswa.php?halaman=1'> First</a></li>";
                              echo "<li class='page-item'><a class='page-link' href='mahasiswa.php?halaman=$sebelum'>«</a></li>";
                          }
                          for($i=1; $i<=$jum_halaman; $i++){
                          if($i!=$halaman){
                            echo "<li class='page-item'><a class='page-link' href='mahasiswa.php?halaman=$i'>$i</a></li>";
                          }else{
                            echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                            }
                          }
                        if($halaman!=$jum_halaman){
                          echo "<li class='page-item'><a class='page-link' href='mahasiswa.php?halaman=$setelah'>»</a></li>";
                          echo "<li class='page-item'><a class='page-link' href='mahasiswa.php?halaman=$jum_halaman'>Last</a></li>";
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
