[1mdiff --git a/application/controllers/Welcome.php b/application/controllers/Welcome.php[m
[1mindex 66fee0d..6164b00 100644[m
[1m--- a/application/controllers/Welcome.php[m
[1m+++ b/application/controllers/Welcome.php[m
[36m@@ -105,7 +105,8 @@[m [mclass Welcome extends CI_Controller {[m
           $this->load->view('add_departmen');[m
      }[m
      public function add_surat(){[m
[31m-          $this->load->view('add_surat');[m
[32m+[m[32m          $data['templateSK'] = json_decode($this->surat->get_properties_surat('1')->Input);[m
[32m+[m[32m          $this->load->view('add_surat',$data);[m
      }[m
      public function mom(){[m
           $this->load->view('mom');[m
[1mdiff --git a/application/models/surat.php b/application/models/surat.php[m
[1mindex 4e94f65..be37ffb 100644[m
[1m--- a/application/models/surat.php[m
[1m+++ b/application/models/surat.php[m
[36m@@ -5,13 +5,13 @@[m
     {[m
       $this->db->where('IdSK', $idSurat);[m
       $query = $this->db->get('tbl_sk');[m
[31m-      [m
[31m-      foreach ($query->result() as $row)[m
[31m-        {[m
[31m-        print_r($row->Input);[m
[31m-        echo $row->Tema;[m
[31m-        echo $row->Role;[m
[31m-        }[m
[32m+[m[41m    [m
[32m+[m[32m    //   foreach ($query->result() as $row)[m
[32m+[m[32m    //     {[m
[32m+[m[32m    //     $listInput = $row->Input;[m
[32m+[m[32m    //     }[m
[32m+[m[41m        [m
[32m+[m[32m        return $query->row();[m
     }[m
     function get_template_sk($role)[m
     {[m
[1mdiff --git a/application/views/add_surat.php b/application/views/add_surat.php[m
[1mindex ffa3836..cfd874e 100644[m
[1m--- a/application/views/add_surat.php[m
[1m+++ b/application/views/add_surat.php[m
[36m@@ -13,6 +13,9 @@[m
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">[m
   <!-- DataTables -->[m
   <link rel="stylesheet" href="<?php echo base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.css')?>">[m
[32m+[m[41m  [m
[32m+[m[32m  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />[m
[32m+[m
   <!-- Theme style -->[m
   <link rel="stylesheet" href="<?php echo base_url('dist/css/adminlte.min.css')?>">[m
   <!-- Google Font: Source Sans Pro -->[m
[36m@@ -293,12 +296,22 @@[m
               </div>[m
               <!-- /.card-header -->[m
               <!-- form start -->[m
[32m+[m[41m              [m
[32m+[m[32m              <?php foreach ($templateSK as $key=>$Input):[m
[32m+[m[32m                if($Input->type =='text'):?>[m
               <form role="form">[m
                 <div class="card-body">[m
                   <div class="form-group">[m
[31m-                    <label for="exampleInputEmail1">No. Surat</label>[m
[32m+[m[32m                    <label for="exampleInputEmail1"><?=$Input->label?></label>[m
                     <input type="text" class="form-control" >[m
                   </div>[m
[32m+[m[32m                  <?php endif?>[m
[32m+[m
[32m+[m[32m              <?php endforeach ?>[m
[32m+[m[41m                [m
[32m+[m[32m              <select class="js-data-example-ajax form-control" name="states[]" multiple="multiple"></select>[m
[32m+[m
[32m+[m
                   <!-- <div class="form-group">[m
                     <label for="exampleInputPassword1">Tanggal Buat</label>[m
                     <input type="text" class="form-control">[m
[36m@@ -306,6 +319,7 @@[m
                 <!-- </div> -->[m
                   <!-- /.card-body -->[m
                 <!-- </div> -->[m
[32m+[m
                 <div class="form-group">[m
                         <label>Kategori</label>[m
                         <select class="form-control">[m
[36m@@ -388,6 +402,9 @@[m
 <script src="<?php echo base_url('dist/js/adminlte.min.js')?>"></script>[m
 <!-- AdminLTE for demo purposes -->[m
 <script src="<?php echo base_url('dist/js/demo.js')?>"></script>[m
[32m+[m
[32m+[m[32m<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>[m
[32m+[m
 <!-- page script -->[m
 <script>[m
   $(function () {[m
[36m@@ -401,6 +418,19 @@[m
       "autoWidth": false,[m
     });[m
   });[m
[32m+[m
[32m+[m[32m  $(document).ready(function() {[m
[32m+[m[41m    [m
[32m+[m[32m    $('.js-data-example-ajax').select2({[m
[32m+[m[32m  ajax: {[m
[32m+[m[32m    url: 'https://api.github.com',[m
[32m+[m[32m    dataType: 'json'[m
[32m+[m[32m    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example[m
[32m+[m[32m  }[m
[32m+[m[32m});[m
[32m+[m[32m});[m
[32m+[m
 </script>[m
[32m+[m
 </body>[m
 </html>[m
