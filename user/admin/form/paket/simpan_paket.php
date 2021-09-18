<?php 
include "../../../../assets/koneksi.php";
$tipe=$_POST['tipe'];
$lama=$_POST['lama'];
$level=$_POST['level'];
$biaya=$_POST['biaya'];
$jenis_waktu=$_POST['jenis_waktu'];
$book=$_POST['book'];
$fasilitas=nl2br($_POST['fasilitas']);

//untuk upload file
$ekstensi_diperbolehkan	= array('jpg','png','gif');
$lokasifile=$_FILES['berkas']['tmp_name'];
$file=$_FILES['berkas']['name'];
$x = explode('.', $file);
$ekstensi = strtolower(end($x));
$ukuran=$_FILES['berkas']['size'];
$namafile=date('Ymdhis').$file;
$folder="gambar/".$namafile;

$tgls=date('Y-m-d');
$upload=move_uploaded_file($lokasifile, $folder);
	$q1=mysqli_query($conn, "INSERT into paket set 
		nama_paket='$tipe',
		bisa_booking='$book',
		lama_potret='$lama',
		level_paket='$level',
		fasilitas='$fasilitas',
		biaya='$biaya',
		jenis_waktu='$jenis_waktu',
			gambar='$namafile'
		")or die(mysqli_error()); 
?>

	<script type="text/javascript">
		alert('Data paket disimpan');
		window.location.href="../../?a=paket"

	</script>
