<!DOCTYPE html>
<html>
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
            <h1>Detail Agenda</h1>
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
            <?php foreach ($agenda as $agenda) : ?>
            <div class="card-header">
                <div class="col-12" style="text-align: center;">
                  <a href="<?php echo site_url()?>/welcome/edit_agenda/<?php echo $agenda->IdRapat?>">
                    <button type="button" class="btn btn-primary float-right">Edit</button>
                  </a>
                  <h1> <?php echo $agenda->TopikRapat;?></h1>
                  <a href="<?php echo site_url()?>/welcome/Add_mom/<?php echo $agenda->IdRapat?>">
                    <button type="button" class="btn btn-primary float-right">Add MOM</button>
                  </a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <p> <?php echo $agenda->Deskripsi;?> </p>
                <p> Dimulai pada : <?php echo $agenda->TglMulai;?> <?php echo $agenda->WaktuMulai;?></p>
                <p> Selesai pada : <?php echo $agenda->TglAkhir;?> <?php echo $agenda->WaktuAkhir;?></p>
                <p></p>
                <p>MOM</p>
                <p><?php echo $agenda->MOM;?></p>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card-body -->
            <?php endforeach;?>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  
                  <th>Nama</th>
                  <th>Status</th>
                  <!-- <th>Tipe</th> -->
                </tr>
                </thead>
                <tbody>
                <?php foreach($anak as $anak): ?>
                <tr>
                  
                  <td><?=$anak->NamaPegawai?></td>
                  <td><?php if($anak->StatusSurat== 'N'): ?>
                    Belum Terkirim
                    <?php elseif($anak->StatusSurat== 'Y'): ?>
                      Sudah Terkirim
                  <?php endif ?>
                  </td>
                  <!-- <td>Single</td> -->
                  <!-- <td> -->
                  <!-- <a href="<?php echo site_url()?>/welcome/statusSurat/<?=$anak->IdSurat?>"> -->
                   <!-- <button type="submit" class="btn btn-primary float-right">Status</button> -->
                  <!-- </a> -->
                  <!-- <a href="<?php echo site_url()?>/welcome/add_departmen"> -->
                   <!-- <button type="submit" class="btn btn-warning float-right">Download</button>  -->
                  <!-- </a>
                  <!-- <a href="<?php echo site_url()?>/welcome/add_departmen" type="color:red;"> -->
                  <!-- <button type="submit" class="btn btn-danger float-right" >Delete</button> -->
                  <!-- </a> -->
                  <!-- </td> -->
                </tr>  
                <?php endforeach ?> 
                </tbody>
              </table>
            </div>
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
      swal("Sukses", "Data tersimpan sayang :)", "success");
    <?php endif ?>
    
});

</script>
</body>
</html>