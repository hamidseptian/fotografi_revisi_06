<?php 
session_start();
include "../../../assets/koneksi.php";
$id = $_SESSION['iduser'];
$nama =$_POST['nama'];
$alm =$_POST['alm'];
$hp =$_POST['hp'];
$email =$_POST['email'];
$pass =$_POST['pass'];

$cek = mysqli_query($conn, "SELECT * from pelanggan where email_pelanggan='$email' and id_pelanggan !='$id'");
$jcek = mysqli_num_rows($cek);
if ($jcek>0) { ?>
	<script type="text/javascript">
     alert('Data pelanggan gagal ditambahkan\nEmail sudah digunakan\nSilahkan gunakan email lain');
     window.location.href="../../?a=editakun"
 </script>
	
<?php }
else{

$q1 = mysqli_query($conn, "UPDATE pelanggan set
                nama_pelanggan = '$nama',
                alamat_pelanggan='$alm',
                nohp_pelanggan='$hp',
              
                emaiL_pelanggan='$email',
                password='$pass'
                where id_pelanggan='$id'
    ")or die(mysqli_error());
 ?>

 <script type="text/javascript">
     alert('Data berhasil diperbaharui');
     window.location.href="../../"
 </script>
 <?php } ?>