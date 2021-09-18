<?php 
$id = $_SESSION['iduser'];
$q = mysqli_query($conn, "SELECT * from pelanggan where id_pelanggan = '$id'");
$d = mysqli_fetch_array($q)
 ?>


<div class="col-md-12">
	<div class="box-header with-border">
	<h3 class="box-title">Registrasi Pelanggan (Online)</h3>
  </div>
</div>

<div class="col-md-12">
		
			<form method="post" action="form/register/simpanedit_pelanggan.php">
					<br>
		<div class="form-group">
			<label>Nama</label>
			<input type="text" name="nama" class="form-control" value="<?php echo $d['nama_pelanggan'] ?>">
		</div> 	
						
		<div class="form-group"> 	
			<label>Alamat</label>
			<input type="text" name="alm" class="form-control" value="<?php echo $d['alamat_pelanggan'] ?>"> 
		</div>		
		<div class="form-group"> 	
			<label>No HP</label>
			<input type="text" name="hp" class="form-control" value="<?php echo $d['nohp_pelanggan'] ?>"> 
		</div>
		<div class="form-group"> 	
			<label>Email</label>
			<input type="text" name="email" class="form-control" value="<?php echo $d['email_pelanggan'] ?>"> 
		</div>
		<div class="form-group"> 	
			<label>Password</label>
			<input type="password" name="pass" class="form-control" value="<?php echo $d['password'] ?>" > 
		</div>
				
			<input type="submit" value="Simpan" class="btn btn-info"> 
			<!-- <a href="?a=pelanggan" class="btn btn-info">Kembali</a> -->
		</form>
	</div>
				<div class="clearfix"> </div>
