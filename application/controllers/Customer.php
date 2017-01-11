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
        array_push($error, "Harga barang tidak sesuai");
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

  		$tanggal_datang = trim($this->input->post('tanggal_datang'));
      if(empty($tanggal_datang)){
        $valid = 0;
        array_push($error, "Tanggal kedatangan masih tidak terisi");
      }

  		$airline = trim($this->input->post('airline'));
      if(empty($airline)){
        $valid = 0;
        array_push($error, "Airline masih tidak terisi");
      }

      if($valid == 1){
        $out['status'] = "OK";
      }else{
        $out['status'] = "FAIL";
      }

      $out['error'] = $error;

  		$ip_address = get_client_ip();
  		$order_time = date("Y-m-d H:i:s");
  		$status = 0;

      if($valid==1){

      }

      echo json_encode($out);
  	}

  }
