<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Surat Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url()?>/welcome/logedin_user">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header"> 
            <!-- <div class="col-6"> -->
             <!-- <a href="<?php echo site_url()?>/welcome/tambahSurat">
            <button type="submit" class="btn btn-primary float-right">scan surat</button>
            </a>   -->
          </div>
          

            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <!-- <th>Id Surat</th> -->
                  <th>No. Surat</th>
                  <th>Tanggal Buat</th>
                  <th>Topik</th>
                  <th>Status</th>
                  <!-- <th>Tipe</th> -->
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($SuratMasuk as $SuratMasuk): ?>
                <tr>
                  <!-- <td>1</td> -->
                  <td><?=$SuratMasuk->NoSurat?></td>
                  <td><?=$SuratMasuk->TglDibuat?></td>
                  <td><?=$SuratMasuk->Topik?></td>
                  <td><?=$SuratMasuk->Status?></td>
                  <!-- <td>Single</td> -->
                  <td>
                  <a href="<?php echo site_url()?>/welcome/lihatSurat/<?=$SuratMasuk->IdSurat?>">
                   <button type="submit" class="btn btn-danger float-right">Lihat</button>
                  </a>
                  <a href="<?php echo site_url()?>/welcome/statusSurat/<?=$SuratMasuk->IdSurat?>">
                   <button type="submit" class="btn btn-primary float-right">Status</button>
                  </a>
                  <a href="<?php echo site_url()?>/welcome/downloadSurats/<?=$SuratMasuk->IdSurat?>">
                   <button type="submit" class="btn btn-warning float-right">Download</button> 
                  <!-- </a>
                  <!-- <a href="<?php echo site_url()?>/welcome/add_departmen" type="color:red;"> -->
                  <!-- <button type="submit" class="btn btn-danger float-right" >Delete</button> -->
                  <!-- </a> -->
                  </td>
                </tr>  
                <?php endforeach ?> 
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
</body>
</html>
