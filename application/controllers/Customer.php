<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Customer extends CI_Controller{

    public function add_detail_order()
  	{
      $valid = 1;
      $error = array();

  		$order_key = trim($this->input->post('order_key'));
      if(empty($order_key)){
        $valid = 0;
      }

  		$nama_pemesan = trim($this->input->post('nama_pemesan'));
      if(empty($nama_pemesan)){
        $valid = 0;
        array_push($error, "Nama pemesan masih tidak terisi");
      }

  		$harga = (int)$this->input->post('harga');
      if($harga <= 0){
        $valid = 0;
        array_push($error, "Harga (".$harga.") tidak sesuai");
      }

  		$email = trim($this->input->post('email'));
      if(empty($email)){
        $valid = 0;
        array_push($error, "Email masih tidak terisi");
      }

      if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $valid = 0;
        array_push($error, "Email tidak valid");
      }

  		$kota_asal = trim($this->input->post('kota_asal'));
      if(empty($kota_asal)){
        $valid = 0;
        array_push($error, "Kota asal masih tidak terisi");
      }

  		$kota_tujuan = trim($this->input->post('kota_tujuan'));
      if(empty($kota_tujuan)){
        $valid = 0;
        array_push($error, "Kota tujuan masih tidak terisi");
      }

  		$tanggal_berangkat = trim($this->input->post('tanggal_berangkat'));
      if(empty($tanggal_berangkat)){
        $valid = 0;
        array_push($error, "Tanggal berangkat masih tidak terisi");
      }

  		$airline = trim($this->input->post('airline'));
      if(empty($airline)){
        $valid = 0;
        array_push($error, "Airline masih tidak terisi");
      }

      $ip_address = $this->input->post('ipaddress');
      if(!filter_var($ip_address, FILTER_VALIDATE_IP)){
        $valid = 0;
        array_push($error, "IP Address tidak valid");
      }

      if($valid == 1){
        $out['status'] = "OK";
      }else{
        $out['status'] = "FAIL";
      }

      $out['error'] = $error;

  		$order_time = date("Y-m-d H:i:s");
  		$status = 0;

      if($valid==1){
        $this->load->model('customer_model');
        $is_registered = 0;
        if($this->customer_model->is_registered($email)){
          $is_registered = 1;
        }
        if(!$this->customer_model->add_order($order_key, $nama_pemesan, $is_registered, $harga, $email, $kota_asal, $kota_tujuan, $tanggal_berangkat, $airline, $ip_address, $order_time, $status)){
          $out['status'] = "FAIL";
          array_push($out['error'],"Pesanan gagal ditambahkan");
        }
      }

      echo json_encode($out);
  	}

    public function tambah_penumpang()
    {
      $penumpangs = $this->input->post('penumpang');
      print_r($penumpangs);
      foreach ($penumpangs as $penumpang) {
        $this->add_penumpang($penumpang['key'], $penumpang['tipe'], $penumpang['title'], $penumpang['nama'], $penumpang['tanggal_lahir'], $penumpang['bulan_lahir'], $penumpang['tahun_lahir']);
      }
    }

    public function add_penumpang($key, $tipe, $title, $nama, $tgl_lahir, $bulan_lahir, $tahun_lahir)
    {
      // $key = $this->input->post('order_key');
      // $tipe = (int)$this->input->post('tipe');
      // $title = (int)$this->input->post('title');
      // $nama = $this->input->post('nama');
      // $tgl_lahir = $this->input->post('tgl_lahir');
      // $bulan_lahir = $this->input->post('bulan_lahir');
      // $tahun_lahir = $this->input->post('tahun_lahir');

      $valid = 1;
      $error = array();
      if(empty($key)){
        $valid = 0;
        array_push($error, "Key error");
      }
      if(empty($tipe)){
        $valid = 0;
        array_push($error, "Tipe error");
      }
      if(empty($title)){
        $valid = 0;
        array_push($error, "Title error");
      }
      if(empty($nama)){
        $valid = 0;
        array_push($error, "Nama error");
      }
      if(empty($tgl_lahir)){
        $valid = 0;
        array_push($error, "Tanggal lahir error");
      }
      if(empty($bulan_lahir)){
        $valid = 0;
        array_push($error, "Bulan lahir error");
      }
      if(empty($tahun_lahir)){
        $valid = 0;
        array_push($error, "Tahun lahir error");
      }

      if($valid == 1){
        $tgl_lahir = $tahun_lahir."-".$bulan_lahir."-".$tgl_lahir;

        $this->load->model('customer_model');
        $this->customer_model->add_penumpang($key, $nama, $title, $tipe, $tgl_lahir);
        $status = "OK";
      }else{
        $status = "FAIL";
      }
      $our['status'] = $status;
      $out['error'] = $error;
      echo json_encode($out);
    }

  }
