
<?php include "../../../../assets/koneksi.php";
$id=$_GET['id'];
	$q1=mysqli_query($conn, "DELETE from harga_cetak where id_hc='$id'") or die(mysqli_error()); 

?>

	<script type="text/javascript">
		alert('Data harga cetak dihapus');
		window.location.href="../../?a=hcf"

	</script>