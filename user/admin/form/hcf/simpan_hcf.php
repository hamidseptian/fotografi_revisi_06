<?php 
include "../../../../assets/koneksi.php";
$ukuran=$_POST['ukuran'];
$ket=$_POST['ket'];
$htf=$_POST['htf'];
$hdf=$_POST['hdf'];

	$q1=mysqli_query($conn, "INSERT into harga_cetak set 
		ukuran='$ukuran',
		keterangan='$ket',
		tanpa_frame='$htf',
		dengan_frame='$hdf'		
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data harga foto berhasil disimpan');
		window.location.href="../../?a=hcf"

	</script>
