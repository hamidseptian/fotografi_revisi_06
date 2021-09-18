<div class="box-header">
	<h3 class="box-title">Booking Selesai</h3>
	<!-- <a href="?a=new_order_cetak" class="pull-right btn btn-info">Pesan Baru</a> -->
</div>
<div class="box-body">
	<table class="table" id="tabelscrol" width="100%">
		<thead style="background: grey; color: white">
			<tr>
				<td>No</td>
				<td>Pelanggan</td>
				<td>Waktu Booking</td>
				<td>Status Selesai</td>
				<td>Action</td>
			</tr>
		</thead>
	<?php 
	$q = mysqli_query($conn, "
		SELECT * from booking as a
left join paket as b on a.id_paket=b.id_paket
left join pelanggan as c on a.id_pelanggan=c.id_pelanggan
left join tagihan as d on a.id_tagihan=d.id_tagihan
		where a.status in ('Selesai','Diterima Pelanggan')
		group by a.id_pelanggan, a.tanggal_booking
		");
	$no = 1;
		while ($d=mysqli_fetch_array($q)) { 
				$idp = $d['id_pelanggan'];
			$waktu = $d['tanggal_booking'];
		$qp = mysqli_query($conn, "
		SELECT * from booking as a 
		where a.status='Dalam Proses' and a.id_pelanggan='$idp' and tanggal_booking='$waktu'		
		");
		$qs = mysqli_query($conn, "
		SELECT * from booking as a 
		where a.status in('Selesai','Diterima Pelanggan') and a.id_pelanggan='$idp' and tanggal_booking='$waktu'		
		");
		$qst = mysqli_query($conn, "
		SELECT * from booking as a 
		where a.id_pelanggan='$idp' and tanggal_booking='$waktu'		
		");
		$jst=mysqli_num_rows($qst);
		$jp=mysqli_num_rows($qp);
		$js=mysqli_num_rows($qs);
		$persenselesai = 100/$jst;


		$fotook = $js * $persenselesai;



		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $d['nama_pelanggan'] ?></td>
			<td><?php echo $d['tanggal_booking'] ?></td>
			<td><?php echo $fotook ?> % </td>
			<td>
				<?php if ($jp==0) { ?>
				<a href="?a=detail_booking_selesai&idp=<?php echo $d['id_pelanggan'] ?>&waktu=<?php echo $d['tanggal_booking'] ?>&status=<?php echo $d['status'] ?>" class="btn btn-info btn-xs">Detail</a>
					
				<?php }else{ ?>
			<?php } ?>
			</td>
		</tr>
	<?php }
	 ?>
	</table>
</div>
