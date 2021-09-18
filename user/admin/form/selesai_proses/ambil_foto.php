<?php
session_start();
include "../../../../assets/koneksi.php";

$id = $_GET['idp'];
$waktu = $_GET['waktu'];
$via = $_GET['via'];
$id_tagihan = $_GET['id_tagihan'];

$id_cetak=$_GET['id_cetak'];
$q = mysqli_query($conn, "UPDATE cetak_foto set status='Diterima Pelanggan' where id_cetak='$id_cetak'");
?>
<script type="text/javascript">
	alert('Foto sudah diterima pelanggan');
		window.location.href='../../?a=detail_pesanan_selesai&idp=<?php echo $id ?>&waktu=<?php echo $waktu ?>&via=<?php echo $via ?>&id_tagihan=<?php echo $id_tagihan ?>&menu=selesai_cetak'
</script>

<?php 
?>