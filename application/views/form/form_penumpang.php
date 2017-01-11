
  <div class='form-group'>
    <label>Nama Penumpang</label>
    <div class='row'>
      <div class='col-sm-3'>
        <select name='title' class='form-control title_penumpang'>
          <option value='1'>Mr.</option>
          <option value='2'>Ms.</option>
          <option value='3'>Mrs.</option>
        </select>
      </div>
      <div class='col-sm-9'>
        <input type='text' name='nama_penumpang' class='form-control nama_penumpang'>
      </div>
    </div>
  </div>
  <div class='row'>
    <div class='col-sm-4'>
      <div class='form-group'>
        <select name='tanggal' class='form-control tanggal_lahir'>
          <?php
          for($i=1;$i<=31;$i++){
            echo '<option value="'.$i.'">'.$i.'</option>';
          }
          ?>
        </select>
      </div>
    </div>
    <div class='col-sm-4'>
      <div class='form-group'>
        <select name='bulan' class='form-control bulan_lahir'>
          <option value='1'>Januari</option>
          <option value='2'>Febuari</option>
          <option value='3'>Maret</option>
          <option value='4'>April</option>
          <option value='5'>Mei</option>
          <option value='6'>Juni</option>
          <option value='7'>Juli</option>
          <option value='8'>Agustus</option>
          <option value='9'>September</option>
          <option value='10'>Oktober</option>
          <option value='11'>November</option>
          <option value='12'>Desember</option>
        </select>
      </div>
    </div>
    <div class='col-sm-4'>
      <div class='form-group'>
        <select name='tahun' class='form-control tahun_lahir'>
          <?php
          for($i=date('Y');$i>=date("Y")-100;$i--){
            echo '<option value="'.$i.'">'.$i.'</option>';
          }
          ?>
        </select>
      </div>
    </div>
  </div>
