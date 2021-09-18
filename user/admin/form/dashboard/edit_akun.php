<div class="box-header with-border">
  <h3 class="box-title">Edit Akun</h3>

  <div class="box-tools pull-right">
    <a href="?a=produk" class="btn btn-info" >Kembali</a>
  </div>
</div>


<?php 
$iduser = $_SESSION['id_admin'];
$level = $_SESSION['level'];



  $quser = mysqli_query($conn, "SELECT * from admin where id='$iduser'")or die(mysqli_error());
  $duser = mysqli_fetch_array($quser);
  $username=$duser['username'];
  $password=$duser['password'];
  $nama_admin=$duser['nama_admin'];
  $jabatan=$duser['jabatan'];

?>

<br>

<form action="form/dashboard/simpanedit_akun.php" method="post" enctype="multipart/form-data">
 
  <div class="col-md-7">
    
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" value="<?php echo $nama_admin ?>">
              </div> 
                <div class="form-group">
                  <label>Jabatan</label>
                  <input type="text" name="jabatan" class="form-control" value="<?php echo $jabatan ?>">
              </div> 
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" value="<?php echo $username ?>">
              </div> 
              
              <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" required class="form-control" value="<?php echo $password ?>">
              </div> 

             
              <div class="form-group">
                 <input type="submit" class="btn btn-info" onclick="return confirm('apakah data yang anda masukan sudah benar.?')" value="Simpan Perubahan Data">
              </div> 

  </div>
             


              
          
</form>