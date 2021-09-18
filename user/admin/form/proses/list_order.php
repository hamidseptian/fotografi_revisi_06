<div class="box-header">
	<h3 class="box-title">Pesanan Di Proses</h3>
</div>
<div class="box-body">
	<table class="table" id="tabelscrol" width="100%">
		<thead style="background: grey; color: white">
			<tr>
				<td>No</td>
				<td>Pelanggan</td>
				<td>Waktu Pesan</td>
				<td>Dalam Proses</td>
				<td>Selesai</td>
				<td>Action</td>
			</tr>
		</thead>
	<?php 
	$q = mysqli_query($conn, "
		SELECT * from cetak_foto as a 
		left join pelanggan as b on a.id_pelanggan=b.id_pelanggan
		where a.status='Dalam Proses'
		group by a.id_pelanggan, a.waktu_pesan
		");
	$no = 1;
		while ($d=mysqli_fetch_array($q)) { 
			$idp = $d['id_pelanggan'];
			$waktu = $d['waktu_pesan'];
		$qp = mysqli_query($conn, "
		SELECT * from cetak_foto as a 
		where a.status='Dalam Proses' and a.id_pelanggan='$idp' and waktu_pesan='$waktu'		
		");
		$qs = mysqli_query($conn, "
		SELECT * from cetak_foto as a 
		where a.status='Selesai' and a.id_pelanggan='$idp' and waktu_pesan='$waktu'		
		");
		$jp=mysqli_num_rows($qp);
		$js=mysqli_num_rows($qs);

			?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $d['nama_pelanggan'] ?></td>
			<td><?php echo $d['waktu_pesan'] ?></td>
			<td><?php echo $jp ?></td>
			<td><?php echo $js ?></td>
			<td>
				<a href="?a=detail_proses&idp=<?php echo $d['id_pelanggan'] ?>&waktu=<?php echo $d['waktu_pesan'] ?>" class="btn btn-info btn-xs">Detail</a>
			</td>
		</tr>
	<?php }
	 ?>
	</table>
</div>