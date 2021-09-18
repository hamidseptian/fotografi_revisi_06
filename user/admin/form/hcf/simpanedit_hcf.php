<?php 
include "../../../../assets/koneksi.php";
$id=$_POST['id'];
$nama=$_POST['nama'];
$ket=$_POST['ket'];
$htf=$_POST['htf'];
$hdf=$_POST['hdf'];


	$q1=mysqli_query($conn, "UPDATE harga_cetak set 
		ukuran='$nama',
		keterangan='$ket',
		tanpa_frame='$htf',
		dengan_frame='$hdf'
		where id_hc='$id';
		
		")or die(mysqli_error()); 

	
?>

	<script type="text/javascript">
		alert('Data harga cetak berhasil diperbaharui');
		window.location.href="../../?a=hcf"

	</script>
