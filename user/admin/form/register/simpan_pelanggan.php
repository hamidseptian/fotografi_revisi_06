<?php 
include "../../../koneksi.php";
$nama =$_POST['nama'];
$alm =$_POST['alm'];
$hp =$_POST['hp'];
$idkel=$_POST['idkel'];
$email =$_POST['email'];
$pass =$_POST['password'];



$q1 = mysqli_query($conn, "INSERT into pelanggan set
                nama_pelanggan = '$nama',
              	id_kelurahan='$idkel',
                alamat_pelanggan='$alm',
                nohp_pelanggan='$hp',
              
                emaiL_pelanggan='$email',
                password='$pass'
    ")or die(mysqli_error());
 ?>

 <script type="text/javascript">
     alert('Data pelanggan anda berhasil ditambahkan');
     window.location.href="../../?m=login_pelanggan"
 </script>