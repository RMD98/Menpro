<?php  
 class surat extends CI_Model  
 {
    function get_properties_surat($idSurat)
    {
      $this->db->where('IdSK', $idSurat);
      $query = $this->db->get('tbl_sk');
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
    function listMatkul(){
        $query = $this->db->get('tbl_matkul');
        $temp = [];
        foreach ($query->result() as $key=>$row){
            $MK =  $row->Matakuliah;
            $jenis = $row->Jenis;
        $temp[$key]['id'] = $MK.' '.$jenis;
        $temp[$key]['text'] = $MK.' '.$jenis;
        }
        return $temp;
    }
    
    function listJurusan(){
        $query = $this->db->get('tbl_department');
        $temp = [];
        foreach ($query->result() as $key=>$row){
        $temp[$key]['id'] = $row->NamaDepartement;
        $temp[$key]['text'] = $row->NamaDepartement;
        }
        return $temp;
    }
    function listSuratMasuk(){
        $this->db->where('IdSK', '26');
        return $this->db->get('tbl_surat')->result();
    }
    function listSurat(){
        return $this->db->get('tbl_surat')->result();
    }
    function listSuratKeluar(){
        $this->db->where('IdSK', '25');
        return $this->db->get('tbl_surat')->result();
    }
    function listDetailSurat($IdSurat){
        $this->db->select('*');    
        $this->db->from('tbl_staff_surat');
        $this->db->join('tbl_pegawai', 'tbl_staff_surat.NIP = tbl_pegawai.NIP');
        $this->db->join('tbl_staff_departement', 'tbl_pegawai.NIP = tbl_staff_departement.NIP');
        $this->db->join('tbl_department', 'tbl_staff_departement.idDepartement = tbl_department.idDepartment');
        $this->db->where('IdSurat', $IdSurat);
        $query = $this->db->get()->result();
        return $query;
    }
    function listSuratStaff($IdSurat){
        $this->db->where('IdStaffSurat',$IdSurat);
        return $this->db->get('tbl_staff_surat')->result();
    }
    function updateStatusSurat($IdSurat){
        $data = array(
            'StatusSurat' => 'Y'
        );
        $this->db->where('IdStaffSurat',$IdSurat);
         $this->db->update('tbl_staff_surat',$data);
    }
    function insertSurat($idSK,$value,$Topik,$NoSurat){
        $data = array(
            'IdSK' => $idSK,
            'NoSurat' =>$NoSurat,
            'Topik' => $Topik,
            'TglDibuat' =>date("Y-m-d"),
            'Value' => $value
        );//belum insert ke tabel anak
        $this->db->insert('tbl_surat',$data);
    }
    function getValueSurat($idSurat){
        $this->db->where('IdSurat', $idSurat);
        $query = $this->db->get('tbl_Surat');
        return $query->row();
    }
 }