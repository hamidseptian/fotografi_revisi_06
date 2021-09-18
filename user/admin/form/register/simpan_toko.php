<?php 
include "../../../koneksi.php";
$nama =$_POST['nama'];
$pemilik =$_POST['pimilik'];
$alm =$_POST['alm'];
$hp =$_POST['hp'];
$idkel =$_POST['idkel'];
$email =$_POST['email'];
$pass =$_POST['password'];



$q1 = mysqli_query($conn, "INSERT into toko set
                nama_toko = '$nama',
                pemilik_toko='$pemilik',
                alamat_toko='$alm',
                nohp_toko='$hp',
                id_kelurahan='$idkel',
                username='$email',
                password='$pass',
                status_toko='Pendaftaran'
    ")or die(mysqli_error());
 ?>

 <script type="text/javascript">
     alert('Data toko anda berhasil ditambahkan');
     window.location.href="../../?m=login_toko"
 </script>