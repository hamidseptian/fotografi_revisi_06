<div class="box-header with-border">
  <h3 class="box-title">Edit Data Harga Cetak</h3>

  <div class="box-tools pull-right">
    <a href="?a=hcf" class="btn btn-info" >Kembali</a>
  </div>
</div>


<?php 
$id=$_GET['id'];
  $q1=mysqli_query($conn, "SELECT * from harga_cetak where id_hc='$id'") or die(mysqli_error());
  $d1=mysqli_fetch_array($q1);
  $j1=mysqli_num_rows($q1);
 ?>

<br>

<div class="col-md-6">
<form action="form/hcf/simpanedit_hcf.php" method="post" enctype="multipart/form-data">

              <div class="form-group">
                  <label>Nama Ballroom</label>
                  <input type="hidden" name="id" class="form-control" value="<?php echo $d1['id_hc'] ?>">
                  <input type="text" name="nama" class="form-control" value="<?php echo $d1['ukuran'] ?>">
              </div> 
              <div class="form-group">
                  <label>Keterangan</label>
                  <input type="text" name="ket" class="form-control" value="<?php echo $d1['keterangan'] ?>">
              </div> 
              <div class="form-group">
                  <label>Harga Tanpa Frame</label>
                  <input type="number" name="htf" class="form-control" value="<?php echo $d1['tanpa_frame'] ?>">
              </div> 
              <div class="form-group">
                  <label>Harga Dengan Frame</label>
                  <input type="number" name="hdf" class="form-control" value="<?php echo $d1['dengan_frame'] ?>">
              </div> 
             
          
              <div class="form-group">
                 <input type="submit" class="btn btn-info" onclick="return confirm('apakah data yang anda masukan sudah benar.?')"value="Simpan Perubahan Data">
              </div> 

              
          
</form>
</div>