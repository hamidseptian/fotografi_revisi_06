<?php
session_start();
include "../../../../assets/koneksi.php";

$waktu=$_GET['waktu'];

$iduser = $_GET['idpel'];

$q2 = mysqli_query($conn, "UPDATE cetak_foto set
	status='Diterima Pelanggan'
	where waktu_pesan='$waktu' and id_pelanggan='$iduser'");

?>
<script type="text/javascript">
		alert('Foto sudah diterima pelanggan');
	window.location.href='../../?a=selesai_cetak'
	</script>