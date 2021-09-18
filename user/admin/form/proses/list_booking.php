<div class="box-header">
	<h3 class="box-title">Pesanan Di Proses</h3>
</div>
<div class="box-body">
	<table class="table" id="tabelscrol" width="100%">
		<thead style="background: grey; color: white">
				
			<td>No</td>
			<td>Pelanggan</td>
			<td>Nama Paket</td>
			<td>Level Paket</td>
			<td>Biaya</td>
			<td>Kegiatan</td>
			<td>Mulai Kegiatan</td>
			<td>Selesai Kegiatan</td>
			<td>Lama Kegiatan</td>
			<td>Status</td>
			<td>Action</td>
		</tr>
		</thead>
	<?php 
	$time = date('Ymdhis');
	$timestamp = date('Y-m-d h:i:s');
	$q = mysqli_query($conn, "
		SELECT * from booking as a 
		left join pelanggan as b on a.id_pelanggan=b.id_pelanggan
		left join paket as c on a.id_paket=c.id_paket
		where a.status='Dalam Proses'
		
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

		$pstm = explode(' ', $d['tanggal_mulai']);
		$pttm=explode('-', $pstm[0]);
		$pwtm=explode(':', $pstm[1]);
		$mulai = $pttm[0].$pttm[1].$pttm[2].$pwtm[0].$pwtm[1].$pwtm[2];

		$psts = explode(' ', $d['tanggal_selesai']);
		$ptts=explode('-', $psts[0]);
		$pwts=explode(':', $psts[1]);

		$selesai = $ptts[0].$ptts[1].$ptts[2].$pwts[0].$pwts[1].$pwts[2];


		if ($mulai>$time && $time<$selesai) {
			$st = "Berlangsung";
			$action = '<a href="form/proses/selesai_booking.php?id='.$d['id_booking'].'" class="btn btn-info btn-xs" onclick="return confirm(`Apakah acara '.$d['kegiatan'].' sudah selesai.?`)">Selesai Acara</a>';
		}else{
			$st = "Menunggu Jadwal Pelaksanaan";
		}


			$qu = mysqli_query($conn, "UPDATE booking set status='Selesai' where tanggal_selesai<current_time");
		
			?>	
		
		<tr>
			<td><?php echo $no++ ?></td>
			
			<td><?php echo $d['nama_pelanggan'] ?></td>
			<td><?php echo $d['nama_paket'] ?></td>
			<td><?php echo $d['level_paket'] ?></td>
			<td><?php echo $d['biaya'] ?></td>
			<td><?php echo $d['kegiatan'] ?></td>
			<td><?php echo $d['tanggal_mulai'] ?></td>
			<td><?php echo $d['tanggal_selesai'] ?></td>
			<td><?php echo $d['lama_acara'] ?></td>
			<td><?php echo $st ?></td>
			<td><?php echo $action ?></td>
			
			
			
		</tr>
	<?php }
	 ?>
	</table>
</div>