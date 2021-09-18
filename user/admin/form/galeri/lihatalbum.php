

<?php
//  $coma=mysqli_query($conn, "select max(id) as maxi from dataanak");
//  $cblg=mysqli_fetch_array($coma);
//  {
//  	$te=$cblg['maxi'];
//  }
// echo $te;
// $vv=$te-1;
// echo $vv;

 $id_ambil = $_GET['id'];

  $perintah="SELECT * From galeri";
  $jalan=mysqli_query($conn, $perintah);
  $total = mysqli_num_rows($jalan);
 

  $pr="select * From galeri join kegiatan on galeri.id_kegiatan=kegiatan.id_kegiatan where galeri.id_kegiatan='$id_ambil'";
  $jl=mysqli_query($conn, $pr);

$dt=mysqli_fetch_array($jl);{

$id_k=$dt['id_kegiatan'];
$nama=$dt['namakegiatan'];
$pelaksana=$dt['pelaksana'];
$tgl=$dt['tanggal'];



$pisah=explode('-', $tgl);
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

$waktu=$dt['waktu'];
$lokasi=$dt['alamatkegiatan'];
}
?>





<div class="col-md-12">	
<label>	<h2>Album Foto Kegiatan <?php echo $nama; ?></h2></label><br>	
<label>Kegiatan <?php echo $nama; ?> telah dilaksanakan  pada tanggal <?php echo $tg; echo " "; echo $txbl; echo " "; echo $th; ?> jam <?php echo $waktu; ?> di <?php echo $lokasi; ?></label><br>	
<a href="#addfoto" data-toggle="modal" class="btn btn-success">Tambahkan Foto</a> <br>	
</div>


<?php

while ($data=mysqli_fetch_array($jalan))
{ 
$id=$data['id_galeri'];
$post=$data['post'];
$foto=$data['foto'];




?>


<div class="col-md-4"  >
	<div style="background: #F2F2F2; margin-bottom: 20px">
	<div style="background: red; height: 240px;">
	<center>
		
		
		
		<img src="form/galeri/gambar/<?php echo $foto ;?>" style="width :100%; height:240px;">
	
	</center>		
	</div>

	
	<br>	
	<div>
		<center>
	 	<form action="form/galeri/delete_foto.php" method="post">
	 		<input type="hidden" name="id" value="<?php echo $id; ?>">
	 		<input type="hidden" name="foto" value="<?php echo $foto; ?>">
	 	<input type="submit" value="Hapus Foto" class="btn btn-danger btn-xs" onclick="return confirm('Hapus foto.??')">

	 	</form>
		
		</center><br>
	</div></div>
	
</div>
		<?php } ?>
				
	
	 			

		
<div class="modal fade" id="addfoto" role="dialog">
    <form method="post" action="form/galeri/save_galeri.php" enctype="multipart/form-data"> 
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
          <?php    	$result = mysqli_query($conn,"select * from kegiatan where id_kegiatan ='$id' ") or die("query salah");
	$ff = mysqli_fetch_array($result);
	{
		$kegiatan=$ff['namakegiatan'];

	}?>
              <center> <label><h2>Tambah  Foto Kegiatan <?php echo $kegiatan; ?></h2></label></center>
              </div>
              <div class="modal-body">
                
             
                <input type="hidden" name="id" value="<?php echo $id_ambil; ?>">
                <label>Foto</label>
               
                <input type="file" name="gambar[]"  multiple>
                

              </div>
              <div class="modal-footer">
                <input type="submit" value="Tambahkan Album" name="kirim" class="btn btn-info">
                <a data-dismiss="modal" href="" class="btn btn-dark">Tutup</a>
              </div>
            </div>
          </div>
      </form>
    </div>