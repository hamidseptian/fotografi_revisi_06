<?php 
include "../../../../assets/koneksi.php";

$id = $_POST['id'];
$bank=$_POST['bank'];
$kode=$_POST['kodebank'];
$rekening=$_POST['rekening'];
$nama=$_POST['nama'];


	$q1=mysqli_query($conn, "UPDATE rekening set 
		namabank='$bank',
		kodebank='$kode',
		no_rek='$rekening',
		namarekening='$nama'
		where id_rekening='$id'
		
		
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data rekening berhasil disimpan');
		window.location.href="../../?a=rekening"

	</script>
