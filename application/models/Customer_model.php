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
      return $query = $this->db->query("INSERT INTO penumpang (order_key, nama_penumpang, title, tipe, tanggal_lahir) VALUES ($key, $nama, $title, $tipe, $tgl_lahir)");
    }

    public function accept_order($key)
    {
      $key = $this->db->escape($key);
      $query = $this->db->query("UPDATE detail_order SET status = 1 WHERE order_key = $key");
    }

    public function accept_cc($key, $cc, $nama_cc, $bulan_expired, $tahun_expired)
    {
      $key = $this->db->escape($key);
      $cc = $this->db->escape($cc);
      $nama_cc = $this->db->escape($nama_cc);
      $bulan_expired = (int)$bulan_expired;
      $tahun_expired = (int)$tahun_expired;

      $query = $this->db->query("INSERT INTO creditcard (order_key, cc_number, nama_cc, bulan_expired, tahun_expired) VALUES ($key, $cc, $nama_cc, $bulan_expired, $tahun_expired)");
    }

  }
