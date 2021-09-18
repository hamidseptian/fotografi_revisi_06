<?php 
$id = $_SESSION['iduser'];
$waktu = $_GET['waktu'];
$idtagihan = $_GET['id_tagihan'];
@$status_order = $_GET['status'];
$metode_pembayaran = $_GET['metode_pembayaran'];
$q = mysqli_query($conn, "SELECT * from cetak_foto as a
left join harga_cetak as b on a.id_hc=b.id_hc
left join harga_edit as c on a.id_he = c.id_he 
	where a.status!='Masuk Ke Keranjang' and a.id_pelanggan='$id' and a.waktu_pesan='$waktu'");
$j = mysqli_num_rows($q);

$q_book = mysqli_query($conn, "SELECT * from booking as a
left join paket as b on a.id_paket=b.id_paket
	where a.status!='Masuk Ke Keranjang' and a.id_pelanggan='$id' and a.tanggal_booking='$waktu'");
$j_book = mysqli_num_rows($q_book);
?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Detail Order</h3>
</div>


<!-- <div class="col-md-2">
</div> -->
<?php if ($j==0 &&$j_book==0) {
	echo '
<div class="col-md-12">
	<div class="alert alert-info">Tidak ada data order</div>
	</div>';	
}else{ ?>


<div class="col-md-8">
	<div style="overflow-x: scroll	">
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
			<td>Status</td>
			
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
			<td><?php echo $d['status'] ?></td>
			
		</tr>
	

	<?php }



while ($d_book = mysqli_fetch_array($q_book)) { 
	?>
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
	if ($d_book['status']!='Dibatalkan Sistem') {
			$totalbiaya = $nol+=$total;
	}else{
			$totalbiaya = $nol;

	}
echo number_format($total);
			?></td>
			<td></td>
			<td><?php echo $d_book['status'] ?></td>
		</tr>
	

	<?php } ?>
<tr>
	<td colspan="5">Total</td>
	<td colspan="3"><?php echo number_format($totalbiaya) ?></td>
</tr>
	</table>
</div>

	<br>
	
	
</div>

<div class="col-md-4">
	<h4>Total Biaya : <?php echo $totalbiaya ?></h4>
	<h5>Metode Pembayaran : <?php echo $metode_pembayaran ?></h5>
	<?php if ($status_order=='Dibatalkan') {
		echo "Pesanan anda sudah terbatalkan otomatis oleh sistem karena anda melewati batas pembayaran
		</div>";
	}else{ ?>
	<?php if ($metode_pembayaran=='Transfer') { ?>
	Silahkan lakukan pembayaran ke
	<br><br>
	<?php 
	$rek = array();
	$qr = mysqli_query($conn, "SELECT * from rekening");
	while ($dr = mysqli_fetch_array($qr)) {
	 	echo $dr['namabank'].'<br>No Rekening : '.$dr['no_rek'].'<br>Rekening Atas Nama : '.$dr['namarekening'].'<hr>';
	 $data['id']=$dr['id_rekening'];
	 $data['nama']=$dr['namabank'];
	 array_push($rek, $data);
	 } 
	 echo "<br>Atau pembayaran langsung di kantor  kami<br>Jl. Ir. H. Juanda No.15, Rimbo Kaluang, Kec. Padang Bar., Kota Padang, Sumatera Barat 25515";
	 $qt = mysqli_query($conn , "SELECT * from tagihan where id_tagihan='$idtagihan'");
	 $dt = mysqli_fetch_array($qt);

	 echo $idtagihan;
	 $qp = mysqli_query($conn , "SELECT * from pembayaran where id_tagihan='$idtagihan' and status='Acc'");
	 $jp = mysqli_num_rows($qp);
	 if ($jp>0) {
	 	
	 
	 $tbp = '
	 <table class="table">
		<tr>
			<td>Waktu</td>
			<td>Pembayaran Via</td>
			<td>Jumlah</td>
		</tr>';
		$nol2=0;
		while($dp=mysqli_fetch_array($qp)){
			$tbp.='
			<tr>
				<td>'.$dp['waktu_bayar'].'</td>
				<td>'.$dp['bayar_via'].'</td>
				<td>'.$dp['jumlah_pembayaran'].'</td>
			</tr>';
			$totbayartagihan = $nol2+=$dp['jumlah_pembayaran'];

		}
		$tbp.='
			<tr>
				<td colspan="2">Sudah Dibayar</td>
				<td>'.$totbayartagihan.'</td>
			</tr>';
		$tbp .= '</table>';
		}else{
		$tbp = '';
		$totbayartagihan = 0;

		}

		$sisa = $totalbiaya - $totbayartagihan;

	 // $qtp = mysqli_query($conn , "SELECT sum() as totbayar from pembayaran where id_tagihan='$idtagihan' and status='Admin Approve'");


	 ?>
	 <div style="overflow-x: scroll;">
	 	
	 <?php echo $tbp ?>
	 </div>
	 <br>
	 <?php 
	
	 if ($totbayartagihan<$totalbiaya) {
	 	$qtf = mysqli_query($conn, "SELECT * from pembayaran where id_tagihan='$idtagihan' and status!='Acc' order by id_pembayaran desc limit 1");
	 	$jtf= mysqli_num_rows($qtf);
	 	$dtf = mysqli_fetch_array($qtf);
	 
	 	if ($jtf>0) {
	 		if ($dtf['status']=='Reject Transfer') {
		 		echo '<div class="alert alert-info">Transfer anda di reject Admin</div>';
		 		echo '<br><a href="#" class="btn btn-info" id="showformbayar">Lakukan Pembayaran</a>';
	 			
	 		}else{

		 		echo '<div class="alert alert-info">Pembayaran anda sedang di cek oleh admin kami</div>';
	 		}
	 		
	 	}else{
	 		if ($dtf['status']=='Reject Transfer') {
	 		echo '<div class="alert alert-info">Transfer anda di reject Admin</div>';
	 			
	 		}
	 echo '<br><a href="#" class="btn btn-info" id="showformbayar">Lakukan Pembayaran</a>';
	 	}

	 }

	 if ($totbayartagihan>0) { ?>
	 <a href="form/pesanan/print_tanda_terima.php?waktu=<?php echo $waktu ?>&id_tagihan=<?php echo $idtagihan ?>" target="_blank" class="btn btn-info">Print Tanda Terima</a>
	<?php } ?>
	 <div id="formbayar" style="display:none">
	 <hr>
	 <form  method="post" action="form/pesanan/transfer.php" enctype="multipart/form-data">
	 	<div class="form-group">
	 		<label>Transfer Ke</label>
	 		<select name="rek" class="form-control">
	 			<?php foreach ($rek as $dr) { ?>
	 				<option value="<?php echo $dr['id'] ?>"><?php echo $dr['nama'] ?></option>
	 			<?php }
 ?>
	 		</select>
	 	</div>
	 	<div class="form-group">
	 		<label>Jumlah Pembayaran</label>
	 		<input type="hidden" name="idt" class="form-control" value="<?php echo $idtagihan ?>">
	 		<input type="hidden" name="status_order" class="form-control" value="<?php echo $status_order ?>">
	 		<input type="hidden" name="tb" class="form-control" value="<?php echo $sisa ?>">
	 		<input type="number" name="jp" class="form-control" value="<?php echo $sisa ?>">
	 	</div>
	 	<div class="form-group" style="display:none">
	 		<label>Keterangan</label>
	 		<input type="text" name="ket" class="form-control">
	 	</div>
	 	<div class="form-group">
	 		<label>Bukti Pebayaran</label>
	 		<input type="file" name="file">
	 	</div>
	 	<div class="form-group">
	 		<button class="btn btn-info">Simpan</button>
	 	</div>
	 </form>
	 </div>


<?php } //if ($metode_pembayaran=='Transfer') 
else{
	$q_pembayaran = mysqli_query($conn, "SELECT sum(jumlah_pembayaran) as dibayar from pembayaran where id_tagihan='$idtagihan' and status='Acc'");
	$d_pembayaran = mysqli_fetch_array($q_pembayaran);
	echo "Silahkan melakukan pembayaran langsung ke kantor kami di <br>
    Jl. Ir. H. Juanda No.15, Rimbo Kaluang, Kec. Padang Bar., Kota Padang, Sumatera Barat 25515";
	} 
	if ($d_pembayaran['dibayar']>0) { ?>
		<a href="form/pesanan/print_tanda_terima.php?waktu=<?php echo $waktu ?>&id_tagihan=<?php echo $idtagihan ?>" target="_blank" class="btn btn-info">Print Tanda Terima</a>	
	<?php }
} // else dari if($status_order=='dibatalkan')  ?>
	 
</div>

	


 <div class="clearfix"></div>
<?php } ?>





<script type="text/javascript">
	$('#showformbayar').click(function(){
		$('#formbayar').show();
		$('#showformbayar').hide();
	})
</script>