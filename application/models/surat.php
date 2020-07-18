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
    function getPegawai($id){
        $this->db->where('NamaPegawai',$id);
        return $this->db->get('tbl_pegawai')->result();
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
    function listUsername(){
        $query = $this->db->get('tbl_account');
        $temp = [];
        $i=0;
        foreach ($query->result() as $key=>$row){
            if ((strpos($row->Username, 'dosen') !== false)||(strpos($row->Username, 'ekspedisi')!== false)||(strpos($row->Username, 'admin')!== false)) {
                $asd='1';
            }else{
                $temp[$i]['id'] = $row->Username;
            $temp[$i]['text'] = $row->Username;
            $i=$i+1;
        }
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
    function getmatkul($nama,$jenis){
        $this->db->where("Matakuliah", $nama);
        $this->db->where("Jenis", $jenis);
        $query = $this->db->get('tbl_matkul');
        return $query->row();
    }
    function listSuratMasuk($id){
        $this->db->select('*');
        $this->db->from('tbl_staff_surat');
        $this->db->join('tbl_pegawai', 'tbl_staff_surat.NIP = tbl_pegawai.NIP');
        $this->db->join('tbl_surat', 'tbl_staff_surat.IdSurat = tbl_surat.IdSurat');
        $this->db->order_by('tbl_surat.IdSurat', 'DESC');
        $this->db->where('tbl_staff_surat.NIP', $id);

        return $this->db->get()->result();
    }
    function listValidasi($id){
        $this->db->select('*');
        $this->db->from('tbl_staff_surat');
        $this->db->join('tbl_pegawai', 'tbl_staff_surat.NIP = tbl_pegawai.NIP');
        $this->db->join('tbl_surat', 'tbl_staff_surat.IdSurat = tbl_surat.IdSurat');
        // $this->db->where('tbl_surat.Validator', $id);
        $this->db->where('tbl_pegawai.NIP', $id);
        $this->db->group_start();
        $this->db->where('tbl_surat.Status', 'belum tervalidasi');
        $this->db->or_where('tbl_surat.Status', 'tervalidasi');
        $this->db->group_end();
        $this->db->order_by('tbl_surat.IdSurat', 'DESC');
        return $this->db->get()->result();
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
    function listDetailSuratValidasi($IdSurat){
        $this->db->select('*');    
        $this->db->from('tbl_surat');
        $this->db->join('tbl_pegawai', 'tbl_surat.Validator = tbl_pegawai.NIP');
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
    function updateStatusValidasi($IdSurat){
        $data = array(
            'Status' => 'tervalidasi'
        );
        $this->db->where('IdSurat',$IdSurat);
         $this->db->update('tbl_surat',$data);
    }
    function insertSurat($idSK,$value,$Topik,$NoSurat,$lokasi,$validator,$pembuat,$pdf,$idGdrive){
        $data = array(
            'IdSK' => $idSK,
            'NoSurat' =>$NoSurat,
            'Topik' => $Topik,
            'TglDibuat' =>date("Y-m-d"),
            'Value' => $value,
            'File' => $lokasi,
            'Status'=> 'belum tervalidasi',
            'Pembuats'=>$pembuat,
            'Validator'=>$validator,
            'FilePdf'=>$pdf,
            'FileGdrive'=>$idGdrive
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
        $this->load->helper('download');
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($mulai);
        foreach($parameter as $key=>$Parameter){
            if($key == 'date'){
                $templateProcessor->setValue($key, date("$Parameter"));    
            }elseif($key=='No'){
                $templateProcessor->setValue($key, $NoSurat);  
            }elseif($key == 'thn'){
                $templateProcessor->setValue($key, date("Y"));  
            }  
            elseif($key == 'ttd'){
                // $templateProcessor->setImg($key,array('src' => $data["$Parameter"],'swh'=>'200', 'size'=>array(0=>$width, 1=>$height)));
            }
            elseif($key == 'arrayofDosen'){
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
        // $templateProcessor->save('php://output');
        // // save as a random file in temp file
        return $selesai;
    }
    function validasiSurat($data){
        
        $this->load->helper('download');
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($data[0]->File);
        $templateProcessor->setImg('ttd',array('src' => $data[0]->TTD,'swh'=>'200', 'size'=>array(0=>$width, 1=>$height)));
        $templateProcessor->saveAs($data[0]->File);
    }
    function converter($letak,$tujuan){
        
        
        $config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Apikey', '0cb3f8d6-ab4d-4a10-9b90-7e77a7fa7e1a');
        $apiInstance = new Swagger\Client\Api\ConvertDocumentApi(
            new GuzzleHttp\Client(),
            $config
        );
        $input_file = $letak; // \SplFileObject | Input file to perform the operation on.
        try {
            $data = $apiInstance->convertDocumentDocxToPdf($input_file);
            file_put_contents($tujuan,$data);
            // header('Content-Type: application/pdf');
            
        } catch (Exception $e) {
            echo 'Exception when calling ConvertDocumentApi->convertDocumentDocxToPdf: ', $e->getMessage(), PHP_EOL;
        }
        // $tujuan = "results/pdf/2020-07-07_12-04-32lppkm_pkm.pdf";
        
        $idGdrive=$this->uploadGDrive($tujuan);
        return $idGdrive;
    }
    function setGdrive(){
        $url_array = explode('?', 'http://'.$_SERVER ['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        $url = $url_array[0];

        require_once 'google-api-php-client/src/Google_Client.php';
        require_once 'google-api-php-client/src/contrib/Google_DriveService.php';
        $client = new Google_Client();
        $client->setClientId('884287143758-8ijne85l8hshui9tganmog921edc8jj6.apps.googleusercontent.com');
        $client->setClientSecret('mkVoLL4NBnf_oVvjODtwLAte');
        $client->setRedirectUri($url);
        $client->setScopes(array('https://www.googleapis.com/auth/drive'));

        if (isset($_GET['code'])) {
            $_SESSION['accessToken'] = $client->authenticate($_GET['code']);
            header('location:'.$url);exit;
        } elseif (!isset($_SESSION['accessToken'])) {
            $client->authenticate();
        }
        return $_SESSION['accessToken'];
    }
    function uploadGDrive($nama){
        
        $url_array = explode('?', 'http://'.$_SERVER ['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        $url = $url_array[0];

require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_DriveService.php';
$client = new Google_Client();
$client->setClientId('884287143758-8ijne85l8hshui9tganmog921edc8jj6.apps.googleusercontent.com');
$client->setClientSecret('mkVoLL4NBnf_oVvjODtwLAte');
$client->setRedirectUri($url);
$client->setScopes(array('https://www.googleapis.com/auth/drive'));

if (isset($_GET['code'])) {
    $_SESSION['accessToken'] = $client->authenticate($_GET['code']);
    header('location:'.$url);exit;
} elseif (!isset($_SESSION['accessToken'])) {
    $client->authenticate();
}
if (!empty($_POST)) {
    $client->setAccessToken($_SESSION['accessToken']);
    $service = new Google_DriveService($client);
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $file = new Google_DriveFile();
    
    $file_path = $nama;
    $mime_type = finfo_file($finfo, $file_path);
    $file->setTitle($nama);
    $file->setDescription('This is a '.$mime_type.' document');
    $file->setMimeType($mime_type);
    $test = $service->files->insert(
        $file,
        array(
            'data' => file_get_contents($file_path),
            'mimeType' => $mime_type
        )
    );
        $newPermission = new Google_Permission();
        $newPermission->setType('anyone');
        $newPermission->setRole('reader');
try {$service->permissions->insert($test['id'], $newPermission);} 
catch (Exception $e) {print "An error occurred: " . $e->getMessage();}finfo_close($finfo);}
    return $test['id'];
    }
 }

