<?php
include 'connectdb.php';
$id=$_POST['id'];
$foto=$_POST['foto'];
$sql="delete from galeri where id_galeri='$id'";
$result=mysqli_query($conn, $sql) or die ('GAGAL');
$q="select * From galeri join kegiatan on galeri.id_kegiatan=kegiatan.id_kegiatan where galeri.id_galeri='$id'";
$tampil = mysqli_query($conn, $q) or die("query salah");
$data = mysqli_fetch_array($tampil);
{
	$id_k=$data['id_kegiatan'];
}

 if($result){
		echo "<script type='text/javascript'>
			alert('Foto telah dihapus..!!');
		</script>";
		unlink("gambar/".$foto);
		echo "<meta http-equiv='refresh' content='0;
	url=../../index.php?m=galeri'>";
	}else{
	echo "<script type='text/javascript'>
		onload =function(){
		alert('Data Gagal Didelete!');
		}
		</script>";
	}
?>

