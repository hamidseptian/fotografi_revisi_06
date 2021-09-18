<?php
include "../../../../assets/koneksi.php";
$idt = $_POST['idfoto'];
$j = count($idt);
if ($j>0) {
	
foreach ($idt as $id) {

	$q1=mysqli_query($conn, "SELECT * from galeri where id_galeri='$id'");
$d1=mysqli_fetch_array($q1);
$file = $d1['foto'];

$sql="DELETE from galeri where id_galeri='$id'";
mysqli_query($conn, $sql);
unlink("gambar/".$file);
}

	echo "<script type='text/javascript'>
			alert('".$j." Foto telah dihapus..!!');
		</script>";
		echo "<meta http-equiv='refresh' content='0; url=../../?a=galeri'>";

}
else{
	echo "<script type='text/javascript'>
			alert('Tidak ada foto yang dihapus..!!');
		</script>";
		echo "<meta http-equiv='refresh' content='0; url=../../?a=galeri'>";	
}
?>

