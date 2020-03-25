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
          date_default_timezone_set("Asia/Jakarta");
      }
     public function index()
	{
          // parent::__construct();
          // $this->load->library('session');
          // if($this->session->userdata() != null) 
          // {
               $this->load->view('login2');
               // $data = $this->session->all_userdata();
               // echo($this->session->userdata());
               // for each
               // echo $data;
          // }
          // else 
          // { 
          //      redirect(site_url().'/welcome/logedin',$session_data);
          // }
	}
	public function register()
	{
		$this->load->view('register');
	}
	public function logedin(){
          // $this->load->model('main_models');
          //   $data['produk'] = $this->main_models->daftar_produk();
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
          $this->load->view('index2');
          $this->load->view('temp/footer');
          $this->load->view('temp/js');
          //           else {
               //                // $this->load->view("temp");
               //                redirect(site_url().'/welcome/index',$session_data);
                              //                // $this->index();
                              //     }
                         }
                         public function logedin_user(){
                              $this->load->view('temp/head');
               $this->load->view('index2');
               $this->load->view('temp/footer');
               $this->load->view('temp/js');
          }
          public function logedin_dosen(){
               $this->load->view('temp/head');
               $this->load->view('temp/sidebar_dosen');
               $this->load->view('index2');
               $this->load->view('temp/footer');
               $this->load->view('temp/js');
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
               $Temp = json_encode($this->input->post());
               $NoSurat = "test"; //belum dinamis        
               $unik = date("Y-m-d_h-i-s");
               $template = 'resource/fakultas_BimbinganTugasAkhir.docx';
               $hasil = "results/fakultas_BimbinganTugasAkhir_{$unik}.docx";
               $data = $this->input->post();
               $lokasi = $this->surat->generateWord($template,$hasil,$data);   
               //generate word
               // $this->surat->insertSurat($id,$Temp,$Topik,$NoSurat,$lokasi);
               $idSurat = $this->surat->getLast('tbl_surat','IdSurat')->IdSurat;
               foreach ($this->input->post() as $val=>$key) {
                    if(count($val) > 1 or $val == 'dosen' or $val == 'tujuan' ){
                         foreach($key as $key ){
                              $NIP = $this->surat->getWhere('tbl_pegawai','NamaPegawai',$key)->Nip;
                              // $this->surat->insertDetailSurat($idSurat,$NIP);
                         } 
                    }
               }
               
               $this->session->set_flashdata('statusInsert','sukses' );
               redirect("welcome/add_surat/$id");
          }
          public function statusSurat($idSurat){
               $data['DetailSurat'] = $this->surat->listDetailSurat($idSurat);
               $this->load->view('temp/head');
               $this->load->view('temp/js');
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
               $this->load->view('detail_surat',$data);
               $this->load->view('temp/footer');
          }
          public function detailSurat($role){
               $data['DetailSurat'] = $this->surat->listSurat();
               $this->load->view('temp/head');
               $this->load->view('temp/js');
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
               $data['SuratMasuk'] = $this->surat->listSuratMasuk();
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
               $this->load->view('inbox',$data);
               $this->load->view('temp/footer');
               $this->load->view('temp/js');
          }
          public function outbox(){
               $data['SuratKeluar'] = $this->surat->listSuratKeluar();
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
               $this->load->view('outbox',$data);
               $this->load->view('temp/footer');
               $this->load->view('temp/js');
          }
          public function ekspedisi(){
               $data['SuratEkspedisi'] = $this->surat->listSurat();
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
     public function add_pegawai(){
          $this->load->view('temp/head');
          $this->load->view('temp/sidebar');
          $this->load->view('add_pegawai');
          $this->load->view('temp/footer');
          $this->load->view('temp/js');
     }
     public function add_surat($key){
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
          $this->load->view('temp/js');
          $data['templateSK'] = json_decode($this->surat->get_properties_surat($key)->Input);
          $data['IdSK'] = $this->surat->get_properties_surat($key)->IdSK;
          $data['JudulSK'] = $this->surat->get_properties_surat($key)->Tema;
          $this->load->view('add_surat',$data);
     }
     public function mom(){
          $this->load->view('temp/head');
          $this->load->view('temp/sidebar');
          $this->load->view('mom');
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
          $this->load->view('agenda');
          // $this->load->view('index2');
          // echo $this->session->userd?ata('status');
          $this->load->view('temp/footer');
          // $this->load->view('temp/js');
     }
	function login()  
      {  
           $this->load->helper(array('form', 'url'));
           $this->load->library('form_validation');  
           $this->form_validation->set_rules('Username', 'Username', 'required');  
           $this->form_validation->set_rules('Password', 'Password', 'required');  
           if($this->form_validation->run())  
           {  
                //true  
                $username = $this->input->post('Username');  
                $password = $this->input->post('Password');  
                //model function  
                $login_data = $this->main_models->can_login($username, $password);
                if($login_data['Status'] != '')  
                {  
                     $session_data = array(  
                          'id'           => $login_data['id'],
                          'username'     => $username,
                          'status'       => $login_data['Status']
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
      function test(){
           $this->test->test1();
      }
}
