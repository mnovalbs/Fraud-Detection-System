<?php

  class Json extends CI_Controller{

    public function is_valid_ip($str='')
  	{
  		$out = true;
  		if(!filter_var($str,FILTER_VALIDATE_IP)){
  			$out = false;
  		}
  		echo json_encode($out);
  	}

    public function get_recorded_ip()
    {
      $this->load->model('customer_model');
      echo json_encode($this->customer_model->get_recorded_ip());
    }

  }
