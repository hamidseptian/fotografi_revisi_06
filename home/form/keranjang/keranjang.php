<?php 
$id = $_SESSION['iduser'];
$q = mysqli_query($conn, "SELECT * from cetak_foto as a
left join harga_cetak as b on a.id_hc=b.id_hc
left join harga_edit as c on a.id_he = c.id_he 
	where a.status='Masuk Ke Keranjang' and a.id_pelanggan='$id'");
$j = mysqli_num_rows($q);



$q_book = mysqli_query($conn, "SELECT * from booking as a
left join paket as b on a.id_paket=b.id_paket
	where a.status='Masuk Ke Keranjang' and a.id_pelanggan='$id'");
$j_book = mysqli_num_rows($q_book);

$order = $j + $j_book;

$cetak = $j==0 ? '0' : 1;
$booking = $j_book==0 ? '0' : 1;

if ($cetak==1 && $booking==1) {
	$ket_order = "Order Paket dan Cetak Foto";
}else if ($cetak==0 && $booking==1) {
	$ket_order = "Order Paket";
}else if ($cetak==1 && $booking==0) {
	$ket_order = "Order Cetak Foto";
}

?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Keranjang</h3>
</div>


<!-- <div class="col-md-2">
</div> -->
<?php if ($order==0) {
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
			<td>Jenis Order</td>
			<td>Keterangan Order</td>
			<td>Qty</td>
			<td>Harga</td>
			<td>Total Biaya</td>
			<td>Foto</td>
			<td>Action</td>
		</tr>
<?php 
$no = 1;
$nol=0;
while ($d = mysqli_fetch_array($q)) {
			if($d['with_frame']=='Ya'){
			$biaya = $d['dengan_frame'];
			$ket = "Menggunakan Frame";

			}else{
			$biaya = $d['tanpa_frame'];
			$ket = "Tidak Menggunakan Frame";

			}
			if($d['id_he']==''){
			 $biayaedit = 0;
			 $with_edit =  "";
			 $total_harga = $d['qty'] * $biaya;
			}else{
			 $biayaedit = $d['harga_edit'];
			 $with_edit =  'Dengan edit '.$d['nama_edit'].' <br>[Tambahan biaya '.number_format($biayaedit).']';
			 $total_harga = $d['qty'] * $biaya + $biayaedit;

			}
			$totalbiaya = $nol+=$total_harga;
			?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td>Cetak Foto</td>
			<td><?php echo $d['ukuran'].'<br>'.$ket.'<br>'.$with_edit ?></td>
			<td><?php echo $d['qty'] ?> Item</td>
			<td><?php echo number_format($biaya) ?></td>
			<td><?php echo number_format($total_harga) ?></td>
			
			<td width='30%'><img src="form/galeri/file_foto/<?php echo $d['foto'] ?>" ></td>
			
			<td><a href="form/keranjang/hapus.php?id=<?php echo $d['id_cetak'] ?>&file=<?php echo $d['foto'] ?>" onclick="return confirm('Hapus Foto..??')">Hapus</a></td>
		</tr>
	

	<?php } 
	




while ($d_book = mysqli_fetch_array($q_book)) { ?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td>Paket</td>
			<td>
				Paket : <?php echo $d_book['nama_paket'] ?> <br>
				Pemotretan : <?php echo $d_book['jenis_pemotretan'].'<br>'.$d_book['lokasi'] ?>
				pada tanggal <?php echo $d_book['tanggal_mulai'] ?>
			</td>
			
			<td><?php echo 1 ?>  Kali Pemotretan</td>
			<td><?php echo number_format($d_book['biaya']) ?></td>
			<td><?php 
	$total = $d_book['biaya'] * 1;
$totalbiaya = $nol+=$total;
echo number_format($total);
			?></td>
			<td></td>
			<td><a href="form/keranjang/hapus_booking.php?id=<?php echo $d_book['id_booking'] ?>" onclick="return confirm('Hapus Foto..??')">Hapus</a></td>
		</tr>
	

	<?php } ?>
	</table>

	<br>
	<form action="form/keranjang/konfirmasi.php?b=<?php echo $totalbiaya ?>&ket_order=<?php echo $ket_order ?>" method="post">
		
	<h4>Total Biaya : <?php echo number_format($totalbiaya) ?></h4>
	Metode Pembayaran 
	<select class="form-control" name="metode_bayar">
		<option value="Transfer">Transfer</option>
		<option value="Tunai">Tunai</option>
	</select>
	<br>
	<button class="btn btn-info">Konfirmasi Pesanan</button>
	<p>Tambahkan untuk info pembayaran nanti</p>
	</form>
</div>





 <div class="clearfix"></div>
<?php } ?>