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
               $this->load->view('index2');
               $this->load->view('temp/footer');
               $this->load->view('temp/js');
               // else {
                    // $this->load->view("temp");
                    // redirect(site_url().'/welcome/index',$session_data);
                              // $this->index();
                              // }
          }
          public function getPegawai(){
               header('Content-Type: application/json');
               $data = json_encode($this->surat->listPegawai(),true);
               echo $data;
          }
          public function getMatkul(){
               header('Content-Type: application/json');
               $data = json_encode($this->surat->listMatkul(),true);
               echo $data;
          }
          public function getjurusan(){
               header('Content-Type: application/json');
               $data = json_encode($this->surat->listJurusan(),true);
               echo $data;
          }   
          public function generateWord($id){
               $Topik = $this->surat->get_properties_surat($id)->Tema;
               $tipe = $this->input->post()['jenis'];
               $response = $this->notif->sendMessage($Topik,$tipe,'asd');
               
               $Parameter = json_decode($this->surat->get_properties_surat($id)->Parameter);
               // var_dump($Parameter);
               // die;
               
               $Temp = json_encode($this->input->post());
               $NoSurat = ($this->surat->getlast("tbl_surat","IdSurat")->IdSurat)+1;    
               $unik = date("Y-m-d_h-i-s");
               $filename = $this->surat->get_properties_surat($id)->FileTemplate;
               $template = "resource/{$filename}";
               $hasil = "results/{$unik} {$filename}";
               // $data = $this->input->post();
               // $user = $this->surat->getDetailAccount($this->session->userdata('id'));
               $data = array_merge($this->input->post(), $this->surat->getDetailAccount($this->session->userdata('id')));
               try{
                    $data['NipSurat']=$this->surat->getDetailDosen('NamaPegawai',$this->input->post()['dosenSurat'])['Nip'];
               }
               catch(Exception $e) {
                    echo 'Message: ' .$e->getMessage();
                  }
               $lokasi = $this->surat->generateWord($template,$hasil,$data,$Parameter,$NoSurat);   
               //generate word
               $this->surat->insertSurat($id,$Temp,$Topik,$NoSurat,$lokasi);
               $idSurat = $this->surat->getLast('tbl_surat','IdSurat')->IdSurat;
               
               foreach ($this->input->post() as $val=>$key) {
                    if(count($val) > 1 or $val == 'dosenSurat' or $val == 'tujuan' or $val =='dosen' or $val =='pimpinan' or $val == 'rekan' or $val =='ketuaDosen' ){
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
               // var_dump($data);
               // die;
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
          public function pegawai()
          {
               $data['tbl_pegawai'] = $this->main_models->daftar_pegawai();
               $this->load->view('temp/head');
               $this->load->view('temp/sidebar');
               $this->load->view('pegawai',$data);
               $this->load->view('temp/footer');
               $this->load->view('temp/js');
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
               $data['departement'] = $this->main_models->daftar_departement();
               $this->load->view('temp/head');
               $this->load->view('temp/sidebar');
               $this->load->view('departemen',$data);
               $this->load->view('temp/footer');
               $this->load->view('temp/js');
          }
          public function agenda(){
               $this->load->model('main_models');
               $this->load->view('temp/head');
               if($this->session->userdata('status') == 'admin') {
                    // $data['nama'] = $this->session->userdata('Nama');
                    $data['agenda'] = $this->main_models->daftar_rapat();
                    $this->load->view('temp/sidebar');
               } 
               elseif($this->session->userdata('status') == 'dosen') 
               {   
                    $data['agenda'] = $this->main_models->filter_rapat($this->session->userdata('NIP'));
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
                         $session_data = array(  
                              'id'           => $login_data['id'],
                              'username'     => $username,
                              'status'       => $login_data['Status'],
                              'Nama'         => $data['NamaPegawai'],
                              'NIP'          => $login_data['NIP'] 
                         );  
                         $this->session->set_userdata($session_data);  
                         redirect(site_url().'/welcome/logedin',$session_data);
                    }  
                    else  
                    {  
                         $this->session->set_flashdata('error', 'Invalid Username and Password');  
                         redirect(site_url() . '/welcome/index');  
                         }  
                    }  
               else  
                    {  
                         $this->session->set_flashdata('error', 'Invalid Username and Password');  
                         redirect(site_url() . '/welcome/index');  
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
          function add_rapat(){
               // $this->load->library('form_validation');
               // // $this->load->library('form_validation');
               // $this->form_validation->set_rules('nip', 'NIP','required');  
               // $this->form_validation->set_rules('topik', 'TopikRapat', 'required');  
               // $this->form_validation->set_rules('tgl_awal', 'TglMulai', 'required');  
               // $this->form_validation->set_rules('wkt_awal', 'WaktuMulai', 'required');  
               // $this->form_validation->set_rules('tgl_akhir', 'TglAkhir', 'required');  
               // $this->form_validation->set_rules('wkt_akhir', 'WaktuAkhir', 'required');
               // $this->form_validation->set_rules('mom', 'MOM', 'required');
               // if($this->form_validation->run()){
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
               $response = $this->notif->sendMessage($agenda['TopikRapat'],"Rapat",'asd');
               redirect(site_url().'/welcome/agenda');
               // }
               // else {
               //  redirect(site_url().'/welcome/add_agenda');
               // }
          }
          function tmbh_pegawai(){
               $pegawai = array(
                    'Nip'               => $this->input->post('nip'),
                    'NamaPegawai'       => $this->input->post('nama'),
                    'TanggalLahir'      => $this->input->post('tgl'),
                    'TempatLahir'       => $this->input->post('tpt'),
                    'Alamat'            => $this->input->post('alamat'),
                    'NoHP'              => $this->input->post('nope'),
                    'Email'             => $this->input->post('email')
               );
               $this->load->model('main_models');
               $this->main_models->tambah_pegawai($pegawai);
               $account = array(
                    'NIP'          => $this->input->post('nip'),
                    'Username'     => $this->input->post('uname'),
                    'Password'     => $this->input->post('pass')
               );
               $this->main_models->tambah_user($account);
               redirect(site_url().'/welcome/pegawai');
          }
          function delete_rapat($id){
               $this->load->model('main_models');
               $this->main_models->delete_rapat($id);
               redirect(site_url().'/welcome/mom');
          }
          function det_agenda($Id){
               $this->load->model('main_models');
               $data['agenda'] = $this->main_models->get_rapat($Id);
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
               $data['pgw'] = $this->main_models->find_pegawai($id);
               $this->load->view('edit_pegawai',$data);
               // $this->load->view('index2');
               // echo $this->session->userd?ata('status');
               // $this->load->view('temp/js');
               $this->load->view('temp/footer');
          }
          function edt_rapat(){
               // $this->load->library('form_validation');
               // // $this->load->library('form_validation');
               // $this->form_validation->set_rules('nip', 'NIP','required');  
               // $this->form_validation->set_rules('topik', 'TopikRapat', 'required');  
               // $this->form_validation->set_rules('tgl_awal', 'TglMulai', 'required');  
               // $this->form_validation->set_rules('wkt_awal', 'WaktuMulai', 'required');  
               // $this->form_validation->set_rules('tgl_akhir', 'TglAkhir', 'required');  
               // $this->form_validation->set_rules('wkt_akhir', 'WaktuAkhir', 'required');
               // $this->form_validation->set_rules('mom', 'MOM', 'required');
               // if($this->form_validation->run()){
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
          function test(){
               $this->test->test1();
          }
          
     }
