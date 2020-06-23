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
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">NIP</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="NIP">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nama</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Nama">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tanggal Lahir</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Tanggal Lahir">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tempat Lahir</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Tempat Lahit">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Alamat</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Alamat">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">No HP</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="No HP">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Jurusan</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="jurusan">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Username</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="username">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="password">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
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
