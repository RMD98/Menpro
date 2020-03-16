<?php  
 class surat extends CI_Model  
 {
    function get_properties_surat($idSurat)
    {
      $this->db->where('IdSK', $idSurat);
      $query = $this->db->get('tbl_sk');
    
    //   foreach ($query->result() as $row)
    //     {
    //     $listInput = $row->Input;
    //     }
        
        return $query->row();
    }
    function get_template_sk($role)
    {
        $this->db->where('Role', $role);
      $query = $this->db->get('tbl_sk')->result();
      return $query;
    }
    function listPegawai(){
        $query = $this->db->get('tbl_pegawai');
        $temp = [];
        foreach ($query->result() as $key=>$row){
        $temp[$key]['id'] = $row->NamaPegawai;
        $temp[$key]['text'] = $row->NamaPegawai;
        }
        return $temp;
    }
    function insertSurat($idSK,$value,$Topik){
        $data = array(
            'IdSK' => $idSK,
            'Topik' => $Topik,
            'TglDibuat' =>date("Y-m-d"),
            'Value' => $value
        );
        $this->db->insert('tbl_surat',$data);
    }
 }