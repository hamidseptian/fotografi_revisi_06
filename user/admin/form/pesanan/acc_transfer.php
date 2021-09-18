<?php
session_start();
include "../../../../assets/koneksi.php";

$idpel=$_GET['idpel'];

$waktu = $_GET['waktu'];
$via = $_GET['via'];
$idt = $_GET['idt'];
$id_pembayaran = $_GET['id_pembayaran'];

$q2 = mysqli_query($conn, "UPDATE pembayaran set
	status='Acc'
	where id_pembayaran='$id_pembayaran' ");




$cek_booking_plg = mysqli_query($conn, "SELECT * from booking where id_pelanggan='$idpel' and tanggal_booking='$waktu'")or die(mysqli_error());
$d_cek_booking = mysqli_fetch_array($cek_booking_plg);
echo $mulai =  $d_cek_booking['tanggal_mulai'];
echo "<br>";
echo $selesai =  $d_cek_booking['tanggal_selesai'];
$cek_booking_proses = mysqli_query($conn, "UPDATE booking set status='Dibatalkan Sistem' where tanggal_mulai>='$mulai' and tanggal_selesai <='$selesai' and status='Order' and tanggal_booking!='$waktu'")or die(mysqli_error());


$q2 = mysqli_query($conn, "UPDATE cetak_foto set
	status='Dalam Proses'
	where waktu_pesan='$waktu' and id_pelanggan='$idpel'")or die(mysqli_error());

$q2 = mysqli_query($conn, "UPDATE booking set
	status='Dalam Proses'
	where tanggal_booking='$waktu' and id_pelanggan='$idpel' and status !='Dibatalkan Sistem'")or die(mysqli_error());





?>
<script type="text/javascript">
		alert('Pembayaran transfer di Acc');
	window.location.href='../../?a=detail_pesanan&idp=<?php echo $idpel ?>&waktu=<?php echo $waktu ?>&via=<?php echo $via ?>&id_tagihan=<?php echo $idt ?>'
	</script>