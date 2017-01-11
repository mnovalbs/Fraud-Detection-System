<?php

  class Customer_model extends CI_Model{

    public function is_registered($email){
      $email = $this->db->escape($email);
      $query = $this->db->query("SELECT email FROM customer WHERE email = $email");
      if($query->num_rows()!=0){
        return true;
      }else{
        return false;
      }
    }

    public function get_recorded_ip()
    {
      $query = $this->db->query("SELECT DISTINCT ip_address FROM detail_order");
      return $query->result_array();
    }

    public function add_order($key, $nama, $is_registered, $harga, $email, $kota_asal, $kota_tujuan, $tanggal_berangkat, $airline, $ip_address, $order_time, $status)
    {
      $key = $this->db->escape($key);
      $nama = $this->db->escape($nama);
      $is_registered = (int)$is_registered;
      $harga = (int)$harga;
      $email = $this->db->escape($email);
      $kota_asal = $this->db->escape($kota_asal);
      $kota_tujuan = $this->db->escape($kota_tujuan);
      $tanggal_berangkat = $this->db->escape($tanggal_berangkat);
      $airline = $this->db->escape($airline);
      $ip_address = $this->db->escape($ip_address);
      $order_time = $this->db->escape($order_time);
      $status = (int)$status;

      return $query = $this->db->query("INSERT INTO detail_order (order_key, nama_pemesan, is_registered, harga, email_address, kota_asal, kota_tujuan, tanggal_berangkat, airline, ip_address, order_time, status) VALUES ($key, $nama, $is_registered, $harga, $email, $kota_asal, $kota_tujuan, $tanggal_berangkat, $airline, $ip_address, $order_time, $status)");
    }

    public function add_penumpang($key, $nama, $title, $tipe, $tgl_lahir)
    {
      $key = $this->db->escape($key);
      $nama = $this->db->escape($nama);
      $title = (int)$title;
      $tipe = (int)$tipe;
      $tgl_lahir = $this->db->escape($tgl_lahir);
      $query = $this->db->query("INSERT INTO penumpang (order_key, nama_penumpang, title, tipe, tanggal_lahir) VALUES ($key, $nama, $title, $tipe, $tgl_lahir)");
    }

  }
