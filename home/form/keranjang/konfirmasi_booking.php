<?php
session_start();
include "../../../assets/koneksi.php";
$qt = mysqli_query($conn, "SELECT max(id_tagihan)as idt from tagihan");
$dt = mysqli_fetch_array($qt);
$idt = $dt['idt']+1;
$biaya=$_GET['b'];
$idpel = $_SESSION['iduser'];
$timestamp = date('Y-m-d h:i:s');
$q = mysqli_query($conn, "UPDATE booking
	set status='Order',
	tanggal_booking='$timestamp',
	id_tagihan='$idt'
 where id_pelanggan='$idpel' and status='Masuk Ke Keranjang'");

$q2 = mysqli_query($conn, "INSERT into tagihan (id_tagihan, id_pelanggan, nama_tagihan, jumlah_tagihan, waktu_create) values('$idt', '$idpel','Order Jasa Paket Foto','$biaya','$timestamp')")
?>
<script type="text/javascript">
	alert('Pesanan Di Konfirmasi');
	window.location.href='../../?m=keranjang_book'
</script>