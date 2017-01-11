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

  }
