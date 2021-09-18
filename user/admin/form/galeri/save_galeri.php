<?php 
date_default_timezone_set("Asia/Jakarta");

include "../../../../assets/koneksi.php";
		$jumlah = count($_FILES['gambar']['name']);
		if ($jumlah > 0) {
			for ($i=0; $i < $jumlah; $i++) { 
				$id=$_POST['id'];
				$post=date('Y-m-d');
				$file_name = $_FILES['gambar']['name'][$i];
				$ekstensi_diperbolehkan	= array('png','jpg','jpeg','PNG','JPG');
				$x = explode('.', $file_name);
				$ekstensi = strtolower(end($x));
				$ukuran=$_FILES['gambar']['size'][$i];
				$tmp_name = $_FILES['gambar']['tmp_name'][$i];	
				$namaalbum=date('Ymdhis').$file_name;	


						move_uploaded_file($tmp_name, "gambar/".$namaalbum);
						$result=mysqli_query($conn,"INSERT into galeri (foto, post) values('$namaalbum', '$post')")or die('error');
					    echo "<meta http-equiv='refresh' content='0; url=http:../../?a=galeri'>";
					    echo "<script type='text/javascript'>
							onload =function(){
							alert('Foto Ditambahkan');
							}
							</script>";
						
			
							
			}
			
		}


	






?>
