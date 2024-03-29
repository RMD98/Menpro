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
            <h1>Data Mom</h1>
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
            <div class="card-header">
            <!-- <div class="col-6"> -->
              <a href="<?php echo site_url()?>/welcome/add_agenda">
              <button type="submit" class="btn btn-primary float-right">Add</button>
              </a>
            </div>  
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Id Agenda</th>
                  <th>Topik Agenda</th>
                  <th>Waktu Agenda</th>
                  <th>MOM</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($mom as $mom) :?>
                <tr>
                  <td><?php echo $mom->IdRapat ;?></td>
                  <td><?php echo $mom->TopikRapat ;?></td>
                  <td><?php echo $mom->TglMulai ;?> - <?php echo $mom->TglAkhir ;?></td>
                  <td><?php echo $mom->MOM ;?></td>
                  <td><a href="<?php echo site_url()?>/welcome/edit_agenda/<?php echo $mom->IdRapat;?>">
                   <button type="submit" class="btn btn-warning float-right">Edit</button>
                  </a>
                  <a href="<?php echo site_url()?>/welcome/delete_rapat" type="color:red;">
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

</body>
</html>
