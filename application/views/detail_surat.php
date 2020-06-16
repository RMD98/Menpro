<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Itenise</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.css')?>">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('dist/css/adminlte.min.css')?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Surat</h1>
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
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <!-- <th>Id Surat</th> -->
                  <th>NIP</th>
                  <th>Nama</th>
                  <th>Jabatan</th>
                  <th>Departement</th>
                  <th>Status Surat</th>
                  <?php if($this->session->userdata('status') == 'ekspedisi'): ?>
                  <th></th>
                  <?php endif ?>
                  <!-- <th>Tipe</th> -->
                </tr>
                </thead>
                <tbody>
                <?php foreach($DetailSurat as $DetailSurat): ?>
                <tr>
                  <!-- <td>1</td> -->
                    <td><?=$DetailSurat->NIP?></td>
                    <td><?=$DetailSurat->NamaPegawai?></td>
                    <td><?=$DetailSurat->jabatan?></td>
                    <td><?=$DetailSurat->NamaDepartement?></td>
                    <?php if($DetailSurat->StatusSurat == 'Y'): ?>
                        <td>Sudah Terkirim</td>
                    <?php elseif($DetailSurat->StatusSurat == 'N'): ?>
                        <td>Belum Terkirim</td>
                    <?php endif ?>
                    <?php if($this->session->userdata('status') == 'ekspedisi'): ?>
                    <td>
                    <?php if($DetailSurat->StatusSurat == 'N'): ?>
                      <a href="<?php echo site_url()?>/welcome/changeStatusSurat/<?=$DetailSurat->IdStaffSurat?>/<?=$DetailSurat->IdSurat?>">
                   <button type="submit" class="btn btn-primary float-right">Ubah Status</button>
                       </a>
                    <?php endif ?>
                  </td>
                  <?php endif ?>
                  <!-- <td>Single</td> -->
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
  $(document).ready(function() {
    <?php if($this->session->flashdata('statusInsert')=='sukses') :?>
      swal("Sukses", "Data berhasil tersimpan", "success");
    <?php endif ?>
});
</script>
</body>
</html>