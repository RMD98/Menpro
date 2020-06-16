<!DOCTYPE html>
<html>
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
            <a href="<?php echo site_url()?>/welcome/detailSurat/<?= $this->session->userdata('status') ?>">
            <button type="submit" class="btn btn-primary float-right">list SK</button>
            </a>  
            <!-- <div class="col-6"> -->
            <!-- <a href="<?php echo site_url()?>/welcome/add_surat"> -->
            
            <!-- </a>   -->
          </div>
            <!-- /.card-header -->
            <div class="row">
            <?php foreach ($listSK as $key=>$listSK): 
              if (($key % 3 == 0)):
              ?>
              
              <a href="<?php echo base_url()?>welcome/add_surat/<?=$listSK->IdSK?>" class="col-md-2 ml-3 mt-3 ">
          <!-- <div class="col-lg-3 col-6 ml-3 mt-3"> -->
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner" style="height:220;">
                <h5 style ='text-align: center; margin-top:50%' ><?=$listSK->Tema?></h5>
              </div>
            </div>
          <!-- </div> -->
          </a>
          <?php elseif(($key % 3 ==1)): ?>
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-6 ml-3 mt-3"> -->
            <!-- small box -->
            <a href="<?php echo base_url()?>/welcome/add_surat/<?=$listSK->IdSK?>" class="col-md-2 ml-3 mt-3 ">
            <div class="small-box bg-success col-12">
              <div class="inner" style="height:220;">
                <h5 style ='text-align: center;'><?=$listSK->Tema?></sup></h5>
                
              </div>
            </div>
            </a>
          <!-- </div> -->
          <?php elseif(($key % 3 ==2)): ?>
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-6 ml-3 mt-3"> -->
            <!-- small box -->
            <a href="<?php echo base_url()?>index.php/welcome/add_surat/<?=$listSK->IdSK?>" class="col-md-2 ml-3 mt-3 ">
            <div class="small-box bg-danger">
              <div class="inner" style="height:220;">
                <h5 style ='text-align: center; margin-top:50%'><?=$listSK->Tema?></sup></h5>
                
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
