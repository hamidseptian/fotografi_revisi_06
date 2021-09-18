<?php
session_start();
include "../../../assets/koneksi.php";
$tgl=$_GET['tgl'];
$jambook=$_GET['jambook'];
$idj=$_GET['idj'];
$idpel=$_SESSION['iduser'];
$lama=$_GET['lama'];
$tgl_selesai=$_GET['tgl_selesai'];

$jenis=$_GET['jenis'];
$lokasi=$_GET['lokasi'];

$timestamp = date('Y-m-d h:i:s');
$mulai = $tgl.' '.$jambook;

// $selesai = date('Y-m-d', strtotime($lama.' days', strtotime($tgl))); 
$selesai = $tgl_selesai;
$q = mysqli_query($conn, "INSERT into booking
	set id_pelanggan='$idpel', 
	id_paket='$idj',
	jenis_pemotretan='$jenis',
	lokasi='$lokasi',
	tanggal_mulai='$mulai',
	tanggal_selesai='$selesai',
	
	status='Masuk Ke Keranjang'
	")or die(mysqli_error());

?>
<script type="text/javascript">
	alert('Booking anda dimasukkan ke keranjang');
	window.location.href="../../?m=jasa";
</script>
