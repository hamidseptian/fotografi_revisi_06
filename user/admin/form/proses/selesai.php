<?php 
include "../../../../assets/koneksi.php";
// $id = $_GET['id'];
$idp = $_GET['idp'];
$waktu = $_GET['waktu'];

$q = mysqli_query($conn, "UPDATE cetak_foto set status='Selesai' where id_pelanggan='$idp' and waktu_pesan='$waktu' and status='Dalam Proses'");

?>
<script type="text/javascript">
	alert('Foto selesai diproses');
	window.location.href='../../?a=detail_proses&idp=<?php echo $idp ?>&waktu=<?php echo $waktu ?>'
</script>