<?php
session_start();
include "../../../../assets/koneksi.php";

$waktu=$_GET['waktu'];

$iduser = $_GET['idpel'];

$q2 = mysqli_query($conn, "UPDATE booking set
	status='Diterima Pelanggan'
	where tanggal_booking='$waktu' and id_pelanggan='$iduser'");

?>
<script type="text/javascript">
		alert('Foto sudah diterima pelanggan');
	window.location.href='../../?a=booking_selesai'
	</script>