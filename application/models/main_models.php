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
      function daftar_pegawai()
      {
        return $this->db->get('tbl_pegawai')->result();
      }
      function daftar_account()
      {
        return $this->db->get('tbl_account')->result();
      }
      function daftar_rapat()
      {
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
        $this->db->insert('users',$data);
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