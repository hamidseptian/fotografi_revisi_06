<div class="box-header">
	<h3 class="box-title">Data Booking</h3>
</div>
<div class="box-body">
	<table class="table" id="tabelscrol" width="100%">
		<thead style="background: grey; color: white">
			<tr>
				<td>No</td>
				<td>Pelanggan</td>
				<td>Paket</td>
				<td>Pemotretan</td>
				<td>Waktu Pemotretan</td>
				<td>Status</td>
				<td>Action</td>
			</tr>
		</thead>
	<?php 
	$q = mysqli_query($conn, "
	SELECT * from booking as a
left join paket as b on a.id_paket=b.id_paket
left join pelanggan as c on a.id_pelanggan=c.id_pelanggan
left join tagihan as d on a.id_tagihan=d.id_tagihan and a.id_pelanggan=d.id_pelanggan
		where a.status in ('Berlangsung','Dalam Proses')
	
		");
	$no = 1;
		while ($d=mysqli_fetch_array($q)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $d['nama_pelanggan'] ?></td>
			<td><?php echo $d['nama_paket'] ?></td>
			<td><?php echo $d['jenis_pemotretan'].'<br>'.$d['lokasi'] ?></td>
			<td><?php echo $d['tanggal_mulai'] ?> s/d <?php echo $d['tanggal_selesai'] ?></td>
			<td><?php echo $d['status'] ?></td>
			<td>
				<a href="?a=detail_booking&idp=<?php echo $d['id_pelanggan'] ?>&waktu=<?php echo $d['tanggal_booking'] ?>&via=Online&id_tagihan=1&id_booking=<?php echo $d['id_booking'] ?>" class="btn btn-info btn-xs">Detail</a>
			</td>
		</tr>
	<?php }
	 ?>
	</table>
</div>