<?php
session_start();
include "../../../../assets/koneksi.php";


	$idc = $_POST['idc'];
	$edit = $_POST['edit'];
	@$wf = $_POST['wf'];
	$jml = $_POST['jml'];
	if ($wf=='') {
		$frame="Tidak";
	}else{

		$frame="Ya";
	}

$query = "INSERT INTO cetak_foto set 
	id_he='$edit',
	id_hc = '$idc',
	with_frame='$frame',
	qty='$jml',

	status='Masuk Ke Keranjang'
	";

$q = mysqli_query($conn,$query);





?>
<script>
	alert('Orderan dimasukkan ke keranjang');
	window.location.href='../../?a=new_order_cetak'
</script>