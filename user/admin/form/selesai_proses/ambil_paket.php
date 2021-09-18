<?php
session_start();
include "../../../../assets/koneksi.php";
$id = $_GET['idp'];
$waktu = $_GET['waktu'];
$via = $_GET['via'];
$id_tagihan = $_GET['id_tagihan'];
$id_booking=$_GET['id_booking'];
$q = mysqli_query($conn, "UPDATE booking set status='Diterima Pelanggan' where id_booking='$id_booking'");
?>
<script type="text/javascript">
	alert('Pengambilan berkas paket sudah diterima pelanggan');
		window.location.href='../../?a=detail_pesanan_selesai&idp=<?php echo $id ?>&waktu=<?php echo $waktu ?>&via=<?php echo $via ?>&id_tagihan=<?php echo $id_tagihan ?>&menu=selesai_cetak'
</script>

<?php 
?>