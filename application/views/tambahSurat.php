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
            <h1><?=$JudulSK?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url()?>/welcome/logedin_user">Home</a></li>
              <li class="breadcrumb-item active">Tambah Surat</li>
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
              <form role="form" method="POST" action="<?php echo base_url()?>welcome/saveWord">
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Jenis</label>
                    <select type="formcontrol" class="btn btn-primary form-control" name="jenis">
                  <option> Surat Keputusan </option>
                  <option> Surat Keterangan </option>
                </Select> 
                  </div>         
              <?php foreach ($templateSK as $key=>$Input):
                if($Input->type =='text'):?>
                  <div class="form-group">
                    <label for="exampleInputEmail1"><?=$Input->label?></label>
                    <input type="text" class="form-control" name="<?=$key?>"> 
                  </div>
                  <?php elseif ($Input->type =='textSugestion'):?>
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?=$Input->label?></label>
                    <select class="<?=$Input->source?> form-control" name="<?=$key?>"></select>
                  </div>
                  <?php elseif ($Input->type =='array'):?>
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?=$Input->label?></label>
                    <select class="<?=$Input->source?> form-control" name="<?=$key?>[]" multiple="multiple"></select>
                  </div>
                  <?php elseif ($Input->type =='datePicker'):?>
                    <div class="form-group">
                    <label for="exampleInputEmail1"><?=$Input->label?></label>
                    <input id=<?=$Input->name?> type="text" name="<?=$key?>" value="" class="form-control"/> 
                  </div>
                  <?php elseif ($Input->type =='longText'):?>
                  <div class="form-group">
                  <label for="exampleInputEmail1"><?=$Input->label?></label>
                    <textarea type="text" class="form-control" rows="3" name="<?=$key?>"></textarea>
                  </div>
                  <?php endif?>
              <?php endforeach ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Validasi</label>
                    <select class="dosen form-control" name="validasi"></select>
                  </div>
                  <!-- <div class="form-group">
                    <label for="exampleInputPassword1">Tanggal Buat</label>
                    <input type="text" class="form-control">
                  </div> -->
                <!-- </div> -->
                  <!-- /.card-body -->
                <!-- </div> -->
                <!--<div class="form-group">
                  <input type="text" class="form-control">
                </div> -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Generate</button>
                </div>
                <!-- <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div> -->
                <!-- /.card-body -->
              </div>
              </form>
              </div>
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

<!-- Bootstrap 4 -->
<script src="<?php echo base_url('plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- page script -->
<script>
  
  $(document).ready(function() {
    $(function() {
  $('#rangeTanggal').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('#rangeTanggal').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
  });

  $('#rangeTanggal').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });
  $('#rangeTanggalWaktu').daterangepicker({
    timePicker: true,
    timePicker24Hour:true,
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(32, 'hour'),
    locale: {
      format: 'M/DD hh:mm'
    }
  });
  $('#tanggalWaktu').daterangepicker({
    timePicker: true,
    timePicker24Hour:true,
    singleDatePicker: true,
    showDropdowns: true,
    locale: {
      format: 'M/DD hh:mm'
    }
  });
  $('#tanggal').daterangepicker({
    timePicker: true,
    singleDatePicker: true,
    showDropdowns: true,
    locale: {
      format: 'DD-MM-YYYY'
    }
  });
   
});
    var dataDosen;
    var dataJurusan;
    var dataMatkul;
    <?php if($this->session->flashdata('statusInsert')=='sukses') :?>
      swal("Sukses", "Data berhasil tersimpan", "success");
    <?php endif ?>
    $.get( "http://localhost/menpro/index.php/welcome/getPegawai", function( data ) {
      dataDosen = data;
      console.log(dataDosen);
      $('.dosen').select2({
      data : dataDosen
});
      });
      $.get( "http://localhost/menpro/index.php/welcome/getJurusan", function( data ) {
      dataJurusan = data;
      console.log(dataJurusan);
      $('.jurusan').select2({
      data : dataJurusan
});
      });
      $.get( "http://localhost/menpro/index.php/welcome/getMatkul", function( data ) {
      dataMatkul = data;
      console.log(dataJurusan);
      $('.matkul').select2({
      data : dataMatkul
});
      });
});
</script>
</body>
</html>
