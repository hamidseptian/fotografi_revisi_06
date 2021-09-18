
<?php include "../../../../assets/koneksi.php";
$id=$_GET['id'];

	$q1=mysqli_query($conn, "DELETE from paket where id_paket='$id'") or die(mysqli_error()); 

?>

	<script type="text/javascript">
		alert('Data  paket dihapus');
		window.location.href="../../?a=paket"

	</script>