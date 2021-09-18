<?php 
include "../../../../assets/koneksi.php";
$id = $_GET['id'];
$foto = $_GET['file'];

$q = mysqli_query($conn, "DELETE from cetak_foto where id_cetak='$id'");

?>
<script type="text/javascript">
	alert('Foto dihapus');
	window.location.href='../../?a=keranjang'
</script>