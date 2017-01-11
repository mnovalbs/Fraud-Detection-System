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
      $query = $this->db->query("SELECT * FROM detail_order AS a INNER JOIN creditcard AS b ON a.order_id = b.order_id WHERE b.cc_number = $cc" LIMIT 10);
      return $query->result_array();
    }
    
     public function get_last($cc)
    {
      $cc = $this->db->escape($cc);
      $query = $this->db->query("SELECT * FROM detail_order AS a INNER JOIN creditcard AS b ON a.order_id = b.order_id WHERE b.cc_number = $cc" LIMIT 1);
      return $query->row_array();
    }
    
    

  }

