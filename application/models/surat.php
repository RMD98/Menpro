<?php  
 class Surat extends CI_Model  
 {
    function get_properties_surat($idSurat)
    {
      $this->db->where('IdSK', $idSurat);
      $query = $this->db->get('tbl_sk');
        return $query->row();
    }
    function get_template_sk($role)
    {
        if($role == 'admin'){
            return $query = $this->db->get('tbl_sk')->result();  
        }
        else{
            $this->db->where('Role', $role);
            $query = $this->db->get('tbl_sk')->result();
            return $query;
        }
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
    function getmatkul($nama,$jenis){
        $this->db->where("Matakuliah", $nama);
        $this->db->where("Jenis", $jenis);
        $query = $this->db->get('tbl_matkul');
        return $query->row();
    }
    function listSuratMasuk(){
        $this->db->where('IdSK', '26');
        return $this->db->get('tbl_surat')->result();
    }
    function listSurat(){
        $this->db->limit('5');
        $this->db->order_by('IdSurat', 'DESC');
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
    function insertSurat($idSK,$value,$Topik,$NoSurat,$lokasi){
        $data = array(
            'IdSK' => $idSK,
            'NoSurat' =>$NoSurat,
            'Topik' => $Topik,
            'TglDibuat' =>date("Y-m-d"),
            'Value' => $value,
            'File' => $lokasi
        );
        $this->db->insert('tbl_surat',$data);
    }
    
    function getValueSurat($idSurat){
        $this->db->where('IdSurat', $idSurat);
        $query = $this->db->get('tbl_Surat');
        return $query->row();
    }
    function insertDetailSurat($idSurat,$idPegawai){
        $data = array(
            'IdSurat' => $idSurat,
            'NIP' => $idPegawai,
            'StatusSurat' => 'N'
        );
        $this->db->insert('tbl_staff_surat',$data);
    }
    function getWhere($table,$where,$value){
        $this->db->where($where, $value);
        $query = $this->db->get($table);
        return $query->row();
    }
    function getLast($table,$order){
        $this->db->order_by($order, 'DESC');
        $query = $this->db->get($table);
        return $query->row();
    }
    function getDetailDosen($param,$value){
        $this->db->select('*');    
        $this->db->from('tbl_pegawai');
        $this->db->where($param, $value);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function getDetailAccount($idakun){
        $this->db->select('*');    
        $this->db->from('tbl_account');
        $this->db->join('tbl_pegawai', 'tbl_account.NIP = tbl_pegawai.NIP');
        $this->db->join('tbl_staff_departement', 'tbl_pegawai.NIP = tbl_staff_departement.NIP');
        $this->db->join('tbl_department', 'tbl_staff_departement.idDepartement = tbl_department.idDepartment');
        $this->db->where('id', $idakun);
        $query = $this->db->get()->row_array();
        return $query;
    }
    function generateWord($mulai,$selesai,$data,$parameter,$NoSurat){
        
        // $user = $this->getDetailAccount($this->session->userdata('id'));
        // \PhpOffice\PhpWord\Settings::setCompatibility(false);
        // \PhpOffice\PhpWord\Settings::setZipClass(\PhpOffice\PhpWord\Settings::PCLZIP);
        $this->load->helper('download');
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($mulai);
        // var_dump($data);
        // die;
        foreach($parameter as $key=>$Parameter){
            if($key == 'date'){
                $templateProcessor->setValue($key, date("$Parameter"));    
            }elseif($key=='No'){
                $templateProcessor->setValue($key, $NoSurat);  
            }elseif($key == 'thn'){
                $templateProcessor->setValue($key, date("Y"));    
            }elseif($key == 'arrayofDosen'){
                $templateProcessor->cloneRow('rowValue', sizeof($data['dosen']));
                foreach($data['dosen'] as $i=>$NamaDosen){ 
                    $number = $i+1;
                    if(array_key_exists("ketuaDosen",$data)){
                        $templateProcessor->setValue("X#{$number}", $i+2);
                    }else{
                        $templateProcessor->setValue("X#{$number}", $i+1);
                    }
                    $templateProcessor->setValue("rowValue#{$number}", $NamaDosen);
                    }
            }elseif($key == 'arrayofMatkul'){
                $templateProcessor->cloneRow('kdNama', sizeof($data['matkul']));
                foreach($data['matkul'] as $i=>$matkul){ 
                    $number = $i+1;
                    $nama=rtrim($matkul,'ResponsiKuliahkuliahresponsi');
                    $nama=rtrim($nama);
                    $jenis=substr($matkul, strrpos($matkul, ' ' )+1);
                    $cek = $this->getmatkul($nama,$jenis);
                    $templateProcessor->setValue("kdNama#{$number}", "{$nama} {$cek->Kode}");
                    $templateProcessor->setValue("jenis#{$number}", $jenis);
                    $templateProcessor->setValue("sks#{$number}", $cek->SKS);
                    $templateProcessor->setValue("jmlh#{$number}", $cek->JumlahKelas);
                }
            }else{
                $templateProcessor->setValue($key, $data["$Parameter"]);   
            }
        }
        ob_clean();
        $templateProcessor->saveAs($selesai);
        force_download($selesai, NULL);
        // $templateProcessor->save('php://output');
        // // save as a random file in temp file
    
        return $selesai;
    }
 }