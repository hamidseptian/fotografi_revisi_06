	
  <a href="#addalbum" data-toggle="modal" class="btn btn-success">Tambahkan Album</a> <br>

<?php


include "connectdb.php";
  
  $perintah="select * From galeri join kegiatan on galeri.id_kegiatan=kegiatan.id_kegiatan group by galeri.id_kegiatan ";
  $jalan=mysqli_query($conn, $perintah);

  $total = mysqli_num_rows($jalan);
  if ($total==0) {
  	
  	?>
  	<label>Tidak ada album foto galeri kegiatan</label>
  	<?php
  }
  else {
?>

<?php

while ($data=mysqli_fetch_array($jalan))
{ 
$id=$data['id_galeri'];
$post=$data['post'];
$foto=$data['foto'];


$id_k=$data['id_kegiatan'];
$nama=$data['namakegiatan'];
$pelaksana=$data['pelaksana'];
$tgl=$data['tanggal'];
$waktu=$data['waktu'];
$lokasi=$data['alamatkegiatan'];




$pisah=explode('-', $post);
$th=$pisah[0];
$bl=$pisah[1];


if ($bl =="1") {
	$txbl = "January";
}
elseif ($bl =="2") {
	$txbl = "February";
}
elseif ($bl =="3") {
	$txbl = "Maret";
}
elseif ($bl =="4") {
	$txbl = "April";
}
elseif ($bl =="5") {
	$txbl = "Mei";
}
elseif ($bl =="6") {
	$txbl = "Juni";
}
elseif ($bl =="7") {
	$txbl = "Juli";
}
elseif ($bl =="8") {
	$txbl = "Agustus";
}
elseif ($bl =="9") {
	$txbl = "September";
}
elseif ($bl =="10") {
	$txbl = "Oktober";
}
elseif ($bl =="11") {
	$txbl = "November";
}
elseif ($bl =="12") {
	$txbl = "Desember";
}

$tg=$pisah[2];

?>


<div class="col-md-3"  >
	<div style="background: #F2F2F2; margin-bottom: 20px">
	<div style="height: 200px;background: red; margin: 2px;" >
	<center>
		
		
		
		<img src="form/galeri/gambar/<?php echo $foto ;?>" style="width :100%; height:200px;">
	
	</center>		
	</div>

	<div style="height: 80px; ">
	<center><label><h2 style="color:blue"><?php echo $nama; ?></h2> </label></center>
	<?php 
	$jmlfoto=mysqli_query($conn, "Select * From galeri where id_kegiatan='$id_k'");
	$totfoto=mysqli_num_rows($jmlfoto);

	 ?>
	<center><label style="color:green;"><?php echo $totfoto; ?> Foto</label></center>
	</div>
	<div>
	<center><label>Diupload pada <?php echo $tg; ?> <?php echo $txbl; ?> <?php echo $th; ?> </label></center>
	</div>
	<div>
		<center>
		<a href="?m=lihatalbum&id=<?php echo $id_k;?>" class="btn btn-info btn-xs">Lihat Album</a> 
		<!-- <a href="form/galeri/delete_album.php?id=<?php echo $id_k; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Hapus File <?php echo $ket; ?> ..??')">Hapus</a> --> 
		</center><br>
	</div></div>
	
</div>
		<?php } }?>
				
		
<div class="modal fade" id="addalbum" role="dialog">
    <form method="post" action="?m=carikegiatan" > 
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
              <center> <label><h2>Tambah Album Foto</h2></label></center>
              </div>
              <div class="modal-body">
                <label>Cari Nama Kegiatan</label>
                <input type="text" class="form-control" name="cari">
                

              </div>
              <div class="modal-footer">
                <input type="submit" value="Cari Kegiatan"class="btn btn-info">
                <a data-dismiss="modal" href="" class="btn btn-dark">Tutup</a>
              </div>
            </div>
          </div>
      </form>
    </div>