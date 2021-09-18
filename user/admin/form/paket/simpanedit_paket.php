<?php 
include "../../../../assets/koneksi.php";
$id=$_POST['id'];
$tipe=$_POST['tipe'];
$lama=$_POST['lama'];
$level=$_POST['level'];
$jenis_waktu=$_POST['jenis_waktu'];
$biaya=$_POST['biaya'];
$book=$_POST['book'];
$fasilitas=nl2br($_POST['fasilitas']);


$ekstensi_diperbolehkan	= array('jpg','png','gif');
$lokasifile=$_FILES['berkas']['tmp_name'];
$file=$_FILES['berkas']['name'];
$x = explode('.', $file);
$ekstensi = strtolower(end($x));
$ukuran=$_FILES['berkas']['size'];
$namafile=date('Ymdhis').$file;
$folder="gambar/".$namafile;


if ($file=='') {
 		
	$q1=mysqli_query($conn, "UPDATE paket set 
		nama_paket='$tipe',
		lama_potret='$lama',
		level_paket='$level',
		biaya='$biaya',
		jenis_waktu='$jenis_waktu',
		fasilitas='$fasilitas',
		bisa_booking='$book'
		where id_paket='$id';
		
		")or die(mysqli_error()); 
?>
			<script type="text/javascript">
		alert('Data paket berhasil diperbaharui');
		window.location.href="../../?a=paket"

	</script>
	<?php 
 }else{
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			$upload=move_uploaded_file($lokasifile, $folder);

 	$fotolama = $_POST['fotolama'];	
	$q1=mysqli_query($conn, "UPDATE paket set 
		nama_paket='$tipe',
		lama_potret='$lama',
		level_paket='$level',
		biaya='$biaya',
		jenis_waktu='$jenis_waktu',
		fasilitas='$fasilitas',
		bisa_booking='$book',
		gambar='$namafile'
		where id_paket='$id';
		
		")or die(mysqli_error()); 

			
 		@unlink('gambar/'.$fotolama);
?>

	<script type="text/javascript">
		alert('Data paket berhasil disimpan');
		window.location.href="../../?a=paket"

	</script>
<?php }else{ ?>
	<script type="text/javascript">
		alert('Data ukm gagal disimpan\nharap pilih file gambar dengan benar');
		window.location.href="../../?a=paket"

	</script>
<?php } 
}?>
