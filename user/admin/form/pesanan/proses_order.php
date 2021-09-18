<?php
session_start();
include "../../../../assets/koneksi.php";

$waktu=$_GET['waktu'];

$iduser = $_GET['idpel'];
$idt = $_GET['idt'];

$q2 = mysqli_query($conn, "UPDATE cetak_foto set
	status='Dalam Proses'
	where waktu_pesan='$waktu' and id_pelanggan='$iduser'")or die(mysqli_error());

$q2 = mysqli_query($conn, "UPDATE booking set
	status='Dalam Proses'
	where tanggal_booking='$waktu' and id_pelanggan='$iduser'")or die(mysqli_error());

$q3 = mysqli_query($conn, "UPDATE pembayaran set
	status='Acc'
	where id_tagihan='$idt' and id_pelanggan='$iduser'")or die(mysqli_error());

?>
<script type="text/javascript">
		alert('Pesanan Diproses');
	window.location.href='../../?a=pesan_online'
	</script>