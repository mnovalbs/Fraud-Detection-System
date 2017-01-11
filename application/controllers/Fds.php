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
  protected function sc_check1()
  {
    $nama_cc = $this->input->post('nama_cc');
    $nama_pemesan = $this->input->post('nama_pemesan');

    if($nama_cc == $nama_pemesan){
      return true;
    }else{
      return false;
    }
  }

  //Pemesanan Dalam Jumlah Besar Berdekatan
  //dalam 24 jam terakhir
  protected function sc_check2()
  {
	  date_default_timezone_set('Asia/Jakarta');

	  $this->load->model('fds_model');
	  $transaksi = $this->fds_model->get_last_ten_order();
	  $total = 0;
	  foreach ($transaksi as $tr) {
	  	$total += $r['harga'];
	  }
	  $avg = $total/count($transaksi);

	  $tanggal_last = $this->fds_model->get_last()['order_date'];

	  $tanggal_pesan = date("H:i");
	  $harga_pesan = $this->input->post('harga');


	  $interval = abs(strtotime($tanggal_pesan) - strtotime($tanggal_last));
	  $interval = $interval/60/60;

	  if ($interval<=12 && $harga_pesan>=($avg*1.5)){
	    return true;
	  }
	  else {
	    return false;
	  }

  }

  //CC Berasal Dari High Risk Country
  protected function sc_check3()
  {
	  $nomor_cc = $this->input->post('nomor_cc');
	  $bin_cc = substr($nomor_cc,0,5);

	  $blacklisted_bin = array("336555","443224","118234",
	  "738992","928774","847368","735935","914762","555972",
	  "853175","951353","373832","135798","379158","325978");

	  return (in_array($bin_cc,$blacklisted_bin));
  }

  //Negara Pemesan == Negara Credit Cart
  protected function sc_check4()
  {
	  $ipLoc = file_get_contents('http://freegeoip.net/json/110.138.14.232');
	  $ipLoc = json_decode($ipLoc);
	  $ipLoc = $ipLoc->country_name;

	  $ccLoc = file_get_contents('https://binlist.net/json/431940');
	  $ccLoc = json_decode($ccLoc);
	  $ccLoc = $ccLoc->country_name;

	  return ($ipLoc == $ccLoc);
  }


  //Pemesanan > rata2 10 transaksi
  protected function sc_check5()
  {
	  $this->load->model('fds_model');
	  $transaksi = $this->fds_model->get_last_ten_order();
	  $total = 0;
	  foreach ($transaksi as $tr) {
	  	$total += $r['harga'];
	  }

	  $avg = $total/count($transaksi);
	  $harga = $this->input->post('harga');

	  return ($harga > $avg);
  }

  //IP Berubah Secara Cepat
  protected function sc_check6()
  {
	  $ip_now = $this->input->post('ip_address');

	  $this->load->model('fds_model');
	  // $ip_prev =

  }

  //Menggunakan Multiple CC dalam 3 hari
  protected function sc_check7()
  {


  }

  //Terdaftar sebagai member
  protected function sc_check8()
  {

  }

  //Transaksi sukses sebelumnya
  protected function sc_check9()
  {

  }


}
