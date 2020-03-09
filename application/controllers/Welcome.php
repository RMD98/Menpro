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
	public function index()
	{
		$this->load->view('login2');
	}
	public function register()
	{
		$this->load->view('register');
	}
	public function logedin(){
		$this->load->view('index2');
	}
	public function pegawai()
	{
		$this->load->view('pegawai');
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
           $this->load->library('form_validation');  
           $this->form_validation->set_rules('username', 'Username', 'required');  
           $this->form_validation->set_rules('password', 'Password', 'required');  
        //    if($this->form_validation->run())  
        //    {  
                //true  
                $username = $this->input->post('Username');  
                $password = $this->input->post('Password');  
                //model function  
                $this->load->model('main_models');  
                $login_data = $this->main_models->can_login($username, $password);
                if($login_data['Status'] == 'admin')  
                {  
                     $session_data = array(  
                          'id'           => $login_data['id'],
                          'username'     => $username,
                          'status'       => $login_data['Stat']
                     );  
                     $this->session->set_userdata($session_data);  
                     redirect(site_url().'/welcome/logedin',$session_data);
                }  
                elseif($login_data['Status'] == 'user')  
                {  
                     $session_data = array(  
                          'id'           =>     $login_data['id'],
                          'username'     =>     $username,
                          'address'      =>     $login_data['address'],
                        //   'nope'	     =>     $login_data['nope'],
                          'status'       =>     $login_data['Stat']
                     );  
                     $this->session->set_userdata($session_data);  
                     redirect(site_url().'/welcome/logedin',$session_data);
                }  
                else  
                {  
                     $this->session->set_flashdata('error', 'Invalid Username and Password');  
                     redirect(site_url() . '/welcome/index');  
                }  
        //    }  
        //    else  
        //    {  
        //         //false  
        //         $this->index();  
        //    }  
      }
}
