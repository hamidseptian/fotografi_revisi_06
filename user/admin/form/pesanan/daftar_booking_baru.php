<div class="box-header">
	<h3 class="box-title">Daftar Booking</h3>
</div>
<div class="box-body">
	<table class="table" id="tabelscrol" width="100%">
		<thead style="background: grey; color: white">
			<tr>
				<td>No</td>
			<td>Order</td>
			<td>Keterangan</td>
			<td>Waktu Pesan</td>
			<td>Total Biaya</td>
			<td>Action</td>
			</tr>
		</thead>
	<?php 
	$q = mysqli_query($conn, "
		SELECT a.*, b.*, a.id_pelanggan, d.tanggal_booking from tagihan as a 
		left join pelanggan as b on a.id_pelanggan=b.id_pelanggan
		left join booking as d on a.id_tagihan = d.id_tagihan
		where a.nama_tagihan in ('Order Paket dan Cetak Foto','Order Paket') and d.status in ('Dalam Proses','Berlangsung','Selesai')
		group by a.id_pelanggan, a.waktu_create
		");
	$no = 1;
		while ($d=mysqli_fetch_array($q)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $d['nama_pelanggan'] ?></td>
			<td><?php echo $d['nama_tagihan'] ?></td>
			<td><?php echo $d['waktu_pesan'] ?></td>
			<td><?php echo number_format($d['jumlah_tagihan']) ?></td>
			<td>
				<a href="?a=detail_pesanan&idp=<?php echo $d['id_pelanggan'] ?>&waktu=<?php echo $d['waktu_pesan'] ?>&via=<?php echo $d['order_via'] ?>&id_tagihan=<?php echo $d['id_tagihan'] ?>" class="btn btn-info btn-xs">Detail</a>
			</td>
		</tr>
	<?php }
	 ?>
	</table>
</div>