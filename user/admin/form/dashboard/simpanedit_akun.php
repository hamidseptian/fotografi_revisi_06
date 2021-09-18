<?php 
include "../../../../assets/koneksi.php";

session_start();


$id = $_SESSION['id_admin'];
$level = $_SESSION['level'];


$username = $_POST['username'];
$password = $_POST['password'];
$nama = $_POST['nama'];
$jabatan = $_POST['jabatan'];



 		$q1=mysqli_query($conn, "UPDATE admin set 
		
		nama_admin='$nama',
		jabatan='$jabatan',
		username='$username',
		password='$password'
		where id='$id'
		
		
		")or die(mysqli_error()); ?>
			<script type="text/javascript">
		alert('Akun anda berhasil diperbaharui');
		window.location.href="../../";

	</script>
	