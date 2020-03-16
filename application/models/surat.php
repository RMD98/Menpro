<?php  
 class surat extends CI_Model  
 {
    function get_properties_surat($idSurat)
    {
      $this->db->where('IdSK', $idSurat);
      $query = $this->db->get('tbl_sk');
      
      foreach ($query->result() as $row)
        {
        print_r($row->Input);
        echo $row->Tema;
        echo $row->Role;
        }
    }
    function get_template_sk($role)
    {
        $this->db->where('Role', $role);
      $query = $this->db->get('tbl_sk')->result();
      
    }
 }