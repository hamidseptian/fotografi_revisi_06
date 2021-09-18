<?php
session_start();
include "../../../../assets/koneksi.php";

$idpel=$_GET['idpel'];

$idt = $_GET['idt'];

$q2 = mysqli_query($conn, "UPDATE pembayaran set
	status='Reject Transfer'
	where id_tagihan='$idt' and id_pelanggan='$idpel'");

?>
<script type="text/javascript">
		alert('Pembayaran transfer direject');
	window.location.href='../../?a=booking_online'
	</script>