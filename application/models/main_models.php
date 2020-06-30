<?php  
 class Main_models extends CI_Model  
 {  
      function can_login($username, $password)  
      {  
           $this->db->where('Username', $username);  
           $this->db->where('Password', $password);
           $query = $this->db->get('tbl_account')->row_array();
           return $query;
      } 
      function daftar_departemen()
      {
        return $this->db->get('tbl_department')->result();
      }
      function find_departement($id)
      {
        $this->db->where('idDepartment',$id);
        return $this->db->get('tbl_department')->result();
      }
      function edit_departement($id,$data)
      {
        $this->db->where('idDepartment',$id);
        $this->db->update('tbl_department',$data);
      }
      function tambah_departement($data)
      {
        $this->db->insert('tbl_department',$data);
      }
      function delete_departement($id)
      {
        $this->db->where('idDepartment',$id);
        $this->db->delete('tbl_department');
      }
      function daftar_pegawai()
      {
        return $this->db->get('tbl_pegawai')->result();
      }
      function get_pegawai($nip)
      {
        $this->db->where('Nip',$nip);
        return $this->db->get('tbl_pegawai')->row_array();
      }
      function delete_pegawai($id)
      {
        $this->db->where('Nip',$id);
        $this->db->delete('tbl_pegawai');
      }
      function edit_pegawai($id,$data)
      {
        $this->db->where('Nip',$id);
        $this->db->update('tbl_pegawai',$data);
      }
      function tambah_pegawai($data)
      {
        $this->db->insert('tbl_pegawai',$data);
      }
      function daftar_account()
      {
        return $this->db->get('tbl_account')->result();
      }
      function daftar_rapat()
      {
        return $this->db->get('tbl_rapat')->result();
      }
      function get_rapat($id)
      {
        $this->db->where('IdRapat',$id);
        return $this->db->get('tbl_rapat')->result();
      }
      function get_detail_rapat($id)
      {
        $this->db->select('*');    
        $this->db->from('tbl_staff_rapat');
        $this->db->join('tbl_pegawai', 'tbl_staff_rapat.NIP = tbl_pegawai.NIP');
        $this->db->join('tbl_staff_departement', 'tbl_pegawai.NIP = tbl_staff_departement.NIP');
        $this->db->join('tbl_department', 'tbl_staff_departement.idDepartement = tbl_department.idDepartment');
        $this->db->where('IdRapat', $id);
        $query = $this->db->get()->result();
        return $query;
      }
      function tambah_rapat($data)
      {
        $this->db->insert('tbl_rapat',$data);
      }
      function delete_rapat($id)
      {
        $this->db->where('IdRapat',$id);
        $this->db->delete('tbl_rapat');
      }
      function filter_rapat(){
        // $this->db->where('NIP',$this->session->userdata('NIP'));
        // $surat = $this->db->get('tbl_staff_surat')->result();
        // foreach($surat as $surat) :
        //   $this->db->where('IdSurat',$surat->IdSurat);
        //   $data = $this->db->get('tbl_rapat')->result();
        // endforeach;
        // return $data;
        $nip = $this->session->userdata('NIP');
        $this->db->where('NIP',$nip);
        return $this->db->get('tbl_rapat')->result();
      }
      function trans_id()
      {
        $this->db->where('user',$this->session->userdata('username'));  
        return $this->db->get('transaksi')->result();
      }
      function profil($id)
      {
        $this->db->where('id',$id);
        return $this->db->get('users')->result();
      }
      function tambah_user($data)
      {
        $this->db->insert('tbl_account',$data);
      }
      function stok()
      {
        foreach ($this->cart->contents() as $item ) {
          $this->db->where('id',$item['id']);
          $produk = $this->db->get('produk')->row_array();
          $qty = $item['qty'];
          $stk = $produk['stok']; 
          $stok =  $stk - $qty;
          $this->db->query("Update produk set stok = ".$stok." where id ='".$item['id']."'");
        }
      }
      function Trans($user)
      {
          $ttl=0;
          $jml=0;
        foreach ($this->cart->contents() as $item ) {
          $ttl= $ttl+($item['price']*$item['qty']);
          $jml= $jml+$item['qty'];
        }
        $data = array(
                'user' => $user,
                'address' =>$this->session->userdata('address'),
                'number' =>$this->session->userdata('nope'),
                'jumlah' => $jml,
                'total' => $ttl,
                'Tgl_pesan' => date('Y-m-d H:i')
        );  
        $this->db->insert('transaksi',$data);
      }
      function process($user)
      {
        $this->db->where('user',$user);
        $this->db->where('Tgl_pesan',date('Y-m-d H:i'));
        $trans = $this->db->get('transaksi')->row_array();
        foreach($this->cart->contents() as $item)
        {
          $data = array(
              'kode_trans' => $trans['Kode'],
              'kode_barang' => $item['id'],
              'user'   => $user,
              'quantity' => $item['qty'],
              'total'  => $item['price'],
          );
          $this->db->insert('det_trans',$data);
        }
        $this->cart->destroy();
      }
      function select_by_id($id)
      {
        $this->db->where('id',$id);
        return $this->db->get('produk')->row();
      }
      function editproduk($id)
      {
        $data['produk'] = $this->produk_model->select_by_id($id);
        $this->load->view('admin/edit_barang',$data);
      }
      function proseseditproduk()
      {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 10000;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload())
        {
          $id = $this->input->post('id');
          redirect('admin/editproduk/'.$id);
        }
        else
        {
          $gambar = $this->upload->data();
          $data['kategori'] = $this->input->post('kategori',true);
          $data['brand'] = $this->input->post('brand',true);
          $data['model'] = $this->input->post('model',true);
          $data['dimensi'] = $this->input->post('dimensi',true);
          $data['keterangan'] = $this->input->post('keterangan',true);
          $data['harga'] = $this->input->post('harga',true);
          $data['gambar'] = $gambar['file_name'];
          $id=$this->input->post('id');
          $this->produk_model->edit_produk($id,$data);
          redirect('admin/daftarproduk');
        }
      }function insert_anak($idrapat,$data){
        $data = array(
          'IdRapat' => $idrapat,
          'NIP' => $data,
          'StatusSurat' => 'N'
      );
      $this->db->insert('tbl_staff_rapat',$data);
      }
       function insert_konfirmasi($data)
      {
      $this->db->insert('konfirmasi',$data);
      }
      function konfirmasi($id)
      {
      $this->db->where('invoice_id',$id);
      return $this->db->get('konfirmasi')->result();
      }
      function sts($id)
      {
        //$this->db->where('Kode',$id);
          $this->db->query("Update transaksi set Status = 'Sudah Bayar' where Kode ='".$id."'");
      }
 }  