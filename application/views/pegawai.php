<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pegawai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
            <!-- /.card-header -->
            <div class="card-header">
            <!-- <div class="col-6"> -->
            <a href="<?php echo site_url()?>/welcome/add_pegawai">
            <button type="submit" class="btn btn-primary float-right">Add</button>
            </a>  
          </div>
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>NIP</th>
                  <th>Nama</th>
                  <th>Tanggal Lahir</th>
                  <th>Tempat Lahir</th>
                  <th>Alamat</th>
                  <th>No.Hp</th>
                  <th>Email</th>
                  <th>Aktif</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($tbl_pegawai as $tbl_pegawai): ?>
                <tr>
                  <td><?php echo $tbl_pegawai->Nip?></td>
                  <td><?php echo $tbl_pegawai->NamaPegawai?></td>
                  <td><?php echo $tbl_pegawai->TanggalLahir?></td>
                  <td><?php echo $tbl_pegawai->TempatLahir?></td>
                  <td><?php echo $tbl_pegawai->Alamat?></td>
                  <td><?php echo $tbl_pegawai->NoHP?></td>
                  <td><?php echo $tbl_pegawai->Email?></td>
                  <td><?php echo $tbl_pegawai->Aktif?></td>
                  <td><a href="<?php echo site_url()?>/welcome/add_departmen">
                   <button type="submit" class="btn btn-warning float-right">Edit</button>
                  </a>
                  <a href="<?php echo site_url()?>/welcome/add_departmen" type="color:red;">
                  <button type="submit" class="btn btn-danger float-right" >Delete</button>
                  </a>
                  </td>
                </tr>
                <?php endforeach;?>              
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

            <!-- /.card-header -->
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