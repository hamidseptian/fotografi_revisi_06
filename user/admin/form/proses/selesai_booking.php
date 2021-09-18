<?php 
include "../../../../assets/koneksi.php";
$id = $_GET['id'];
$idp = $_GET['idp'];
$waktu = $_GET['waktu'];

$q = mysqli_query($conn, "UPDATE booking set status='Selesai' where id_booking='$id'");

?>
<script type="text/javascript">
	alert('Acara Selesai');
	window.location.href='../../?a=jadwal_booking';
</script>