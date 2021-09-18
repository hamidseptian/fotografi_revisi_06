 <?php 
 
 include "../../../assets/koneksi.php";

 	$rek = array();
	$qr = mysqli_query($conn, "SELECT * from rekening");
	while ($dr = mysqli_fetch_array($qr)) {
	 	// echo $dr['namabank'].'<br>No Rekening : '.$dr['no_rek'].'<br>Rekening Atas Nama : '.$dr['namarekening'].'<hr>';
	 $data['id']=$dr['id_rekening'];
	 $data['nama']=$dr['namabank'];
	 array_push($rek, $data);
	 } 
	  ?>

	  <form  method="post" action="form/pesanan/transfer.php" enctype="multipart/form-data">
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