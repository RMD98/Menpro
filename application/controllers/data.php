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
          $this->load->library('session');
          
      }
    public function add_agenda(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nip', 'NIP');  
        $this->form_validation->set_rules('topik', 'TopikRapat');  
        $this->form_validation->set_rules('tgl_awal', 'TglMulai');  
        $this->form_validation->set_rules('wkt_awal', 'WaktuMulai');  
        $this->form_validation->set_rules('tgl_akhir', 'TglAkhir');  
        $this->form_validation->set_rules('wkt_akhir', 'WaktuAkhir');
        $this->form_validation->set_rules('mom', 'MOM');
        if($this->form_validation->run()){
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
            redirect(base_url().'/welcome/agenda');
        }
        // $this->load->views('agenda')
    }
    }