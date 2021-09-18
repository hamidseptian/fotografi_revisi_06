<?php 
include "../../../assets/koneksi.php";
$id = $_GET['id'];


$q = mysqli_query($conn, "DELETE from booking where id_booking='$id'");

?>
<script type="text/javascript">
	alert('Booking dihapus');
	window.location.href='../../?m=keranjang'
</script>