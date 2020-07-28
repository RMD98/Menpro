<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <!-- /.navbar -->
<!-- Font Awesome -->
<link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!-- jQuery -->
<script src="<?php echo base_url('plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('plugins/datatables/jquery.dataTables.js')?>"></script>
<script src="<?php echo base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('plugins/select2/js/select2.full.min.js')?>"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo base_url('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')?>"></script>
<!-- InputMask -->
<script src="<?php echo base_url('plugins/moment/moment.min.js')?>"></script>
<script src="<?php echo base_url('plugins/inputmask/min/jquery.inputmask.bundle.min.js')?>"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url('plugins/daterangepicker/daterangepicker.js')?>"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')?>"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo base_url('plugins/bootstrap-switch/js/bootstrap-switch.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('dist/js/adminlte.min.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('dist/js/demo.js')?>"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> -->
  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rapat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Departemen</li>
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
              <form role="form" action="<?php echo site_url()?>/welcome/add_rapat" method='post'>
                <div class="card-body">
                  <div class="form-group">
                    <label >Topik</label>
                    <input type="text" class="form-control" id="topik" name="topik">
                    <?php echo '<label class="text-danger">'.$this->session->flashdata("error").'</label>';  ?>
                  </div>
                  <div class="form-group">
                    <label >Tanggal Mulai</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control float-right" id="mulai" name="tgl_mulai">
                    </div>
                  </div>
                  <div class="bootstrap-timepicker">
                  <div class="form-group">
                    <label>Waktu Mulai</label>

                    <div class="input-group date" id="timemulai" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#timemulai" name="wkt_mulai"/>
                      <div class="input-group-append" data-target="#timemulai" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                      </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
                  <div class="form-group">
                    <label >Tanggal Selesai</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control float-right" id="akhir" name="tgl_akhir">
                    </div>
                  </div>
                  <div class="bootstrap-timepicker">
                  <div class="form-group">
                    <label>Waktu Selesai</label>
                    <div class="input-group date" id="timeakhir" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" data-target="#timeakhir" name="wkt_akhir"/>
                      <div class="input-group-append" data-target="#timeakhir" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                      </div>
                    <!-- /.input group -->
                  </div>
                  <div class="form-group">
                  <label>Peserta Rapat</label>
                  <select class="dosen" multiple="multiple" data-placeholder="pilih dosen" style="width: 100%;" name="tujuan[]">
                  </select>
                </div>
                  <!-- /.form group -->
                  <div class="form-group">
                    <label >Deskripsi</label>
                    <input type="text" class="form-control" id="mom" name="mom">
                  </div>
                </div>
                </div>
                <!-- /.card-body -->
                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <?php echo '<label class="text-danger">'.$this->session->flashdata("error").'</label>';  ?>
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

<!-- page script -->
<!-- <script>
  $(function () {
    // $("#example1").DataTable();
    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    // });
    $('#reservation').daterangepicker()
  });
</script> -->
<script>
$(document).ready(function() {
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      // timePicker: true,
      // timePickerIncrement: 30,
      singleDatePicker : true,
      locale: {
        format: 'YYYY-MM-DD'
      }
    })
    $('#mulai').daterangepicker({
      // timePicker: true,
      // timePickerIncrement: 30,
      singleDatePicker : true,
      locale: {
        format: 'YYYY-MM-DD'
      }
    })
    $('#akhir').daterangepicker({
      // timePicker: true,
      // timePickerIncrement: 30,
      singleDatePicker : true,
      locale: {
        format: 'YYYY-MM-DD'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timemulai').datetimepicker({
      format: 'hh:mm'
    })
    $('#timeakhir').datetimepicker({
      format: 'hh:mm'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
    
  }) 
      $.get( "http://localhost/menpro/index.php/welcome/getPegawai", function( data ) {
      dataDosen = data;
      console.log(dataDosen);
      $('.dosen').select2({
      data : dataDosen
});
});
    });
</script>
</body>
</html>
