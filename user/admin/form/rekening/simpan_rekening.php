<?php 
include "../../../../assets/koneksi.php";

session_start();
$id = $_SESSION['id_admin'];
$bank=$_POST['bank'];
$kode=$_POST['kodebank'];
$rekening=$_POST['rekening'];
$nama=$_POST['nama'];


	$q1=mysqli_query($conn, "INSERT into rekening set 
		
		no_rek='$rekening',
		namabank='$bank',
		kodebank='$kode',
		namarekening='$nama'
		
		
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data rekening berhasil disimpan');
		window.location.href="../../?a=rekening"

	</script>
