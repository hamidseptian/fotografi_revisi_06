<?php 
$id = $_GET['idp'];
$waktu = $_GET['waktu'];
$q = mysqli_query($conn, "SELECT * from cetak_foto as a
left join harga_cetak as b on a.id_hc=b.id_hc
left join harga_edit as c on a.id_he = c.id_he 
	where a.status!='Masuk Ke Keranjang' and a.id_pelanggan='$id' and a.waktu_pesan='$waktu'");
$j = mysqli_num_rows($q);


$qpel = mysqli_query($conn, "SELECT * from pelanggan where id_pelanggan='$id'");
$dpel = mysqli_fetch_array($qpel);
?>
<div class="box-header">
<h3 class="box-title">Detail Proses Cetak Foto</h3>
<div class="pull-right">
	
<a href="?a=proses_cetak" class=" btn btn-info">Kembali</a>
<a href="form/proses/selesai.php?idp=<?php echo $dpel['id_pelanggan'] ?>&waktu=<?php echo $waktu ?>" class="btn btn-info" onclick="return confirm('Selesai.?')">Selesai</a>
</div>
</div>


<!-- <div class="col-md-2">
</div> -->
<?php if ($j==0) {
	echo '
<div class="col-md-12">
	<div class="alert alert-info">Keranjang Kosong</div>
	</div>';	
}else{ ?>


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
			<td>Status</td>
			<td>Action</td>
			
			
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
			<td><?php echo $d['status'] ?></td>
			<td>
				<?php if ($d['order_via']!='Offline') { ?>
				<a href="" class="btn btn-default btn-xs">Download File</a>
					
				<?php }
				if ($d['status']=='Dalam Proses') { ?>
				 	
				<!-- <a href="form/proses/selesai.php?id=<?php echo $d['id_cetak'] ?>&idp=<?php echo $dpel['id_pelanggan'] ?>&waktu=<?php echo $d['waktu_pesan'] ?>" class="btn btn-info btn-xs" onclick="return confirm('Selesai.?')">Selesai</a> -->
				 <?php } ?>
			</td>
		</tr>
	

	<?php } ?>

	</table>
</div>

	<br>
	
	
</div>


	


 <div class="clearfix"></div>
<?php } ?>





<script type="text/javascript">
	$('#showformbayar').click(function(){
		$('#formbayar').show();
		$('#showformbayar').hide();
	})
</script>