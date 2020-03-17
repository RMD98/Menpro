<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | DataTables</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('dist/css/adminlte.min.css')?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>SK</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url()?>/welcome/logedin">Home</a></li>
              <li class="breadcrumb-item active">SK</li>
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
            <!-- <a href="<?php echo site_url()?>/welcome/add_surat"> -->
            <select type="formcontrol" class="btn btn-primary float-left">
            <option> Surat Keputusan </option>
            <option> Surat Keterangan </option>
            </Select>
            <!-- </a>   -->
          </div>
            <!-- /.card-header -->
            <div class="row">
            <?php foreach ($listSK as $key=>$listSK): 
              if (($key % 3 == 0)):
              ?>
              
              <a href="<?php echo base_url()?>/welcome/add_surat/<?=$listSK->IdSK?>" class="col-md-2 ml-3 mt-3 ">
          <!-- <div class="col-lg-3 col-6 ml-3 mt-3"> -->
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h5 style ='text-align: center' ><?=$listSK->Tema?></h5>
              </div>
            </div>
          <!-- </div> -->
          </a>
          <?php elseif(($key % 3 ==1)): ?>
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-6 ml-3 mt-3"> -->
            <!-- small box -->
            <a href="<?php echo base_url()?>/welcome/add_surat/<?=$listSK->IdSK?>" class="col-md-2 ml-3 mt-3 ">
            <div class="small-box bg-success">
              <div class="inner">
                <h5 style ='text-align: center'><?=$listSK->Tema?></sup></h5>
                
              </div>
            </div>
            </a>
          <!-- </div> -->
          <?php elseif(($key % 3 ==2)): ?>
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-6 ml-3 mt-3"> -->
            <!-- small box -->
            <a href="<?php echo base_url()?>/welcome/add_surat/<?=$listSK->IdSK?>" class="col-md-2 ml-3 mt-3 ">

            <div class="small-box bg-danger">
              <div class="inner">
                <h5 style ='text-align: center'><?=$listSK->Tema?></sup></h5>
                
              </div>
            </div>
            </a>
          <!-- </div> -->
          <?php endif; 
              endforeach ?>
         
                    
          <!-- ./col -->
        </div>
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
