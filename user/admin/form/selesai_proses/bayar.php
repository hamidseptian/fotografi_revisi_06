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

if ($q) { ?>
	<script type="text/javascript">
		alert('Data pembayaran disimpan');
	window.location.href='../../?a=detail_pesanan_selesai&idp=<?php echo $iduser ?>&waktu=<?php echo $waktu ?>&via=<?php echo $via ?>&id_tagihan=<?php echo $idt ?>'
	</script>
<?php }else{
?>
<script type="text/javascript">
	alert('gagal');
		window.location.href='../../?a=detail_pesanan_selesai&idp=<?php echo $iduser ?>&waktu=<?php echo $waktu ?>'
</script>

<?php } 
}
?>