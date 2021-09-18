<?php 
$id = $_GET['idp'];
$waktu = $_GET['waktu'];
$status = $_GET['status'];
$q = mysqli_query($conn, "SELECT * from cetak_foto as a
left join harga_cetak as b on a.id_hc=b.id_hc
left join harga_edit as c on a.id_he = c.id_he 
left join file as d on a.id_file = d.id_file

	where a.status!='Masuk Ke Keranjang' and a.id_pelanggan='$id' and a.waktu_pesan='$waktu'");
$j = mysqli_num_rows($q);


$qpel = mysqli_query($conn, "SELECT * from pelanggan where id_pelanggan='$id'");
$dpel = mysqli_fetch_array($qpel);
?>
<div class="box-header">
<h3 class="box-title">Detail Order Cetak Foto</h3>
<a href="?a=selesai_cetak" class="pull-right btn btn-info">Kembali</a>
</div>




<div class="col-md-8">
	<div style="overflow-x: scroll	">
	<!-- <h4>Biaya Cetak</h4> -->
	<table class="table table-bordered table-striped">
		<tr style="background: aqua">
			<td>No</td>
			<td>Foto</td>
			<td>Ukuran</td>
			<td>Qty</td>
			<td>Dengan Frame</td>
			<td>Harga Cetak</td>
			<td>Dengan Editan</td>
			<td>Biaya Edit</td>
			<td>Total Biaya</td>
			
			
		</tr>
<?php 
$no = 1;
$nol=0;
$idtagihan; 
while ($d = mysqli_fetch_array($q)) { 
	$idtagihan= $d['id_tagihan'];
	?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td width='30%'>
			<?php if ($d['order_via']=="Offline") {
				echo "Diluar System";
			}else{ ?>
				<img src="../../home/form/galeri/file_foto/<?php echo $d['foto'] ?>" width="100%">
				<?php } ?></td>
			<td><?php echo $d['ukuran'] ?></td>
			<td><?php echo $d['qty'] ?></td>
			<td><?php echo $d['with_frame'] ?></td>
			<td><?php 
			if($d['with_frame']=='Ya'){
			echo $biaya = $d['dengan_frame'];
			}else{
			echo $biaya = $d['tanpa_frame'];

			}
			?></td>
			<td><?php 
			if($d['id_he']==''){
			 $biayaedit = 0;
			 echo "Tidak";
			}else{
			 $biayaedit = $d['harga_edit'];
			 echo $d['nama_edit'];
			}
$total = ($biayaedit + $biaya) * $d['qty'];
$totalbiaya = $nol+=$total;
			?></td>
			<td><?php echo $biayaedit ?></td>
			<td><?php echo $total ?></td>
			
		</tr>
	

	<?php } ?>
<tr>
	<td colspan="8">Total</td>
	<td colspan="2"><?php echo $totalbiaya ?></td>
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

	<?php if ($sisa<=0) {
		if ($status=='Selesai') { ?>
		<a href="form/selesaI_proses/terima_foto.php?idpel=<?php echo $id ?>&waktu=<?php echo $waktu ?>" class="btn btn-default" onclick="return confirm('Apakah foto hasil cetak sudah diberikan ke pelanggan')">Foto Diterima Pelanggan</a>
			
		<?php }
	 	 }else{ ?>
		<div class="alert alert-info">
			Foto bisa diambil apabila pelanggan sudah melunasi pembayaran
		</div>
		 <a href="#" class="btn btn-info" id="showformbayar">Pembayaran Manual</a>


			 <div id="formbayar" style="display:none">
				 <hr>
				 <form  method="post" action="form/selesai_proses/lunas_bayar.php" enctype="multipart/form-data">
				 	
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