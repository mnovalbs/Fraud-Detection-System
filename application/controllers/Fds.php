<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fds extends CI_Controller {

	public function index()
	{
	}

  public function is_cc_blacklisted($cc)
  {
    $this->load->model('fds_model');
    return $this->fds_model->is_cc_blacklisted($cc);
  }

  public function is_email_blacklisted($email)
  {
    $this->load->model('fds_model');
    return $this->fds_model->is_email_blacklisted($email);
  }

  public function score_card_check()
  {
		$key = $this->input->post('key');
		$email = $this->input->post('email');
		$ip = $this->input->post('ip');
		$cc = $this->input->post('cc');
		$harga = $this->input->post('harga');
		$nama_pemesan = $this->input->post('nama_pemesan');
		$nama_cc = $this->input->post('nama_cc');
		$bulan_expired = $this->input->post('bulan');
		$tahun_expired = $this->input->post('tahun');

		$valid = true;
		$error = array();

		if(empty($email)){
			$valid = false;
			array_push($error,"Email empty");
		}
		if(empty($ip)){
			$valid = false;
			array_push($error,"IP empty");
		}
		if(empty($cc)){
			$valid = false;
			array_push($error,"CC empty");
		}
		if(empty($harga)){
			$valid = false;
			array_push($error,"Harga` empty");
		}
		if(empty($nama_pemesan)){
			$valid = false;
			array_push($error,"Nama Pemesan empty");
		}
		if(empty($nama_cc)){
			$valid = false;
			array_push($error,"Nama CC empty");
		}

		if($valid){

			$reject = false;
			$pesan_fraud = array();
			if($this->is_email_blacklisted($email)){
				$reject = true;
				array_push($pesan_fraud, "[-] Email blacklisted");
			}
			if($this->is_cc_blacklisted($cc)){
				$reject = true;
				array_push($pesan_fraud, "[-] CC Blacklisted");
			}

			if(!$reject){
				$fraud_score = 0;

				#1 Nama Pemesan == Nama Credit Card
				if(!$this->sc_check1($nama_pemesan, $nama_cc)){
					$fraud_score += 10;
					array_push($pesan_fraud, "[-] Nama Pemesan != Nama Credit Card");
				}else{
					array_push($pesan_fraud, "[+] Nama Pemesan == Nama Credit Card");
				}

				#2 Transaksi Dalam Jumlah Besar Berdekatan (12 Jam)
				if($this->sc_check2($harga,$cc)){
					$fraud_score += 5;
					array_push($pesan_fraud, "[-] Transaksi dalam jumlah besar berdekatan");
				}else{
					array_push($pesan_fraud, "[+] Tidak ada transaksi dalam jumlah besar berdekatan");
				}

				#3 CC Berasal Dari High Risk Country
				if($this->sc_check3($cc)){
					$fraud_score += 10;
					array_push($pesan_fraud, "[-] CC berasal dari high risk country");
				}else{
					array_push($pesan_fraud, "[+] CC bukan berasal dari high risk country");
				}

				#4 Negara IP == Negara Credit Cart
				if(!$this->sc_check4($ip,$cc)){
					$fraud_score += 10;
					array_push($pesan_fraud, "[-] Negara pemesan tidak sama dengan negara pemilik CC");
				}else{
					array_push($pesan_fraud, "[+] Negara pemesan sama dengan negara pemilik CC");
				}

				#5 Transaksi Baru Lebih Besar Dari Rata2 10 Transaksi
				if($this->sc_check5($harga,$cc)){
					$fraud_score += 5;
					array_push($pesan_fraud, "[-] Transaksi baru lebih besar dari rata-rata 10 transaksi");
				}else{
					array_push($pesan_fraud, "[+] Transaksi baru tidak lebih besar dari rata-rata 10 transaksi");
				}

				#6 IP Berubah Secara Cepat (12 Jam)
				if($this->sc_check6($ip,$cc)){
					$fraud_score += 15;
					array_push($pesan_fraud, "[-] IP berubah secara cepat (dalam 12 jam)");
				}else{
					array_push($pesan_fraud, "[+] IP tidak berubah secara cepat (dalam 12 jam)");
				}

				#7 Menggunakan Multiple CC dalam 3 Hari
				if($this->sc_check7($ip)){
					$fraud_score += 10;
					array_push($pesan_fraud, "[-] Menggunakan multiple CC dalam 3 hari terakhir");
				}else{
					array_push($pesan_fraud, "[+] Tidak menggunakan multiple CC dalam 3 hari terakhir");
				}

				#8 Terdaftar sebagai member
				if(!$this->sc_check8($email)){
					$fraud_score += 5;
					array_push($pesan_fraud, "[-] Tidak terdaftar sebagai member");
				}else{
					array_push($pesan_fraud, "[+] Terdaftar sebagai member");
				}

				#9 Transaksi Sukses Sebelumnya
				if(!$this->sc_check9($email)){
					$fraud_score += 5;
					array_push($pesan_fraud, "[-] Transaksi sebelumnya tidak berhasil");
				}else{
					array_push($pesan_fraud, "[-] Transaksi sebelumnya berhasil");
				}

				if($fraud_score <= 30){
					$out['cc_status'] = "ACCEPTED";
					$this->load->model('customer_model');
					$this->customer_model->accept_order($key);
					$this->customer_model->accept_cc($key, $cc, $nama_cc, $bulan_expired, $tahun_expired);
				}else if($fraud_score > 30 && $fraud_score <= 40){
					$out['cc_status'] = "WAITING FOR REVIEW";
				}else{
					$out['cc_status'] = "REJECTED";
				}

				$out['status'] = 'OK';
				$out['fraud_score'] = $fraud_score;
				$out['pesan_fraud'] = $pesan_fraud;
			}else{
				$out['status'] = 'OK';
				$out['fraud_score'] = 100;
				$out['pesan_fraud'] = $pesan_fraud;
				$out['cc_status'] = "REJECTED";
			}

		}else{
			$out['status'] = 'FAIL';
		}
		$out['error'] = $error;

		echo json_encode($out);
  }

  //Apakah Nama Pemegang Kartu == Nama Pemesan
  protected function sc_check1($nama_pemesan, $nama_cc)
  {
		$nama_pemesan = strtolower($nama_pemesan);
		$nama_cc = strtolower($nama_cc);
    if($nama_cc == $nama_pemesan){
      return true;
    }else{
      return false;
    }
  }

  //Pemesanan Dalam Jumlah Besar Berdekatan
  //dalam 24 jam terakhir
  protected function sc_check2($harga,$cc)
  {

	  $this->load->model('fds_model');
	  $transaksi = $this->fds_model->get_last_ten_order($cc);

		$out = false;
		if(!empty($transaksi)){
			$total = 0;
			foreach ($transaksi as $tr) {
				$total += $r['harga'];
			}
			$avg1 = $total/count($transaksi);

			$interval = 60*60*24; //24 Jam
			$search_date = strtotime(date("Y-m-d H:i:s") - $interval);

			$orders = $this->fds_model->order_after_date($search_date,$cc);
			$avg2 = $total2 = 0;
			if(!empty($orders)){
				foreach ($orders as $order) {
					$total2 += $order['harga'];
				}
			}
			$total2 += $harga;
			$avg2 = $total2/(count($orders)+1);

			if($avg2 > $avg1){
				$out = true;
			}
		}

		return $out;
  }

  //CC Berasal Dari High Risk Country
  protected function sc_check3($cc)
  {
	  $bin_cc = substr($cc,0,6);

	  $blacklisted_bin = array("336555","443224","118234",
	  "738992","928774","847368","735935","914762","555972",
	  "853175","951353","373832","135798","379158","325978");

	  return (in_array($bin_cc,$blacklisted_bin));
  }


	//Negara Pemesan == Negara Credit Card
	protected function sc_check4($ip, $cc)
	{
		$binNumber = substr($cc,0,6);
		$ipLoc = file_get_contents('http://freegeoip.net/json/'.$ip);
		$ipLoc = json_decode($ipLoc);
		$ipLoc = $ipLoc->country_name;

		$ccLoc = file_get_contents('https://binlist.net/json/'.$binNumber);
		$ccLoc = json_decode($ccLoc);
		$ccLoc = $ccLoc->country_name;

		return ($ipLoc == $ccLoc);
	}

  //Pemesanan > rata2 10 transaksi
  protected function sc_check5($harga,$cc)
  {
	  $this->load->model('fds_model');
	  $transaksi = $this->fds_model->get_last_ten_order($cc);

		if(empty($transaksi)){
			return false;
		}else{
			$total = 0;
			foreach ($transaksi as $tr) {
				$total += $r['harga'];
			}

			$avg = $total/count($transaksi);
			return ($harga > $avg);
		}

  }

  //IP Berubah Secara Cepat
  protected function sc_check6($ip_now,$cc)
  {
		$this->load->model('fds_model');

		$interval = 60*60*12; //12 Jam
		$search_date = strtotime(date("Y-m-d H:i:s") - $interval);

		$orders = $this->fds_model->order_after_date($search_date, $cc);

		$out = false;
		foreach ($orders as $order) {
			if($ip_now!=$order['ip_address']){
				$out = true;
			}
		}

		return $out;
  }

  //Menggunakan Multiple CC dalam 3 hari
  protected function sc_check7($ip)
  {
	  $this->load->model('fds_model');

		$orders = $this->fds_model->last_three_days_order($ip);

	  // $today = date("Y-m-d H:i:s");
	  // $three_days_ago = date('Y-m-d H:i:s',(strtotime ('-3 day', strtotime ($today) )));

		$out = false;
		if(!empty($orders)){
			$cc = $orders[0]['cc_number'];
		}
		foreach ($orders as $order) {
			if($cc!=$order['cc_number']){
				$out = true;
			}
		}

		return $out;

  }

  //Terdaftar sebagai member
  protected function sc_check8($email)
  {
	  $this->load->model('customer_model');
	  return $this->customer_model->is_registered($email);
  }

  //Transaksi sukses sebelumnya
  protected function sc_check9($email)
  {
		$this->load->model('fds_model');
		$last_order = $this->fds_model->get_last_order($email);
		$ret = true;
		if($last_order!=false){
			if($ret['status']!=1){
				$ret = false;
			}
		}

		return $ret;
  }

}
