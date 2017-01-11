<?php

  class Fds_model extends CI_Model{

    public function is_cc_blacklisted($cc)
    {
      $cc = $this->db->escape($cc);
      $query = $this->db->query("SELECT * FROM blacklisted_cc WHERE cc_number = $cc");
      if($query->num_rows()!=0){
        return true;
      }else{
        return false;
      }
    }

    public function is_email_blacklisted($email)
    {
      $email = $this->db->escape($email);
      $query = $this->db->query("SELECT * FROM blacklisted_email WHERE email = $email");
      if($query->num_rows()!=0){
        return true;
      }else{
        return false;
      }
    }

    public function get_last_ten_order($cc)
    {
      $cc = $this->db->escape($cc);
      $query = $this->db->query("SELECT * FROM detail_order AS a INNER JOIN creditcard AS b ON a.order_key = b.order_key WHERE b.cc_number = $cc LIMIT 10");
      return $query->result_array();
    }

    public function get_last_order($email)
    {
      $email = $this->db->escape($email);
      $query = $this->db->query("SELECT * FROM detail_order WHERE email_address = $email LIMIT 1");
      if($query->num_rows()!=0){
        return $query->row_array();
      }else{
        return false;
      }
    }

    public function order_after_date($date,$cc)
    {
      $date = $this->db->escape($date);
      $cc = $this->db->escape($cc);
      $query = $this->db->query("SELECT * FROM detail_order AS a INNER JOIN creditcard AS b ON a.order_key = b.order_key WHERE cc_number = $cc AND order_time >= $date");
      return $query->result_array();
    }

    public function last_three_days_order($ip)
    {
      $ip = $this->db->escape($ip);
      $selisih = strtotime(date("Y-m-d H:i:s") - (60*60*24*3));
      
      $three_days_ago = date("Y-m-d H:i:s",$selisih);
      $three_days_ago = $this->db->escape($three_days_ago);
      $query = $this->db->query("SELECT * FROM detail_order AS a INNER JOIN creditcard AS b ON a.order_key = b.order_key WHERE ip_address = $ip AND order_time >= $three_days_ago");
      return $query->result_array();
    }

  }
