<?php 
$id = $_SESSION['iduser'];
$q = mysqli_query($conn, "SELECT * from tagihan as a
	where a.id_pelanggan='$id'
	");
$j = mysqli_num_rows($q);
?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Riwayat Pemesanan</h3>
</div>


<!-- <div class="col-md-2">
</div> -->
<?php if ($j==0) {
	echo '
<div class="col-md-12">
	<div class="alert alert-info">Tidak ada riwayat pemesanan</div>
	</div>';	
}else{ ?>

<div class="col-md-12">
	<!-- <h4>Biaya Cetak</h4> -->
	<table class="table table-bordered table-striped">
		<tr style="background: aqua">
			<td>No</td>
			<td>Keterangan</td>
			<td>Waktu Pesan</td>
			<td>Total Biaya</td>
			<td>Action</td>
		</tr>
<?php 
$no = 1;
$nol=0;
while ($d = mysqli_fetch_array($q)) { 
	$id_tagihan =$d['id_tagihan'];
	$waktu =$d['waktu_create'];

	$cek_pembayaran = mysqli_query($conn, "SELECT sum(jumlah_pembayaran) as dibayar from pembayaran where id_tagihan='$id_tagihan' and status not in ('Reject')");
	$d_pembayaran = mysqli_fetch_array($cek_pembayaran);
	$dibayar = $d_pembayaran['dibayar'] == '' ? 0 : $d_pembayaran['dibayar'];
	if ($dibayar==0) {
		$berakhir_pembayaran            = $d['berakhir_pembayaran'];
		$habis_masa_bayar = strtotime($berakhir_pembayaran);
		$waktu_saat_ini = strtotime(date('Y-m-d'));
		if ($habis_masa_bayar < $waktu_saat_ini) {
			$q_batal_cetak = mysqli_query($conn, "UPDATE cetak_foto set status='Dibatalkan' where id_tagihan='$id_tagihan'");
			$q_batal_booking = mysqli_query($conn, "UPDATE booking set status='Dibatalkan' where id_tagihan='$id_tagihan'");
			$status = 'Dibatalkan';
		}else{
			$status = '';

		}
	}

	?>
		<tr>
			<td><?php echo $no++ ?></td>
			
			<td><?php echo $d['nama_tagihan'] ?></td>
			<td><?php echo $d['waktu_create'] ?></td>
			<td><?php echo number_format($d['jumlah_tagihan']) ?></td>
			
			<td><a href="?m=detail_history&waktu=<?php echo $d['waktu_create'] ?>&metode_pembayaran=<?php echo $d['metode_pembayaran'] ?>&id_tagihan=<?php echo $d['id_tagihan'] ?>">Lihat Detail</a></td>
		</tr>
	

	<?php } ?>
	
	</table>

	<br>
	
</div>





 <div class="clearfix"></div>
<?php } ?>