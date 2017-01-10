<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fds extends CI_Controller {

	public function index()
	{
	}

  public function is_cc_blacklisted()
  {
    $this->load->model('fds_model');
    $cc = $this->input->post('cc_number');
    echo json_encode($this->fds_model->is_cc_blacklisted($cc));
  }

  public function is_email_blacklisted()
  {
    $this->load->model('fds_model');
    $email = $this->input->post('email');
    echo json_encode($this->fds_model->is_email_blacklisted($email));
  }

  public function score_card_check()
  {
    $fraud_score = 0;

    if(!$this->sc_check1){
      $fraud_score += 10;
    }

  }

  //Apakah Nama Pemegang Kartu == Nama Pemesan
  public function sc_check1()
  {
    $nama_cc = $this->input->post('nama_cc');
    $nama_pemesan = $this->input->post('nama_pemesan');

    if($nama_cc == $nama_pemesan){
      return true;
    }else{
      return false;
    }
  }

  //Pemesanan Dalam Jumlah Berdekatan
  public function sc_check2()
  {

  }

  //CC Berasal Dari High Risk Country
  public function sc_check3()
  {

  }

  //Negara Pemesan Berasal == Negara Credit Card
  public function sc_check4()
  {

  }

  //Pemesanan > rata2 10 transaksi
  public function sc_check5()
  {

  }

}
