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
            <h1>Tambah Account</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Account</li>
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
             <?php echo form_open_multipart('/welcome/tmbh_account')?>
              <!-- <form role="form" method='Post' action="<?php echo site_url()?>/welcome/tmbh_pegawai"> -->
                <div class="card-body">
                  <?php foreach($acc as $acc) : ?>
                    <div class="form-group">
                      <label >NIP</label>
                      <select type="text" class="form-control" placeholder="NIP" name="nip" value="<?php echo $acc->NIP;?>">
                        <?php foreach($pgw as $pgw):
                          if($acc->NIP == $pgw->Nip) {?>
                            <option selected><?php echo $pgw->Nip;?>
                          <?} else {?>
                            <option><?php echo $pgw->Nip;?>
                        <?php }; endforeach;?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label >Status</label>
                      <input type="text" class="form-control" placeholder="Status" name="jbt" value="<?=$acc->Status;?>">
                    </div>
                    <div class="form-group">
                      <label >Username</label>
                      <input type="text" class="form-control" placeholder="Username" name="uname" default="<?=$acc->Username;?>">
                    </div>
                    <div class="form-group">
                      <label >Password</label>
                      <input type="password" class="form-control" placeholder="Password" name="pass" value="<?=$acc->Password;?>">
                    </div>
                  <!-- </div> -->
                  <?php endforeach;?>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <?php echo '<label class="text-danger">'.$this->session->flashdata("error").'</label>';  ?>
                </div>
              <!-- </form> -->
              <?php echo form_close()?>
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
