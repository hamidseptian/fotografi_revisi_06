<div class="box-header">
	<h3 class="box-title">Laporan Penjualan Cetak Foto</h3>
	
</div>
<div class="box-body">
	<table class="table" id="tabelscrol" width="100%">
		<thead style="background: grey; color: white">
			<tr>
				<td>No</td>
			<td>Pelanggan</td>
			<td>Ukuran</td>
			<td>Qty</td>
			<td>Dengan Frame</td>
			<td>Harga Cetak</td>
			<td>Dengan Editan</td>
			<td>Biaya Edit</td>
			<td>Total Biaya</td>
			</tr>
		</thead>
		<tbody>
	<?php 
	$q = mysqli_query($conn, "
		SELECT * from cetak_foto as a 
		left join pelanggan as b on a.id_pelanggan=b.id_pelanggan
		left join harga_edit as c on a.id_he = c.id_he 
		left join harga_cetak as d on a.id_hc=d.id_hc
		where a.status='Diterima Pelanggan'
		");
	$no = 1;
	$nol =0;
		while ($d=mysqli_fetch_array($q)) { ?>
		<tr>
			<td><?php echo $no++ ?></td>
			
			<td><?php echo $d['nama_pelanggan'] ?></td>
			<td><?php echo $d['ukuran'] ?></td>
			<td><?php echo $d['qty'] ?></td>
			<td><?php echo $d['with_frame'] ?></td>
			<td><?php 
			if($d['with_frame']=='Ya'){
			echo number_format($biaya = $d['dengan_frame']);
			}else{
			echo number_format($biaya = $d['tanpa_frame']);

			}
			?></td>
			<td><?php 
			if($d['id_he']==''){
			 $biayaedit = 0;
			 echo "Tidak";
			}else{
			 $biayaedit = $d['harga_edit'];
			 echo $d['nama_edit'];
			}
$total = ($biayaedit + $biaya) * $d['qty'];
$totalbiaya = $nol+=$total;
			?></td>
			<td><?php echo number_format($biayaedit) ?></td>
			<td><?php echo number_format($total) ?></td>
				<?php 
			if($d['foto']!=''){
			 $target = 'href="'.$d['foto'].'" target="_blank"';
			 $caption = "Download File";
			}else{
			$target = 'href="#"';
			 $caption = "Tidak ada file";

			}
			?>
		</tr>
	<?php }
	 ?>
	</tbody>
	 <tfoot>
			<tr>
				<td colspan="8" align="right">Total Pendpatan</td>
			
			<td><?php echo number_format($totalbiaya) ?></td>
			</tr>
		</tfoot>
	</table>
	<!-- <div class="alert alert-info">Total Pendapatan : <?php echo number_format($totalbiaya) ?></div> -->
</div>