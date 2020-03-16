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
          
      }
     public function index()
	{
          // die;
          $this->load->library('session');
          if($this->session->userdata() != null) 
          {
               $this->load->view('login2');
               // $this->session();
               // $data = $this->session->all_userdata();
               // echo($this->session->userdata());
               // for each
               // echo $data;
          }
          else 
          {
                
               redirect(site_url().'/welcome/logedin',$session_data);
          }
	}
	public function register()
	{
		$this->load->view('register');
	}
	public function logedin(){
          $this->load->model('main_models');
          //   $data['produk'] = $this->main_models->daftar_produk();
          $this->load->view('temp/head');
          if($this->session->userdata('status') == 'admin') {
               $this->load->view('temp/sidebar');
          } 
          elseif($this->session->userdata('status') == 'unit') 
          {
               $this->load->view('temp/sidebar_unit');
          }
          elseif($this->session->userdata('status') == 'dosen') 
          {
               $this->load->view('temp/sidebar_dosen');
          }
          else {
               // $this->load->view("temp");
               redirect(site_url().'/welcome/index',$session_data);
               // $this->index();
    }
		$this->load->view('index2');
          $this->load->view('temp/footer');
          $this->load->view('temp/js');
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
	public function pegawai()
	{
		$this->load->view('pegawai');
	}
	public function inbox(){
		$this->load->view('inbox');
	}
	public function surat(){
		$this->load->view('surat');
	}
	public function data_surat(){
		$this->load->view('data_surat');
     }
     public function account(){
          $this->load->view('account');
     }
     public function add_departmen(){
          $this->load->view('add_departmen');
     }
     public function add_surat(){
          // $this->get_properties_surat('1');
          $x = $this->surat->get_template_sk($this->session->userdata('status'));
          print_r($x);
          die;
          $this->load->view('add_surat');
     }
     public function mom(){
          $this->load->view('mom');
     }
     public function departemen(){
          $this->load->view('departemen');
     }
     public function agenda(){
          $this->load->view('agenda');
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
                $this->load->model('main_models');  
                $login_data = $this->main_models->can_login($username, $password);
                if($login_data['Status'] != ' ')  
                {  
                     $session_data = array(  
                          'id'           => $login_data['id'],
                          'username'     => $username,
                          'status'       => $login_data['Status']
                     );  
                     $this->session->set_userdata($session_data);  
                     redirect(site_url().'/welcome/logedin',$session_data);
                }  
               //  elseif($login_data['Status'] == 'dosen')  
               //  {  
               //       $session_data = array(  
               //            'id'           =>     $login_data['id'],
               //            'username'     =>     $username,
               //            'address'      =>     $login_data['address'],
               //          //   'nope'	     =>     $login_data['nope'],
               //            'status'       =>     $login_data['Status']
               //       );  
               //       $this->session->set_userdata($session_data);  
               //       redirect(site_url().'/welcome/logedin_dosen',$session_data);
               //  }  
               //  elseif($login_data['Status'] != ' ')  
               //  {  
               //       $session_data = array(  
               //            'id'           =>     $login_data['id'],
               //            'username'     =>     $username,
               //            'address'      =>     $login_data['address'],
               //          //   'nope'	     =>     $login_data['nope'],
               //            'status'       =>     $login_data['Status']
               //       );  
               //       $this->session->set_userdata($session_data);  
               //       redirect(site_url().'/welcome/logedin_user',$session_data);
               //  }    
                else  
                {  
                     $this->session->set_flashdata('error', 'Invalid Username and Password');  
                     redirect(site_url() . '/welcome/logedin');  
                    }  
               }  
               else  
               {  
                    //false  
                    // $this->index();  
                    $this->session->set_flashdata('error', 'Invalid Username and Password');  
                    redirect(site_url() . '/welcome/logedin');  
           }  
      }
}
