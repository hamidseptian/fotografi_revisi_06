<?php
session_start();
include "../../../../assets/koneksi.php";

$id_booking=$_GET['id_booking'];

$idp = $_GET['idp'];

$q2 = mysqli_query($conn, "UPDATE booking set
	status='Berlangsung'
	where id_booking='$id_booking' ");

?>
<script type="text/javascript">
		alert('Kegiatan foto dilaksanakan');
	window.location.href='../../?a=daftar_booking'
	</script>