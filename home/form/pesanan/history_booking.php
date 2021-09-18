<?php 
$id = $_SESSION['iduser'];
$q = mysqli_query($conn, "SELECT * from booking as a
left join paket as b on a.id_paket=b.id_paket
left join tagihan as d on a.id_tagihan=d.id_tagihan
	where a.status!='Masuk Ke Keranjang' and a.id_pelanggan='$id'
	group by a.tanggal_booking");
$j = mysqli_num_rows($q);
?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Riwayat Pemesanan Paket</h3>
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
			<td>Waktu Pesan</td>
			<td>Jumlah Paket</td>
			<td>Total Biaya</td>
			<td>Status Pesanan</td>
			<td>Action</td>
		</tr>
<?php 
$no = 1;
$nol=0;
while ($d = mysqli_fetch_array($q)) { 
	$waktu =$d['tanggal_booking'];
	$q2 = mysqli_query($conn, "SELECT id_paket from booking where id_pelanggan='$id' and tanggal_booking='$waktu'");
	$j2=mysqli_num_rows($q2);
	$d2 = mysqli_fetch_array($q2);
	$jfoto = $d2['totpaket'];

	?>
		<tr>
			<td><?php echo $no++ ?></td>
			
			<td><?php echo $d['tanggal_booking'] ?></td>
			<td><?php echo $j2 ?></td>
			<td><?php echo number_format($d['jumlah_tagihan']) ?></td>
			<td><?php echo $d['status'] ?></td>
			
			<td><a href="?m=detail_history_booking&waktu=<?php echo $d['tanggal_booking'] ?>">Lihat Detail</a></td>
		</tr>
	

	<?php } ?>
	
	</table>

	<br>
	
</div>





 <div class="clearfix"></div>
<?php } ?>