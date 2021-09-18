<?php
session_start();
include "../../../../assets/koneksi.php";

$waktu=$_GET['waktu'];

$iduser = $_GET['idpel'];

$q2 = mysqli_query($conn, "UPDATE booking set
	status='Reject Booking'
	where tanggal_booking='$waktu' and id_pelanggan='$iduser'");

?>
<script type="text/javascript">
		alert('Pesanan direject');
	window.location.href='../../?a=pesan_online'
	</script>