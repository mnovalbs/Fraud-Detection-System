
<div class='form-group'>
  <label>Name on Card</label>
  <input type="text" id="nama_cc" class='form-control' placeholder="Name on Card">
</div>

<div class='form-group'>
  <label>Credit Card Number</label>
  <input type="text" id="nomor_cc" class='form-control' placeholder='Credit Card Number'>
</div>

<div class='form-group'>
  <label>Expiration Date (MM/YY)</label>
  <div class='row'>
    <div class='col-sm-4'>
      <select id="bulan_cc" class='form-control'>
        <?php
          for($i=1;$i<=12;$i++){
            echo "<option value='".$i."'>".$i."</option>";
          }
        ?>
      </select>
    </div>
    <div class='col-sm-4'>
      <select id="tahun_cc" class='form-control'>
        <?php
          for($i=2017;$i<=date("Y")+8;$i++){
            echo "<option value='".$i."'>".$i."</option>";
          }
        ?>
      </select>
    </div>
    <div class='col-sm-4'>
      <input class='form-control' id='cvv_cc' placeholder='CVV (3 Digit)' maxlength='3'/>
    </div>
  </div>
</div>

<button type="button" class='btn btn-order' onclick="checkout()">Submit</button>
