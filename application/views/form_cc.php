
<form>
Name on Card:<br>
<input type="text" name="nama_cc">
<br><br>

Credit Card Number:<br>
<input type="text" name="nomor_cc">
<br><br>

Expiration Date (MM/YY):<br>
<select name="bulan">
<?php
for($i=1;$i<=12;$i++){
echo "<option value='".$i."'>".$i."</option>";
}
?>
</select>
/
<select name="tahun">
<?php
for($i=2017;$i<=2025;$i++){
echo "<option value='".$i."'>".$i."</option>";
}
?>
</select>
<hr>

<center>
<button type="button" onclick="alert('Data Submitted')">Submit</button>
</center>

<input type="date">

</form>


<?php

  $ipLoc = file_get_contents('http://freegeoip.net/json/110.138.14.232');
  $ipLoc = json_decode($ipLoc);
  echo $ipLoc->country_name;
  
  $ccLoc = file_get_contents('https://binlist.net/json/431940');
  $ccLoc = json_decode($ccLoc);
  echo $ccLoc->country_name;

?>