<form>

<hr>
Nama Penumpang:<br>
<input type="text" name="nama_penumpang">
<br><br>

Title:<br>
<select name="title">
<option value="Mr.">Mr.</option>
<option value="Ms.">Ms.</option>
<option value="Mrs.">Mrs.</option>
</select>
<br><br>

Type:<br>
<select name="tipe">
<option value="Dewasa">Dewasa</option>
<option value="Anak">Anak</option>
<option value="Bayi">Bayi</option>
</select>
<br><br>

Tanggal Lahir:<br>
<select name="tanggal">
<?php
for($i=1;$i<=31;$i++){
echo "<option value='".$i."'>".$i."</option>";
}
?>
</select>

<select name="bulan">
<option value="Januari">Januari</option>
<option value="Febuari">Febuari</option>
<option value="Maret">Maret</option>
<option value="April">April</option>
<option value="Mei">Mei</option>
<option value="Juni">Juni</option>
<option value="Juli">Juli</option>
<option value="Agustus">Agustus</option>
<option value="September">September</option>
<option value="Oktober">Oktober</option>
<option value="November">November</option>
<option value="Desember">Desember</option>
</select>

<select name="tahun">
<?php
for($i=date("Y");$i>=1920;$i--){
echo "<option value='".$i."'>".$i."</option>";
}
?>
</select>
<hr>
<br>

<center>
<button type="button" onclick="alert('Data Submitted')">Submit</button>
</center>

</form>
