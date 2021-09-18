<?php 
$id = $_GET['idp'];

$id_booking = $_GET['id_booking'];



$q_book = mysqli_query($conn, "SELECT * from booking as a
left join paket as b on a.id_paket=b.id_paket
	where a.status!='Masuk Ke Keranjang' and a.id_booking='$id_booking'");
$j_book = mysqli_num_rows($q_book);
$d_book = mysqli_fetch_array($q_book);
$status = $d_book['status'];

$qpel = mysqli_query($conn, "SELECT * from pelanggan where id_pelanggan='$id'");
$dpel = mysqli_fetch_array($qpel);

?>
<div class="box-header">
<h3 class="box-title">Detail Pesanan</h3>
<div class="pull-right"> 
	<?php if ($status=='Dalam Proses') { ?>
		<a href="form/pesanan/selesai_acara.php?id_booking=<?php echo $id_booking ?>&idp=<?php echo $id ?>" class="btn btn-info">Selesai Pemotretan</a>
	<?php }else if ($status=='Berlangsung') {  ?>
		<a href="form/pesanan/selesai_acara.php?id_booking=<?php echo $id_booking ?>&idp=<?php echo $id ?>" class="btn btn-info">Selesai Pemotretan</a>
	<?php } ?>
	<a href="?a=daftar_booking" class="btn btn-info">Kembali</a>
</div>
</div>




<div class="col-md-8">
	<div style="overflow-x: scroll	">
	<!-- <h4>Biaya Cetak</h4> -->
	<table class="table table-bordered table-striped">
		<tr style="background: aqua">
			<td>No</td>
			<td>Jenis Order</td>
			<td>Keterangan Order</td>
			<td>Lama Acara</td>
			<td>Biaya</td>
			<td>Total Biaya</td>
			
		</tr>
<?php 
$no = 1;
$nol=0;
$idtagihan; 

?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td>Paket</td>
			<td>
				Paket : <?php echo $d_book['nama_paket'] ?> <br>
				Untuk Acara : <?php echo $d_book['kegiatan'] ?>
				pada tanggal <?php echo $d_book['tanggal_mulai'] ?>
			</td>
			
			<td><?php echo $d_book['lama_acara'] ?> Hari</td>
			<td><?php echo number_format($d_book['biaya']) ?></td>
			<td><?php 
	$total = $d_book['biaya'] * $d_book['lama_acara'];
$totalbiaya = $nol+=$total;
echo number_format($total);
			?></td>
		</tr>
	

<tr>
	<td colspan="5">Total</td>
	<td><?php echo number_format($totalbiaya) ?></td>
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
		<tr>
			<td>Status</td>
			<td><?php echo $status ?></td>
		</tr>
	</table>
	<hr>

	