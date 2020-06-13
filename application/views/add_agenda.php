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
            <h1>DataTables</h1>
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
                  <label>NIP</label>
                  <select class="form-control select" style="width: 100%;" name="nip">
                    <?php foreach ($pgw as $pgw) :?>  
                      <option><?php echo $pgw->Nip;?></option>
                    <?php endforeach;?>
                  </select>
                </div>
                  <div class="form-group">
                    <label >Topik</label>
                    <input type="text" class="form-control" id="topik" name="topik">
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
                  <!-- /.form group -->
                  <div class="form-group">
                    <label >MOM</label>
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
</script>
</body>
</html>
