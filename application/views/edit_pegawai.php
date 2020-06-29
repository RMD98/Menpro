@@ -0,0 +1,132 @@
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
            <h1>tambah pegawai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pegawai</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <!-- <h3 class="card-title">Quick Example</h3> -->
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php foreach ($pgw as $pgw) :?>
              <form role="form" method='post' action="<?php echo site_url()?>/welcome/edt_pegawai">
                <div class="card-body">
                  <div class="form-group">
                    <label >NIP</label>
                    <input type="text" class="form-control" name="nip" value="<?php echo $pgw->Nip?>">
                  </div>
                  <div class="form-group">
                    <label >Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $pgw->NamaPegawai?>">
                  </div>
                  <div class="form-group">
                    <label >Tanggal Lahir</label>
                    <input type="text" class="form-control" name="tgl" value="<?php echo $pgw->TanggalLahir?>">
                  </div>
                  <div class="form-group">
                    <label >Tempat Lahir</label>
                    <input type="text" class="form-control" name="tpt" value="<?php echo $pgw->TempatLahir?>">
                  </div>
                  <div class="form-group">
                    <label >Alamat</label>
                    <input type="text" class="form-control" name="alamat" value="<?php echo $pgw->Alamat?>">
                  </div>
                  <div class="form-group">
                    <label >No HP</label>
                    <input type="text" class="form-control" name="nope" value="<?php echo $pgw->NoHP?>">
                  </div>
                  <div class="form-group">
                    <label >Email</label>
                    <input type="text" class="form-control" name="email" value="<?php echo $pgw->Email?>">
                  </div>
                  <!-- <div class="form-group">
                    <label >Jurusan</label>
                    <input type="email" class="form-control" placeholder="jurusan">
                  </div>
                  <div class="form-group">
                    <label >Username</label>
                    <input type="email" class="form-control" placeholder="username">
                  </div>
                  <div class="form-group">
                    <label >password</label>
                    <input type="password" class="form-control" placeholder="password">
                  </div> -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
              <?php endforeach;?>
            </div>
            <!-- /.card -->
            <!-- Form Element sizes -->
            <!-- /.card -->
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
<script src="<?php echo base_url('plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('plugins/datatables/jquery.dataTables.js')?>"></script>
<script src="<?php echo base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('dist/js/adminlte.min.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('dist/js/demo.js')?>"></script>
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