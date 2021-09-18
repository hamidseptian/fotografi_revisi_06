<div class="box-header">
	<h3 class="box-title">Pesanan</h3>
	<a href="?a=new_order_cetak" class="pull-right btn btn-info">Pesan Baru</a>
</div>
<div class="box-body">
	<table class="table" id="tabelscrol" width="100%">
		<thead style="background: grey; color: white">
			<tr>
				<td>No</td>
			<td>Keterangan</td>
			<td>Waktu Pesan</td>
			<td>Total Biaya</td>
			<td>Action</td>
			</tr>
		</thead>
	<?php 
	$q = mysqli_query($conn, "
		SELECT a.*, b.*, c.id_pelanggan, c.waktu_pesan, c.order_via, c.status as status_pengambilan from tagihan as a 
		left join pelanggan as b on a.id_pelanggan=b.id_pelanggan
		left join cetak_foto as c on a.id_tagihan=c.id_tagihan
		where a.nama_tagihan in ('Order Jasa Cetak Foto','Order Paket dan Cetak Foto')
		and c.status in ('Selesai','Diterima Pelanggan')
		group by a.id_pelanggan, a.waktu_create
		");
	$no = 1;
		while ($d=mysqli_fetch_array($q)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $d['nama_pelanggan'] ?></td>
			<td><?php echo $d['waktu_pesan'] ?></td>
			<td><?php echo number_format($d['jumlah_tagihan']) ?></td>
			<td>
				<a href="?a=detail_pengambilan&idp=<?php echo $d['id_pelanggan'] ?>&waktu=<?php echo $d['waktu_pesan'] ?>&via=<?php echo $d['order_via'] ?>&id_tagihan=<?php echo $d['id_tagihan'] ?>&status_pengambilan=<?php echo $d['status_pengambilan'] ?>" class="btn btn-info btn-xs">Detail</a>
			</td>
		</tr>
	<?php }
	 ?>
	</table>
</div>