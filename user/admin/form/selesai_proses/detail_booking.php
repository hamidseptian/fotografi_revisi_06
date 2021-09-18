<?php 
$id = $_GET['idp'];
$waktu = $_GET['waktu'];
$status = $_GET['status'];
$q = mysqli_query($conn, "	SELECT * from booking as a
left join paket as b on a.id_paket=b.id_paket
left join pelanggan as c on a.id_pelanggan=c.id_pelanggan
left join tagihan as d on a.id_tagihan=d.id_tagihan

	where a.status!='Masuk Ke Keranjang' and a.id_pelanggan='$id' and a.tanggal_booking='$waktu'");
$j = mysqli_num_rows($q);


$qpel = mysqli_query($conn, "SELECT * from pelanggan where id_pelanggan='$id'");
$dpel = mysqli_fetch_array($qpel);
?>
<div class="box-header">
<h3 class="box-title">Detail Booking</h3>
<a href="?a=selesai_cetak" class="pull-right btn btn-info">Kembali</a>
</div>




<div class="col-md-8">
	<div style="overflow-x: scroll	">
	<!-- <h4>Biaya Cetak</h4> -->
	<table class="table table-bordered table-striped">
			<tr style="background: aqua">
			<td>No</td>
			<td>Nama Paket</td>
			<td>Level Paket</td>
			<td>Biaya</td>
			<td>Kegiatan</td>
			<td>Mulai Kegiatan</td>
			<td>Lama Kegiatan</td>
			<td>Total</td>
		</tr>
<?php 
$no = 1;
$nol=0;
$idtagihan; 
while ($d = mysqli_fetch_array($q)) { 

	$total = $d['biaya'] * $d['lama_acara'];
	$totalbiaya = $nol +=$total;
	$idtagihan= $d['id_tagihan'];
	?>
		<tr>
			<td><?php echo $no++ ?></td>
			
			<td><?php echo $d['nama_paket'] ?></td>
			<td><?php echo $d['level_paket'] ?></td>
			<td><?php echo $d['biaya'] ?></td>
			<td><?php echo $d['kegiatan'] ?></td>
			<td><?php echo $d['tanggal_mulai'] ?></td>
			<td><?php echo $d['lama_acara'] ?></td>
			
			<td><?php echo number_format($total) ?></td>
			
			
			
		</tr>

	

	<?php } ?>
<tr>
	<td colspan="7">Total</td>
	<td colspan="1"><?php echo number_format($totalbiaya) ?></td>
</tr>
		</table>
</div>

	<br>
	
	
</div>

<div class="col-md-4">
	<h4>Detail Pelanggan</h4>
	<table class="table">
		<tr>
			<td>Nama</td>
			<td><?php echo $dpel['nama_pelanggan'] ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><?php echo $dpel['alamat_pelanggan'] ?></td>
		</tr>
		<tr>
			<td>No HP</td>
			<td><?php echo $dpel['nohp_pelanggan'] ?></td>
		</tr>
	</table>
	<hr>

	<?php 

	 $qt = mysqli_query($conn , "SELECT * from tagihan where id_tagihan='$idtagihan'");
	 $dt = mysqli_fetch_array($qt);

	 
	 $qp = mysqli_query($conn , "SELECT * from pembayaran as a 
	 	left join rekening as b on a.id_rekening = b.id_rekening
	 	where a.id_tagihan='$idtagihan' and a.status='Acc'");
	 $jp = mysqli_num_rows($qp);
	 $nol2=0;
	 while ($dp = mysqli_fetch_array($qp)) {	
	 	$totbayartagihan = $nol2 += $dp['jumlah_pembayaran'];

	 }
	$sisa = $totalbiaya - $totbayartagihan;
	 ?>

	<h4>Detail Ordera</h4>
	<table class="table">
		<tr>
			<td>Total Biaya</td>
			<td><?php echo $totalbiaya?></td>
		</tr>
		<tr>
			<td>Sudah Dibayar</td>
			<td><?php echo $totbayartagihan ?></td>
		</tr>
		<tr>
			<td>Sisa Pembayaran</td>
			<td><?php 
			if ($sisa==0) {
			 	echo "Lunas";
			 }else{
			 	echo $sisa;
			 } ?></td>
		</tr>
	</table>

	<?php if ($sisa==0) {
		if ($status=='Selesai') { ?>
		<a href="form/selesaI_proses/terima_berkas.php?idpel=<?php echo $id ?>&waktu=<?php echo $waktu ?>" class="btn btn-info" onclick="return confirm('Apakah berkas paket sudah diberikan ke pelanggan.??')">Berkas Diterima Pelanggan</a>
			
		<?php }
	 	 }else{ ?>
		<div class="alert alert-info">
			Berkas paket bisa diambil apabila pelanggan sudah melunasi pembayaran
		</div>
		 <a href="#" class="btn btn-info" id="showformbayar">Pembayaran Manual</a>


			 <div id="formbayar" style="display:none">
				 <hr>
				 <form  method="post" action="form/selesai_proses/lunas_bayar_booking.php" enctype="multipart/form-data">
				 	
				 	<div class="form-group">
				 		<label>Jumlah Pembayaran</label>
				 		<input type="hidden" name="idpel" class="form-control" value="<?php echo $id ?>">
				 		<input type="hidden" name="waktu" class="form-control" value="<?php echo $waktu ?>">
				 		<input type="hidden" name="idt" class="form-control" value="<?php echo $idtagihan ?>">
				 		<input type="hidden" name="tb" class="form-control" value="<?php echo $sisa ?>">
				 		<input type="number" name="jp" class="form-control">
				 	</div>
				 	<div class="form-group">
				 		<label>Keterangan</label>
				 		<input type="text" name="ket" class="form-control">
				 	</div>
				 	<div class="form-group">
				 		<button class="btn btn-info">Simpan</button>
				 	</div>
				 </form>
				 </div>
			<script type="text/javascript">
				$('#showformbayar').click(function(){
					$('#formbayar').show();
					$('#showformbayar').hide();
				})
			</script>
	<?php } ?>