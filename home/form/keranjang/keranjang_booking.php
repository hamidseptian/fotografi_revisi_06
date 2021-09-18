<?php 
$id = $_SESSION['iduser'];
$q = mysqli_query($conn, "SELECT * from booking as a
left join paket as b on a.id_paket=b.id_paket
	where a.status='Masuk Ke Keranjang' and a.id_pelanggan='$id'");
$j = mysqli_num_rows($q);
?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Keranjang Booking</h3>
</div>


<!-- <div class="col-md-2">
</div> -->
<?php if ($j==0) {
	echo '
<div class="col-md-12">
	<div class="alert alert-info">Keranjang Kosong</div>
	</div>';	
}else{ ?>

<div class="col-md-12">
	<!-- <h4>Biaya Cetak</h4> -->
	<table class="table table-bordered table-striped">
		<tr style="background: aqua">
			<td>No</td>
			<td>Paket</td>
			<td>Kegiatan</td>
			<td>Tanggal Mulai Kegiatan</td>
			<td>Biaya Paket</td>
			<td>Lama Pakai</td>
			<td>Total</td>
			<td>Action</td>
		</tr>
<?php 
$no = 1;
$nol=0;
while ($d = mysqli_fetch_array($q)) { ?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $d['nama_paket'] ?></td>
			<td><?php echo $d['kegiatan'] ?></td>
			<td><?php echo $d['tanggal_mulai'] ?></td>
			<td><?php echo $d['biaya'] ?></td>
			<td><?php echo $d['lama_acara'] ?></td>
			<td><?php 
	$total = $d['biaya'] * $d['lama_acara'];
$totalbiaya = $nol+=$total;
echo $total;
			?></td>

			<td><a href="form/keranjang/hapus_booking.php?id=<?php echo $d['id_booking'] ?>" onclick="return confirm('Hapus Foto..??')">Hapus</a></td>
		</tr>
	

	<?php } ?>
	
	</table>

	<br>
	<h4>Total Biaya : <?php echo $totalbiaya ?></h4>
	<a href="form/keranjang/konfirmasi_booking.php?b=<?php echo $totalbiaya ?>" class="btn btn-info">Konfirmasi Pesanan</a>
</div>





 <div class="clearfix"></div>
<?php } ?>