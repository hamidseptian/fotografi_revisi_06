<div class="box-header with-border">
  <h3 class="box-title">Edit Data Paket</h3>

  <div class="box-tools pull-right">
    <a href="?a=paket" class="btn btn-info" >Kembali</a>
  </div>
</div>


<?php 
$id=$_GET['id'];
  $q1=mysqli_query($conn, "SELECT * from paket where id_paket='$id'") or die(mysqli_error());
  $d1=mysqli_fetch_array($q1);
  $j1=mysqli_num_rows($q1);
 ?>

<br>

<div class="col-md-6">
<form action="form/paket/simpanedit_paket.php" method="post" enctype="multipart/form-data">

           <div class="form-group">
                  <label>Nama Paket</label>
                  <input type="hidden" name="fotolama" class="form-control" value="<?php echo $d1['gambar'] ?>">
                  <input type="hidden" name="id" class="form-control" value="<?php echo $d1['id_paket'] ?>">
                  <input type="text" name="tipe" class="form-control" value="<?php echo $d1['nama_paket'] ?>">
              </div> 
              <div class="form-group">
                  <label>Lama Waktu Pemotretan</label>
                  <input type="number" name="lama" required class="form-control" value="<?php echo $d1['lama_potret'] ?>">
                  <div class="col-md-4"><input type="radio" name="jenis_waktu" value="Menit" required <?php if($d1['jenis_waktu']=="Menit"){echo "checked";} ?>>Menit</div>
                  <div class="col-md-4"><input type="radio" name="jenis_waktu" value="Jam" required <?php if($d1['jenis_waktu']=="Jam"){echo "checked";} ?>>Jam</div>
                  <div class="col-md-4"><input type="radio" name="jenis_waktu" value="Hari" required <?php if($d1['jenis_waktu']=="Hari"){echo "checked";} ?>>Hari</div>
                  <div class="clearfix"></div>
              </div> 

              <div class="form-group">
                  <label>Paket Yang Ditawarkan</label>
                  <select class="form-control" name="level">
                  <?php 
                  $p = array('Silver','Gold','Platinum','Titanium');
                  foreach ($p as $pp) { ?>
                  <option value="<?php echo $pp ?>" <?php if($d1['level_paket']==$pp){echo "selected";} ?>><?php echo $pp ?></option>
                  <?php  } ?>
                    
                  </select>
              </div> 
              <div class="form-group">
                  <label>Biaya</label>
                  <input type="number" name="biaya" required class="form-control" value="<?php echo $d1['biaya'] ?>">
              </div> 
                <div class="form-group">
                  <label>Fasilitas</label>
                  <textarea name="fasilitas" required class="form-control">
                    <?php 
                    $f = str_replace("<br />", "", $d1['fasilitas']);
                    echo $f;
                     ?>
                  </textarea>
              </div> 
              <div class="form-group">
                  <label>Bisa di Booking</label>
                  <select class="form-control" name="book">
                  <?php 
                  $p = array('Ya','Tidak');
                  foreach ($p as $pp) { ?>
                  <option value="<?php echo $pp ?>" <?php if($d1['bisa_booking']==$pp){echo "selected";} ?>><?php echo $pp ?></option>
                  <?php  } ?>
                    
                  </select>
              </div>  
             
             <div class="form-group">
                  <label>Gambar</label>
                  <input type="file" name="berkas" required >
              </div> 
          
              <div class="form-group">
                 <input type="submit" class="btn btn-info" onclick="return confirm('apakah data yang anda masukan sudah benar.?')"value="Simpan Perubahan Data">
              </div> 

              
          
</form>
</div>