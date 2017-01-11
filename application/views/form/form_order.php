
  <div id='form-order' class='middle-center form-ungu'>
    <div class='row'>
      <div class='col-sm-6'>
        <div class='form-group'>
          <label>Kota Asal</label>
          <select id='kota_asal' class='kota form-control'>
            <option value=''>Loading...</option>
          </select>
        </div>
      </div>
      <div class='col-sm-6'>
        <div class='form-group'>
          <label>Kota Tujuan</label>
          <select id='kota_tujuan' class='kota form-control'>
            <option value=''>Loading...</option>
          </select>
        </div>
      </div>
    </div>
    <div class='form-group'>
      <label>Tanggal Berangkat</label>
      <input type='date' id='tanggal_berangkat' class='form-control' value='<?php echo date("Y-m-").(date("d")+2); ?>'/>
    </div>
    <div class='row'>
      <div class='col-sm-4'>
        <div class='form-group'>
          <label>Dewasa</label>
          <input id='penumpang_dewasa' type='number' class='form-control' value='1' min='1' max='7'/>
        </div>
      </div>
      <div class='col-sm-4'>
        <div class='form-group'>
          <label>Anak (2-11thn)</label>
          <input id='penumpang_anak' type='number' value='0' class='form-control' min='0' max='6'/>
        </div>
      </div>
      <div class='col-sm-4'>
        <div class='form-group'>
          <label>Bayi (dibawah 2thn)</label>
          <input id='penumpang_bayi' type='number' class='form-control' value='0' min='0' max='4'/>
        </div>
      </div>
    </div>
    <div class='row'>
      <div class='col-sm-8'>
        <div class='form-group'>
          <label>Maskapai</label>
          <select id='maskapai' class='maskapai form-control'>
            <option value=''>Pilih Maskapai</option>
          </select>
        </div>
      </div>
      <div class='col-sm-4'>
        <div class='form-group'>
          <label>Harga</label>
          <input type='number' id='harga' class='form-control' disabled/>
        </div>
      </div>
    </div>
    <div class='form-group'>
      <label>IP Address</label>
      <input list='ipaddress' class='form-control'/>
      <datalist id='ipaddress'></datalist>
    </div>
    <button type='button' onclick='order()' class='btn btn-order'>Order!</button>
  </div>
