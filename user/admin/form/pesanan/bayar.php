<?php
session_start();
include "../../../../assets/koneksi.php";

$tb=$_POST['tb'];
$jp=$_POST['jp'];
$ket=$_POST['ket'];
$waktu=$_POST['waktu'];

$idt=$_POST['idt'];
$via=$_GET['via'];
$time = date('Y-m-d h:i:s');
$iduser = $_POST['idpel'];


if ($tb<$jp) { ?>
	<script type="text/javascript">
		alert('Gagal menyimpan\nJumlah yang anda input lebih besar dari tagihan');
		window.location.href='../../?a=detail_pesanan&idp=<?php echo $iduser ?>&waktu=<?php echo $waktu ?>&via=<?php echo $via ?>&id_tagihan=<?php echo $idt ?>'
	</script>
<?php }else{
$q = mysqli_query($conn, "INSERT INTO pembayaran (id_tagihan, id_pelanggan, jumlah_pembayaran, keterangan, bayar_via,  waktu_bayar, status)values ('$idt','$iduser','$jp','$ket','Tunai','$time','Acc')");



$cek_booking_plg = mysqli_query($conn, "SELECT * from booking where id_pelanggan='$iduser' and tanggal_booking='$waktu'")or die(mysqli_error());
$d_cek_booking = mysqli_fetch_array($cek_booking_plg);
echo $mulai =  $d_cek_booking['tanggal_mulai'];
echo "<br>";
echo $selesai =  $d_cek_booking['tanggal_selesai'];
$cek_booking_proses = mysqli_query($conn, "UPDATE booking set status='Dibatalkan Sistem' where tanggal_mulai>='$mulai' and tanggal_selesai <='$selesai' and status='Order' and tanggal_booking!='$waktu'")or die(mysqli_error());


$q2 = mysqli_query($conn, "UPDATE cetak_foto set
	status='Dalam Proses'
	where waktu_pesan='$waktu' and id_pelanggan='$iduser'")or die(mysqli_error());

$q2 = mysqli_query($conn, "UPDATE booking set
	status='Dalam Proses'
	where tanggal_booking='$waktu' and id_pelanggan='$iduser' and status !='Dibatalkan Sistem'")or die(mysqli_error());

$q3 = mysqli_query($conn, "UPDATE pembayaran set
	status='Acc'
	where id_tagihan='$idt' and id_pelanggan='$iduser'")or die(mysqli_error());


// $j_cek_booking_proses = mysqli_num_rows($cek_booking_proses);
// echo $j_cek_booking_proses;
// if ($j_cek_booking_proses>0) {
// }else{}


if ($q) { ?>
	<script type="text/javascript">
		alert('Data pembayaran disimpan');
	window.location.href='../../?a=detail_pesanan&idp=<?php echo $iduser ?>&waktu=<?php echo $waktu ?>&via=<?php echo $via ?>&id_tagihan=<?php echo $idt ?>'
	</script>
<?php }else{
?>
<script type="text/javascript">
	alert('gagal');
		window.location.href='../../?a=detail_pesanan&idp=<?php echo $iduser ?>&waktu=<?php echo $waktu ?>'
</script>

<?php } 
}
?>