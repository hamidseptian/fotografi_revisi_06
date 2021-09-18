<?php 
$id = $_SESSION['iduser'];
$waktu = $_GET['waktu'];
$q = mysqli_query($conn, "SELECT * from booking as a
left join paket as b on a.id_paket=b.id_paket
left join tagihan as d on a.id_tagihan=d.id_tagihan
	where a.status!='Masuk Ke Keranjang' and a.id_pelanggan='$id' and a.tanggal_booking='$waktu'");
$j = mysqli_num_rows($q);

?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Detail Booking</h3>
</div>


<div class="col-md-8">
	<div style="overflow-x: scroll	">
	<!-- <h4>Biaya Cetak</h4> -->
	<table class="table table-bordered table-striped">
		<tr style="background: aqua">
			<td>No</td>
			<td>Nama Paket</td>
			<td>Level Paket</td>
			<td>Biaya</td>
			<td>Kegiatan</td>
			<td>Mulai Kegiatan</td>
			<td>Lama Kegiatan</td>
			<td>Total</td>
		</tr>
<?php 
$no = 1;
$nol=0;
$idtagihan; 
while ($d = mysqli_fetch_array($q)) { 
	$idtagihan= $d['id_tagihan'];
	$total = $d['biaya'] * $d['lama_acara'];
	$totalbiaya = $nol +=$total;
	?>
		<tr>
			<td><?php echo $no++ ?></td>
			
			<td><?php echo $d['nama_paket'] ?></td>
			<td><?php echo $d['level_paket'] ?></td>
			<td><?php echo $d['biaya'] ?></td>
			<td><?php echo $d['kegiatan'] ?></td>
			<td><?php echo $d['tanggal_mulai'] ?></td>
			<td><?php echo $d['lama_acara'] ?></td>
			
			<td><?php echo number_format($total) ?></td>
			
			
			
		</tr>

	<?php } ?>
<tr>
	<td colspan="7">Total</td>
	<td colspan="2"><?php echo number_format($totalbiaya) ?></td>
</tr>
	</table>
</div>

	<br>
	
	
</div>

<div class="col-md-4">
	<h4>Total Biaya : <?php echo $totalbiaya ?></h4>
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
	 	echo "Total Biaya : $totalbiaya";
	 	echo "<br>";
	 	echo "Sudah Dibayar : $totbayartagihan";
	 	echo "<br>";
	 	echo "Sisa: $sisa";
	 	echo "<br>";
	 if ($totbayartagihan<$totalbiaya) {
	 	$qtf = mysqli_query($conn, "SELECT * from pembayaran where id_tagihan='$idtagihan' and status!='Pengecekan' order by id_pembayaran desc limit 1");
	 	$jtf= mysqli_num_rows($qtf);
	 	$dtf = mysqli_fetch_array($qtf);
	 
	 	if ($jtf>0) {
	 		echo '<div class="alert alert-info">Pembayaran anda sedang di cek oleh admin kami</div>';
	 		
	 	}else{
	 		if ($dtf['status']=='Reject Transfer') {
	 		echo '<div class="alert alert-info">Transfer anda di reject Admin</div>';
	 			
	 		}
	 echo '<br><a href="#" class="btn btn-info" id="showformbayar">Lakukan Pembayaran</a>';
	 	}

	 } ?>

	 <div id="formbayar" style="display:none">
	 <hr>
	 <form  method="post" action="form/pesanan/transfer_booking.php" enctype="multipart/form-data">
	 	<div class="form-group">
	 		<label>Transfer Ke</label>
	 		<select name="rek" class="form-control">
	 			<?php foreach ($rek as $dr) { ?>
	 				<option value="<?php echo $dr['id'] ?>"><?php echo $dr['nama'] ?></option>
	 			<?php }

	 			var_dump($rek) ?>
	 		</select>
	 	</div>
	 	<div class="form-group">
	 		<label>Jumlah Pembayaran</label>
	 		<input type="hidden" name="idt" class="form-control" value="<?php echo $idtagihan ?>">
	 		<input type="hidden" name="tb" class="form-control" value="<?php echo $sisa ?>">
	 		<input type="number" name="jp" class="form-control">
	 	</div>
	 	<div class="form-group">
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


	 
</div>

	


 <div class="clearfix"></div>






<script type="text/javascript">
	$('#showformbayar').click(function(){
		$('#formbayar').show();
		$('#showformbayar').hide();
	})
</script>