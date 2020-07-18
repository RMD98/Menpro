<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
     /**
      * Index Page for this controller.
	 *
      * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
      * config/routes.php, it's displayed at http://example.com/
	 *
      * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
      * @see https://codeigniter.com/user_guide/general/urls.html
	 */

          public function __construct() {
               parent::__construct();
               $this->load->model('main_models');
               $this->load->model('surat');
               $this->load->model('test');
               $this->load->model('notif');
               $this->load->library('encryption');
               $this->load->helper('download');
               date_default_timezone_set("Asia/Jakarta");
          }
          public function index(){
               // parent::__construct();
               // $this->load->library('session');
               if($this->session->userdata('id') == '') 
               {
                    $this->load->view('login');
                    //$data = $this->session->all_userdata();
                    // echo($this->session->userdata());
               }
               else 
               { 
                    redirect(site_url().'/welcome/logedin',$session_data);
               }
          }
          public function register(){
               $this->load->view('register');

          }
          public function logedin(){
               // $this->load->model('main_models');
               //   $data['produk'] = $this->main_models->daftar_produk();
               $this->load->view('temp/head');
               if($this->session->userdata('id') == '') 
               {
                    $this->load->view('login');
                    //$data = $this->session->all_userdata();
                    // echo($this->session->userdata());
               }
               else 
               { 
               //    redirect(site_url().'/welcome/logedin',$session_data);
                    if($this->session->userdata('status') == 'admin') {
                    $this->load->view('temp/sidebar');
                    } 
                    elseif($this->session->userdata('status') == 'dosen') 
                    {
                         $this->load->view('temp/sidebar_dosen');
                    }
                    elseif($this->session->userdata('status') == 'ekspedisi') 
                    {
                         $this->load->view('temp/sidebar_ekspedisi');
                    }
                    elseif($this->session->userdata('status') == 'rektor'||'fakultas'||'jurusan'||'lppm') 
                    {
                         $this->load->view('temp/sidebar_unit');
                    }
               }
               $data['total'] = count($this->surat->listSuratMasuk($this->session->userdata('NIP')))+
                    count($this->main_models->filter_rapat($this->session->userdata('NIP')));
               $data['keputusan'] = count($this->surat->listSuratMasuk($this->session->userdata('NIP')));
               $data['rapat'] = count($this->main_models->filter_rapat($this->session->userdata('NIP')));
               $this->load->view('index2',$data);
               $this->load->view('temp/footer');
               $this->load->view('temp/js');
          }
          public function getPegawai(){
               header('Content-Type: application/json');
               $data = json_encode($this->surat->listPegawai(),true);
               echo $data;
          }
          public function getUsername(){
               header('Content-Type: application/json');
               $data = json_encode($this->surat->listUsername(),true);
               echo $data;
          }
          public function getJurusan(){
               header('Content-Type: application/json');
               $data = json_encode($this->surat->listJurusan(),true);
               echo $data;
          }
          
          public function LoginApi(){
               header('Content-Type: application/json');
               $username = $_POST['username'];
               $password = $_POST['password'];
               $login_data = $this->main_models->can_login($username, $password);
               if($login_data['Status'] != ''){
                    $data = $this->main_models->get_pegawai($login_data['NIP']);
                    $userData = array(  
                         'id'           => $login_data['id'],
                         'username'     => $_POST['username'],
                         'status'       => $login_data['Status'],
                         'Nama'         => $data[0]->NamaPegawai,
                         'NIP'          => $login_data['NIP'] 
                    ); 
                    $send = array(
                         'status'  =>200,
                         'error'   =>false,
                         'user'    =>$userData,
                         'message' =>'sukses'
                    );
               }else{
                    $send = array(
                         'error'=>true,
                         'status' => 500,
                         'message'=> 'password salah'
                    );
               }
               $kirim = json_encode($send);
               echo $kirim;
          }
          public function tambahSurat(){
               $this->load->view('temp/head');
               $this->load->view('temp/js');
               if($this->session->userdata('status') == 'admin') {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar',$data);
               } 
               elseif($this->session->userdata('status') == 'dosen') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_dosen',$data);
               }
               elseif($this->session->userdata('status') == 'ekspedisi') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_ekspedisi',$data);
               }
               elseif($this->session->userdata('status') == 'rektor'||'fakultas'||'jurusan'||'lppm') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_unit',$data);
               }
               
               $this->load->view('tambahSurat');
               $this->load->view('temp/footer');
          }
          public function getMatkul(){
               header('Content-Type: application/json');
               $data = json_encode($this->surat->listMatkul(),true);
               echo $data;
          }  
          public function generateWord($id){
               $Topik = $this->surat->get_properties_surat($id)->Tema;
               $tipe = $this->input->post('jenis');
               $response = $this->notif->sendMessage($Topik,$tipe,'asd');
               $Parameter = json_decode($this->surat->get_properties_surat($id)->Parameter);
               $Temp = json_encode($this->input->post());
               $NoSurat = ($this->surat->getlast("tbl_surat","IdSurat")->IdSurat)+1;    
               $unik = date("Y-m-d_h-i-s");
               $filename = $this->surat->get_properties_surat($id)->FileTemplate;
               $template = "resource/{$filename}";
               $hasil = "results/{$unik}{$filename}";
               $pdf = "results/pdf/{$unik}{$filename}";
               $x = explode('.',$pdf);
               $pdf = $x[0].'.pdf';
               $data = array_merge($this->input->post(), $this->surat->getDetailAccount($this->session->userdata('NIP')));
               try{
                    $data['NipSurat']=$this->surat->getDetailDosen('NamaPegawai',$this->input->post('dosenSurat'))['Nip'];
               }
               catch(Exception $e) {
                    echo 'Message: ' .$e->getMessage();
                  }
                  $NipValidator = $this->surat->getWhere('tbl_account','Username',$this->input->post('validasi'))->NIP;
                  $lokasi = $this->surat->generateWord($template,$hasil,$data,$Parameter,$NoSurat);
               $idGdrive=$this->surat->converter($hasil,$pdf);  
               $this->surat->insertSurat($id,$Temp,$Topik,$NoSurat,$lokasi,$NipValidator,$this->session->userdata('NIP'),$pdf,$idGdrive);
               $idSurat = $this->surat->getLast('tbl_surat','IdSurat')->IdSurat;
               foreach ($this->input->post() as $val=>$key) {
                    if(count($val) > 1 or $val == 'dosenSurat' or $val == 'tujuan' or $val =='dosen' or $val =='pimpinan' or $val == 'rekan' 
                         or $val =='ketuaDosen' ){
                         if(is_array($key)){
                              foreach($key as $x ){
                                   $NIP = $this->surat->getWhere('tbl_pegawai','NamaPegawai',$x)->Nip;
                                   $this->surat->insertDetailSurat($idSurat,$NIP);  
                              }
                         }else{
                              // die;
                              $NIP = $this->surat->getWhere('tbl_pegawai','NamaPegawai',$key)->Nip;
                              $this->surat->insertDetailSurat($idSurat,$NIP);
                         }
                    }
               }
               $this->session->set_flashdata('statusInsert','sukses' );
               $this->session->set_flashdata('download',$lokasi );
               force_download($lokasi, NULL);
               redirect("welcome/add_surat/$id");
          }
          public function statusSurat($idSurat){
               $data['DetailSurat'] = $this->surat->listDetailSurat($idSurat);
               $this->load->view('temp/head');
               $this->load->view('temp/js');
               if($this->session->userdata('status') == 'admin') {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar',$data);
               } 
               elseif($this->session->userdata('status') == 'dosen') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_dosen',$data);
               }
               elseif($this->session->userdata('status') == 'ekspedisi') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_ekspedisi',$data);
               }
               elseif($this->session->userdata('status') == 'rektor'||'fakultas'||'jurusan'||'lppm') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_unit',$data);
               }
               
               $this->load->view('detail_surat',$data);
               $this->load->view('temp/footer');
          }
          public function detailSurat($role){
               $data['DetailSurat'] = $this->surat->listSurat();
               $this->load->view('temp/head');
               $this->load->view('temp/js');
               if($this->session->userdata('status') == 'admin') {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar',$data);
               } 
               elseif($this->session->userdata('status') == 'dosen') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_dosen',$data);
               }
               elseif($this->session->userdata('status') == 'ekspedisi') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_ekspedisi',$data);
               }
               elseif($this->session->userdata('status') == 'rektor'||'fakultas'||'jurusan'||'lppm') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_unit',$data);
               }
               $this->load->view('list_sk',$data);
               $this->load->view('temp/footer');
          }
          public function changeStatusSurat($IdSuratStaff=0,$IdSurat=0){
               $this->surat->updateStatusSurat($IdSuratStaff);
               $this->session->set_flashdata('statusInsert','sukses' );
               redirect("welcome/statusSurat/$IdSurat");
          }
          public function changeStatusValidasi($idSurat){
               $this->surat->updateStatusValidasi($idSurat);
               $this->surat->validasiSurat($this->surat->listDetailSuratValidasi($idSurat));
               $this->session->set_flashdata('status','sukses' );
               redirect(site_url()."welcome/validation");
          }
          public function pegawai()
          {
               $data['tbl_pegawai'] = $this->main_models->daftar_pegawai();
               $this->load->view('temp/head');
               $this->load->view('temp/sidebar');
               $this->load->view('pegawai',$data);
               $this->load->view('temp/footer');
               $this->load->view('temp/js');
          }
          public function getSuratMasuk(){
               header('Content-Type: application/json');
               $data = $this->surat->listSuratMasuk($_POST['NIP']);
               $send = array(
                    'status'  =>200,
                    'error'   =>false,
                    'surat'    =>$data,
                    'message' =>'sukses'
               );
               $kirim = json_encode($send);
               echo $kirim;
          }
          public function getRapat(){
               header('Content-Type: application/json');
               $Nip = $_POST['NIP'];
               $data = $this->main_models->rapatNip($Nip);
               $send = array(
                    'status'  =>200,
                    'error'   =>false,
                    'rapat'    =>$data,
                    'message' =>'sukses'
               );
               $kirim = json_encode($send);
               echo $kirim;
          }
          public function test(){
               $tujuan = "results/pdf/2020-07-13_02-24-17lppkm_pkm.pdf";
               $this->surat->uploadGDrive($tujuan);
               echo("asd");
          //      $client = new Google_Client();
          // $client->setClientId('884287143758-8ijne85l8hshui9tganmog921edc8jj6.apps.googleusercontent.com');
          // $client->setClientSecret('mkVoLL4NBnf_oVvjODtwLAte');
          // $client->setRedirectUri("http://localhost/menpro/index.php/welcome/testAja");
          // $client->setScopes(array('https://www.googleapis.com/auth/drive'));
          // if (isset($_GET['code'])) {
          //      $_SESSION['accessToken'] = $client->authenticate($_GET['code']);
          //      header('location:'.$url);exit;
          //  } elseif (!isset($_SESSION['accessToken'])) {
          //      $client->authenticate();
          //  }
          }
          public function inbox(){
               $data['SuratMasuk'] = $this->surat->listSuratMasuk($this->session->userdata('NIP'));
               $this->load->view('temp/head');
               if($this->session->userdata('id') == '') 
               {
                    $this->load->view('login');
                    //$data = $this->session->all_userdata();
                    // echo($this->session->userdata());
               }
               else 
               { 
                    // redirect(site_url().'/welcome/logedin',$session_data);
                    if($this->session->userdata('status') == 'admin') {
                         $data['nama'] = $this->session->userdata('Nama');
                         $this->load->view('temp/sidebar',$data);
                    } 
                    elseif($this->session->userdata('status') == 'dosen') 
                    {
                         $data['nama'] = $this->session->userdata('Nama');
                         $this->load->view('temp/sidebar_dosen',$data);
                    }
                    elseif($this->session->userdata('status') == 'ekspedisi') 
                    {
                         $data['nama'] = $this->session->userdata('Nama');
                         $this->load->view('temp/sidebar_ekspedisi',$data);
                    }
                    elseif($this->session->userdata('status') == 'rektor'||'fakultas'||'jurusan'||'lppm') 
                    {
                         $data['nama'] = $this->session->userdata('Nama');
                         $this->load->view('temp/sidebar_unit',$data);
                    }
                    $this->load->view('inbox',$data);
                    $this->load->view('temp/footer');
                    $this->load->view('temp/js');
               }
          }
          public function downloadSurats($id){
               $file = $this->surat->getWhere('tbl_surat','IdSurat',$id);
               force_download($file->File, NULL);
               redirect(site_url().'/welcome/inbox');
          }
          public function validation(){
               $data['validasi'] = $this->surat->listValidasi($this->session->userdata('NIP'));
               $this->load->view('temp/head');
               $this->load->view('temp/js');
               if($this->session->userdata('id') == '') 
               {
                    $this->load->view('login');
                    //$data = $this->session->all_userdata();
                    // echo($this->session->userdata());
               }
               else 
               { 
                    // redirect(site_url().'/welcome/logedin',$session_data);
                    if($this->session->userdata('status') == 'admin') {
                         $data['nama'] = $this->session->userdata('Nama');
                         $this->load->view('temp/sidebar',$data);
                    } 
                    elseif($this->session->userdata('status') == 'dosen') 
                    {
                         $data['nama'] = $this->session->userdata('Nama');
                         $this->load->view('temp/sidebar_dosen',$data);
                    }
                    elseif($this->session->userdata('status') == 'ekspedisi') 
                    {
                         $data['nama'] = $this->session->userdata('Nama');
                         $this->load->view('temp/sidebar_ekspedisi',$data);
                    }
                    elseif($this->session->userdata('status') == 'rektor'||'fakultas'||'jurusan'||'lppm') 
                    {
                         $data['nama'] = $this->session->userdata('Nama');
                         $this->load->view('temp/sidebar_unit',$data);
                    }
                    $this->load->view('validation',$data);
                    $this->load->view('temp/footer');
                    
               }
          }
          public function outbox(){
               $data['SuratKeluar'] = $this->surat->listSuratMasuk($this->session->userdata('NIP'));
               $this->load->view('temp/head');
               if($this->session->userdata('status') == 'admin') {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar',$data);
               } 
               elseif($this->session->userdata('status') == 'dosen') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_dosen',$data);
               }
               elseif($this->session->userdata('status') == 'ekspedisi') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_ekspedisi',$data);
               }
               elseif($this->session->userdata('status') == 'rektor'||'fakultas'||'jurusan'||'lppm') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_unit',$data);
               }
          
               $this->load->view('outbox',$data);
               $this->load->view('temp/footer');
               $this->load->view('temp/js');
          }    
          public function ekspedisi(){
               $data['SuratEkspedisi'] = $this->surat->listSurat();
               if($this->session->userdata('status') == 'admin') {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar',$data);
               } 
               elseif($this->session->userdata('status') == 'dosen') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_dosen',$data);
               }
               elseif($this->session->userdata('status') == 'ekspedisi') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_ekspedisi',$data);
               }
               elseif($this->session->userdata('status') == 'rektor'||'fakultas'||'jurusan'||'lppm') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_unit',$data);
               }
               $this->load->view('temp/head');
               $this->load->view('ekspedisi',$data);
               $this->load->view('temp/footer');
               $this->load->view('temp/js');
          }
          public function surat(){
               $data['listSK'] = $this->surat->get_template_sk($this->session->userdata('status'));
               // print_r($data);
               $token = $this->surat->setGdrive();
               $fp = fopen('results.json', 'w');
               fwrite($fp, json_encode($token));
               fclose($fp);
               $this->load->view('temp/head');
               if($this->session->userdata('status') == 'admin') {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar',$data);
               } 
               elseif($this->session->userdata('status') == 'dosen') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_dosen',$data);
               }
               elseif($this->session->userdata('status') == 'ekspedisi') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_ekspedisi',$data);
               }
               elseif($this->session->userdata('status') == 'rektor'||'fakultas'||'jurusan'||'lppm') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_unit',$data);
               }
               // $this->load->view('index2');
               $this->load->view('surat',$data);
               $this->load->view('temp/footer');
               $this->load->view('temp/js');
	     }
          public function data_surat(){
               $this->load->view('temp/head');
               $this->load->view('temp/sidebar');
               $this->load->view('data_surat');
               $this->load->view('temp/footer');
               $this->load->view('temp/js');
          }
          public function account(){
               $data['tbl_account'] = $this->main_models->daftar_account();
               $this->load->view('temp/head');
               $this->load->view('temp/sidebar');
               $this->load->view('account',$data);
               $this->load->view('temp/footer');
               $this->load->view('temp/js');
          }
          public function add_departmen(){
               $this->load->view('temp/head');
               $this->load->view('temp/sidebar');
               $this->load->view('add_departmen');
               $this->load->view('temp/footer');
               $this->load->view('temp/js');
          }
          public function add_surat($key){
               $this->load->view('temp/head');
               if($this->session->userdata('status') == 'admin') {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar',$data);
               } 
               elseif($this->session->userdata('status') == 'dosen') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_dosen',$data);
               }
               elseif($this->session->userdata('status') == 'ekspedisi') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_ekspedisi',$data);
               }
               elseif($this->session->userdata('status') == 'rektor'||'fakultas'||'jurusan'||'lppm') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_unit',$data);
               }
               // $this->load->view('temp/js');
               $data['templateSK'] = json_decode($this->surat->get_properties_surat($key)->Input);
               $data['IdSK'] = $this->surat->get_properties_surat($key)->IdSK;
               $data['JudulSK'] = $this->surat->get_properties_surat($key)->Tema;
               $this->load->view('add_surat',$data);
          }
          public function add_agenda(){
               
               $this->load->view('temp/head');
               // $this->load->view('temp/js');
               if($this->session->userdata('status') == 'admin') {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar',$data);
               } 
               elseif($this->session->userdata('status') == 'rektor'||'fakultas'||'jurusan'||'lppm') 
               {
                    $this->load->view('temp/sidebar_unit');
               }
               elseif($this->session->userdata('status') == 'dosen') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_dosen',$data);
               }
               elseif($this->session->userdata('status') == 'ekspedisi') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_ekspedisi',$data);
               }
               $this->load->model('main_models');
               $data['pgw'] = $this->main_models->daftar_pegawai();
               $this->load->view('add_agenda',$data);
               // $this->load->view('index2');
               // echo $this->session->userd?ata('status');
               // $this->load->view('temp/js');
               $this->load->view('temp/footer');
          }
          public function add_pegawai(){
               $this->load->view('temp/head');
               if($this->session->userdata('status') == 'admin') {
                    $this->load->view('temp/sidebar');
               } 
               elseif($this->session->userdata('status') == 'rektor'||'fakultas'||'jurusan'||'lppm') 
               {
                    $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar_unit',$data);
               }
               elseif($this->session->userdata('status') == 'dosen') 
               {
                    $this->load->view('temp/sidebar_dosen');
               }
               elseif($this->session->userdata('status') == 'ekspedisi') 
               {
                    $this->load->view('temp/sidebar_ekspedisi');
               }
               $this->load->model('main_models');
               $data['pgw'] = $this->main_models->daftar_pegawai();
               $this->load->view('add_pegawai');
               // $this->load->view('index2');
               // echo $this->session->userd?ata('status');
               // $this->load->view('temp/js');
               $this->load->view('temp/footer');
          }
          public function mom(){
               $data['mom'] = $this->main_models->daftar_rapat();
               $this->load->view('temp/head');
               $this->load->view('temp/sidebar');
               $this->load->view('mom',$data);
               $this->load->view('temp/footer');
               $this->load->view('temp/js');
          }
          public function departemen(){
               $data['dprt'] = $this->main_models->daftar_departemen();
               $this->load->view('temp/head');
               $this->load->view('temp/sidebar');
               $this->load->view('departemen',$data);
               $this->load->view('temp/footer');
               $this->load->view('temp/js');
          }
          public function agenda(){
               $this->load->model('main_models');
               $this->load->view('temp/head');
               // $surat['srt'] = $this->main_models->filter_rapat();
               if($this->session->userdata('status') == 'admin') {
                    $data['agenda'] = $this->main_models->daftar_rapat();
                    // $data['nama'] = $this->session->userdata('Nama');
                    $this->load->view('temp/sidebar');
               }
               elseif($this->session->userdata('status') == 'dosen') 
               {   
                    $data['agenda'] = $this->main_models->filter_rapat();
                    $this->load->view('temp/sidebar_dosen');
               }
               elseif($this->session->userdata('status') == 'ekspedisi') 
               {   
                    $data['agenda'] = $this->main_models->filter_rapat();
                    $this->load->view('temp/sidebar_ekspedisi');
               }
               elseif($this->session->userdata('status') == 'rektor'||'fakultas'||'jurusan'||'lppm') 
               {
                    $data['agenda'] = $this->main_models->filter_rapat();
                    $this->load->view('temp/sidebar_unit');
               }
             
               $this->load->view('agenda',$data);
               // $this->load->view('index2');
               // echo $this->session->userdata('status');
               // $this->load->view('temp/js');
               $this->load->view('temp/footer');
               $this->load->view('temp/js');
          }
          function login(){  
               $this->load->helper(array('form','url'));
               $this->load->library('form_validation');  
               $this->form_validation->set_rules('Username', 'username', 'required');  
               $this->form_validation->set_rules('Password', 'password', 'required');  
               if($this->form_validation->run())  
               {  
                    //true  
                    $username = $this->input->post('Username');  
                    $password = $this->input->post('Password');  
                    //model function  
                    $login_data = $this->main_models->can_login($username, $password);
                    $data = $this->main_models->get_pegawai($login_data['NIP']);
                    if($login_data['Status'] != '')  
                    {  
                        foreach ($data as $data) :
                              $session_data = array(  
                                   'id'           => $login_data['id'],
                                   'username'     => $username,
                                   'status'       => $login_data['Status'],
                                   'Nama'         => $data->NamaPegawai,
                                   'NIP'          => $login_data['NIP'] 
                              );  
                              $this->session->set_userdata($session_data);  
                         endforeach;
                         redirect(site_url().'/welcome/logedin',$session_data);
                    }  
                    else  
                    {  
                         $this->session->set_flashdata('error', 'Invalid Username and Password');  
                         redirect(site_url() . '/welcome');  
                    }  
               }  
               else  
               {  
                    $this->session->set_flashdata('error', 'Invalid Username and Password');  
                    redirect(site_url() . '/welcome');  
               }  
          } 
          function logout(){  
               $user_data = $this->session->all_userdata();
               foreach ($user_data as $key => $value) {
               if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                    $this->session->unset_userdata($key);
                    }
               }
               $this->index();
          }
          function forget_pass(){
               $this->load->view('login2');
          }
          public function forget_password(){
               $uname = $this->input->post('uname');
               $data=$this->main_models->find_emails($uname);
               foreach ($data as $data) :
                    echo $data['Username'];
                    if($data['id']!='')
                    {
                         $message = 'Click the link to reset password';
                         $this->sendmail($data['Email'],site_url().'/welcome/reset_pass/'.$this->encryption->encrypt($data['id']),$message);
               //      $encrypt=$this->encryption->encrypt($data['Nip']);
               //      $decrypt = $this->encryption->decrypt($encrypt);
               //      // // echo $encrypt;
               //      echo $decrypt;
               //      // echo $data['Email'];
               
                    }
                    else
                    {
                         $this->session->set_flashdata('error', 'Email not Found');  
                         redirect(site_url() . '/welcome/forget_pass'); 
                    }
               endforeach;
               
          }
          public function reset_pass($id){
               $data['acc'] = $this->main_models->get_account($this->encryption->decrypt($id));
               $data['code'] = $id; 
               $this->load->view('reset_pass',$data);
               // echo $id;//$this->encryption->decrypt($id);
               echo $this->encryption->decrypt($id);
          }
          function reset_password($id){
               $code = $this->encryption->decrypt($id);
               if($this->input->post('nP')==$this->input->post('cP'))
               {
                    $data =$this->input->post('nP');
                    $this->main_models->reset_pass($id,$data);
                    redirect(site_url());
               }
               else
               {
                    $this->session->set_flashdata('error', 'Password did not match');  
                    redirect(site_url() . '/welcome/reset_pass/'.$this->encryption->encrypt($id)); 
               }
          }  
          function add_rapat(){
               $this->load->library('form_validation');
               // $this->load->library('form_validation');
               $this->form_validation->set_rules('nip', 'NIP','required');  
               $this->form_validation->set_rules('topik', 'TopikRapat', 'required');  
               $this->form_validation->set_rules('tgl_awal', 'TglMulai', 'required');  
               $this->form_validation->set_rules('wkt_awal', 'WaktuMulai', 'required');  
               $this->form_validation->set_rules('tgl_akhir', 'TglAkhir', 'required');  
               $this->form_validation->set_rules('wkt_akhir', 'WaktuAkhir', 'required');
               $this->form_validation->set_rules('mom', 'MOM', 'required');
               if($this->form_validation->run()){
                    $agenda = array(
                         'NIP'           => $this->session->userdata('NIP'),
                         'TopikRapat'    => $this->input->post('topik'),
                         'TglMulai'      => $this->input->post('tgl_mulai'),
                         'WaktuMulai'    => $this->input->post('wkt_mulai'),
                         'TglAkhir'      => $this->input->post('tgl_akhir'),
                         'WaktuAkhir'    => $this->input->post('wkt_akhir'),
                         'MOM'           => $this->input->post('mom')
                    );
                    $this->load->model('main_models');
                    $idRapat = $this->surat->getLast('tbl_rapat','IdRapat')->IdRapat;
                    $this->main_models->tambah_rapat($agenda);
                    foreach ($this->input->post('tujuan') as $val=>$key) {
                         $NIP = $this->surat->getWhere('tbl_pegawai','NamaPegawai',$key)->Nip;
                         $this->main_models->insert_anak($idRapat,$NIP);
                    }
                    $response = $this->notif->sendMessage($agenda['TopikRapat'],"Rapat",'asd');
                    redirect(site_url().'/welcome/agenda');
               }
               else {
                redirect(site_url().'/welcome/add_agenda');
               }
          }
          function tmbh_pegawai(){
               $this->load->helper(array('form','url'));
               $this->load->library('form_validation');
               $this->form_validation->set_rules('nip', 'NIP', 'required');  
               $this->form_validation->set_rules('nama', 'namapegawai', 'required');  
               $this->form_validation->set_rules('tgl', 'tanggallahir', 'required');  
               $this->form_validation->set_rules('tpt', 'tempatlahir', 'required');  
               $this->form_validation->set_rules('alamat', 'Alamat', 'required');  
               $this->form_validation->set_rules('nope', 'NoHP', 'required');  
               $this->form_validation->set_rules('email', 'Email', 'required');  
               $this->form_validation->set_rules('uname', 'Username', 'required');  
               $this->form_validation->set_rules('pass', 'Password', 'required');  
               $this->form_validation->set_rules('jbt', 'Jabatan', 'required');  
               $this->form_validation->set_rules('ttd', 'TTD');
                 
               if($this->form_validation->run())  
               {  
                    //true  
                    $img = $_FILES['ttd'];
                    $config['upload_path']          = './uploads/ttd';
                    $config['allowed_types']        = 'jpg|png|jpeg';
                    $config['file_name']            = $this->input->post('nama');
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('ttd'))
                    {
                         // $id = $this->input->post('id');
                         $this->session->set_flashdata('error', $this->upload->display_errors());
                         redirect(site_url().'/welcome/add_pegawai');
                    }
                    else
                    {
                         $pegawai = array(
                              'Nip'               => $this->input->post('nip'),
                              'NamaPegawai'       => $this->input->post('nama'),
                              'TanggalLahir'      => $this->input->post('tgl'),
                              'TempatLahir'       => $this->input->post('tpt'),
                              'Alamat'            => $this->input->post('alamat'),
                              'NoHP'              => $this->input->post('nope'),
                              'Email'             => $this->input->post('email'),
                              'TTD'               => $this->upload->data('full_path')
                              
                         );
                         $this->load->model('main_models');
                         $this->main_models->tambah_pegawai($pegawai);
                         $account = array(
                              'NIP'          => $this->input->post('nip'),
                              'Username'     => $this->input->post('uname'),
                              'Password'     => $this->input->post('pass'),
                              'Status'       => $this->input->post('jbt')
                         );
                         $this->main_models->tambah_user($account);
                         $message='Hey '.$pegawai['NamaPegawai'].' Pleas verify your Email to complete regristration';
                         $this->sendmail($pegawai['Email'],site_url().'/welcome/verifikasi/'.$this->encryption->encrypt($pegawai['Nip']),$message);
                         redirect(site_url().'/welcome/pegawai');
                    }
               }  
               else  
               {  
                    $this->session->set_flashdata('error', 'Please Fill All Field');  
                    redirect(site_url() . '/welcome/add_pegawai');  
               }
          }
          function tmbh_departement(){
               $this->load->helper(array('form','url'));
               $this->load->library('form_validation');
               $this->form_validation->set_rules('kd', 'kodedepartment', 'required');  
               $this->form_validation->set_rules('nama', 'namadepartment', 'required');  
               if($this->form_validation->run())  
               {  
                    //true  
                    $departement = array(
                         'KodeDepartement'       => $this->input->post('kd'),
                         'NamaDepartement'       => $this->input->post('nama')
                    );
                    // $this->load->model('main_models');
                    $this->main_models->tambah_departement($departement);
                    redirect(site_url().'/welcome/departemen');
               }  
               else  
               {  
                    $this->session->set_flashdata('error', 'Please Fill All Field');  
                    redirect(site_url() . '/welcome/add_departmen');  
               }
               
               redirect(site_url().'/welcome/departemen');
          }
          function delete_departement($id){
               $this->load->model('main_models');
               $this->main_models->delete_departement($id);
               redirect(site_url().'/welcome/departemen');
          }
          function edit_departement($id){
               $this->load->view('temp/head');
               if($this->session->userdata('status') == 'admin') {
                    $this->load->view('temp/sidebar');
               } 
               elseif($this->session->userdata('status') == 'rektor'||'fakultas'||'jurusan'||'lppm') 
               {
                    $this->load->view('temp/sidebar_unit');
               }
               elseif($this->session->userdata('status') == 'dosen') 
               {
                    $this->load->view('temp/sidebar_dosen');
               }
               elseif($this->session->userdata('status') == 'ekspedisi') 
               {
                    $this->load->view('temp/sidebar_ekspedisi');
               }
               $this->load->model('main_models');
               $data['dprt'] = $this->main_models->find_departement($id);
               $this->load->view('edit_departemen',$data);
               // $this->load->view('index2');
               // echo $this->session->userd?ata('status');
               // $this->load->view('temp/js');
               $this->load->view('temp/footer');
          }
          function edt_departement($id){
               $department = array(
                    'KodeDepartement'       => $this->input->post('kd'),
                    'NamaDepartement'       => $this->input->post('nama'),
               );
               $this->load->model('main_models');
               $this->main_models->edit_departement($id,$department);
               redirect(site_url().'/welcome/departemen');
          }
          function edit_pegawai($id){
               $this->load->view('temp/head');
               if($this->session->userdata('status') == 'admin') {
                    $this->load->view('temp/sidebar');
               } 
               elseif($this->session->userdata('status') == 'rektor'||'fakultas'||'jurusan'||'lppm') 
               {
                    $this->load->view('temp/sidebar_unit');
               }
               elseif($this->session->userdata('status') == 'dosen') 
               {
                    $this->load->view('temp/sidebar_dosen');
               }
               elseif($this->session->userdata('status') == 'ekspedisi') 
               {
                    $this->load->view('temp/sidebar_ekspedisi');
               }
               $this->load->model('main_models');
               $data['pgw'] = $this->main_models->get_pegawai($id);
               $this->load->view('edit_pegawai',$data);
               // $this->load->view('index2');
               // echo $this->session->userd?ata('status');
               // $this->load->view('temp/js');
               $this->load->view('temp/footer');
          }
          function edt_pegawai(){
               $pegawai = array(
                    'Nip'               => $this->input->post('nip'),
                    'NamaPegawai'       => $this->input->post('nama'),
                    'TanggalLahir'      => $this->input->post('tgl'),
                    'TempatLahir'       => $this->input->post('tpt'),
                    'Alamat'            => $this->input->post('alamat'),
                    'NoHP'              => $this->input->post('nope'),
                    'Email'             => $this->input->post('email')
               );
               $id = $this->input->post('nip');
               $this->load->model('main_models');
               $this->main_models->edit_pegawai($id,$pegawai);
               redirect(site_url().'/welcome/pegawai');
          }
          function delete_pegawai($id){
               $this->load->model('main_models');
               $this->main_models->delete_pegawai($id);
               redirect(site_url().'/welcome/pegawai');
          }
          function delete_rapat($id){
               $this->load->model('main_models');
               $this->main_models->delete_rapat($id);
               redirect(site_url().'/welcome/mom');
          }
          function lihatSurat($id){
               $this->load->view('temp/head');
               if($this->session->userdata('status') == 'admin') {
                    $this->load->view('temp/sidebar');
               } 
               elseif($this->session->userdata('status') == 'rektor'||'fakultas'||'jurusan'||'lppm') 
               {
                    $this->load->view('temp/sidebar_unit');
               }
               elseif($this->session->userdata('status') == 'dosen') 
               {
                    $this->load->view('temp/sidebar_dosen');
               }
               elseif($this->session->userdata('status') == 'ekspedisi') 
               {
                    $this->load->view('temp/sidebar_ekspedisi');
               }
               $this->load->model('main_models');
               $data['surat']=$this->surat->getWhere('tbl_surat','IdSurat',$id)->FileGdrive;
               $this->load->view('pdfViewer',$data);
               // $this->load->view('index2');
               // echo $this->session->userd?ata('status');
               // $this->load->view('temp/js');
               $this->load->view('temp/footer');
          }
          function det_agenda($Id){
               $this->load->model('main_models');
               $data['agenda'] = $this->main_models->get_rapat($Id);
               $data['anak'] = $this->main_models->get_detail_rapat($Id);
               $this->load->view('temp/head');
               if($this->session->userdata('status') == 'admin') {
                    $this->load->view('temp/sidebar');
               } 
               elseif($this->session->userdata('status') == 'dosen') 
               {
                    $this->load->view('temp/sidebar_dosen');
               }
               elseif($this->session->userdata('status') == 'ekspedisi') 
               {
                    $this->load->view('temp/sidebar_ekspedisi');
               }
               elseif($this->session->userdata('status') == 'rektor'||'fakultas'||'jurusan'||'lppm') 
               {
                    $this->load->view('temp/sidebar_unit');
               }
               $this->load->view('detail_agenda',$data);
               $this->load->view('temp/footer');

          }
          function edit_agenda($id){
               $this->load->view('temp/head');
               if($this->session->userdata('status') == 'admin') {
                    $this->load->view('temp/sidebar');
               } 
               elseif($this->session->userdata('status') == 'rektor'||'fakultas'||'jurusan'||'lppm') 
               {
                    $this->load->view('temp/sidebar_unit');
               }
               elseif($this->session->userdata('status') == 'dosen') 
               {
                    $this->load->view('temp/sidebar_dosen');
               }
               elseif($this->session->userdata('status') == 'ekspedisi') 
               {
                    $this->load->view('temp/sidebar_ekspedisi');
               }
               $this->load->model('main_models');
               $data['pgw'] = $this->main_models->daftar_pegawai();
               $data['agenda'] = $this->main_models->get_rapat($id);
               $this->load->view('edit_pegawai',$data);
               // $this->load->view('index2');
               // echo $this->session->userd?ata('status');
               // $this->load->view('temp/js');
               $this->load->view('temp/footer');
          }
          function edt_rapat(){
               $agenda = array(
                    'NIP'           => $this->input->post('nip'),
                    'TopikRapat'    => $this->input->post('topik'),
                    'TglMulai'      => $this->input->post('tgl_mulai'),
                    'WaktuMulai'    => $this->input->post('wkt_mulai'),
                    'TglAkhir'      => $this->input->post('tgl_akhir'),
                    'WaktuAkhir'    => $this->input->post('wkt_akhir'),
                    'MOM'           => $this->input->post('mom')
               );
               $this->load->model('main_models');
               $this->main_models->tambah_rapat($agenda);
               redirect(site_url().'/welcome/agenda');
               // }
               // else {
               //  redirect(site_url().'/welcome/add_agenda');
               // }
          }
          public function downloadSurat($id)
          {
               $file = $this->surat->getWhere('tbl_surat','IdSurat',$id);
               // var_dump($file);
               // die;
               force_download($file->File, NULL);
               redirect(site_url().'/welcome/validation');
           }
           public function downloadPdf(){
               
               // // $posisi = $_POST['posisi'];
               $posisi = "results/pdf/2020-07-07_12-10-03lppkm_pkm.pdf";
               $data = file_get_contents($posisi);
               force_download($posisi, $data);
               
               
               
               // header('Content-Type: application/json');
               // $b64Doc = chunk_split(base64_encode(file_get_contents($posisi)));
               // $send = array(
               //      'status'  =>200,
               //      'error'   =>false,
               //      'pdf'    =>$b64Doc,
               //      'message' =>'sukses'
               // );
               // $kirim = json_encode($send);
               // echo $kirim;
          }
          public function sendmail($email,$url,$message)
          {
               $this->load->library('email');

               $config['protocol']    = 'smtp';
               $config['smtp_host']    = 'smtp.gmail.com';
               $config['smtp_port']    = '465';
               $config['smtp_timeout'] = '7';
               $config['smtp_user'] = 'ADMIN@gmail.com';
               $config['smtp_pass'] = 'password';
               $config['charset']    = 'utf-8';
               $config['newline']    = "\r\n";
               $config['mailtype'] = 'text'; // or html
               $config['validation'] = TRUE; // bool whether to validate email or not      
               
               $this->email->initialize($config);
               
               $this->email->from('Admin@gmail.com', 'sender_name');
               $this->email->to($email); 
               $this->email->subject('Email Test');
               $this->email->message($message."<br><br>".$url);  

               if ($this->email->send()) {
                    echo 'Your Email has successfully been sent.';
                } else {
                    show_error($this->email->print_debugger());
                }
          }
          public function verifikasi($id){
               echo $this->encryption->decrypt($id);
               $this->main_models->verif($this->encryption->decrypt($id));
               redirect(site_url() . '/welcome/index'); 
          }
}
