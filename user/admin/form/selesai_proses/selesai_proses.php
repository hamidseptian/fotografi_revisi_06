<div class="box-header">
	<h3 class="box-title">Pesanan yang sudah selesai</h3>
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
		SELECT a.*, b.*, c.waktu_pesan, c.order_via from tagihan as a 
		left join pelanggan as b on a.id_pelanggan=b.id_pelanggan
		left join cetak_foto as c on a.id_tagihan=c.id_tagihan
		left join booking as d on a.id_tagihan = d.id_tagihan
		where c.status in ('Selesai','Diterima Pelanggan') or d.status in ('Selesai','Diterima Pelanggan')
		group by a.id_pelanggan, a.waktu_create
		");
	$no = 1;
		while ($d=mysqli_fetch_array($q)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $d['nama_pelanggan'] ?></td>
			<td><?php echo $d['nama_tagihan'] ?></td>
			<td><?php echo $d['waktu_create'] ?></td>
			<td><?php echo number_format($d['jumlah_tagihan']) ?></td>
			<td>
				<a href="?a=detail_pesanan_selesai&idp=<?php echo $d['id_pelanggan'] ?>&waktu=<?php echo $d['waktu_create'] ?>&via=<?php echo $d['order_via'] ?>&id_tagihan=<?php echo $d['id_tagihan'] ?>&menu=selesai_cetak" class="btn btn-info btn-xs">Detail</a>
			</td>
		</tr>
	<?php }
	 ?>
	</table>
</div>