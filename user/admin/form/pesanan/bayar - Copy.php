<?php
session_start();
include "../../../../assets/koneksi.php";

$tb=$_POST['tb'];
$jp=$_POST['jp'];
$ket=$_POST['ket'];
$waktu=$_POST['waktu'];

$idt=$_POST['idt'];
$time = date('Y-m-d h:i:s');
$iduser = $_POST['idpel'];


if ($tb<$jp) { ?>
	<script type="text/javascript">
		alert('Gagal menyimpan\nJumlah yang anda input lebih besar dari tagihan');
		window.location.href='../../?a=detail_pesanan&idp=<?php echo $iduser ?>&waktu=<?php echo $waktu ?>'
	</script>
<?php }else{
$q = mysqli_query($conn, "INSERT INTO pembayaran (id_tagihan, id_pelanggan, jumlah_pembayaran, keterangan, bayar_via,  waktu_bayar, status)values ('$idt','$iduser','$jp','$ket','Tunai','$time','Acc')");
$q2 = mysqli_query($conn, "UPDATE cetak_foto set
	status='Dalam Proses'
	where waktu_pesan='$waktu' and id_pelanggan='$iduser' and id_tagihan='$idt'
	");	
$q2 = mysqli_query($conn, "UPDATE booking set
	status='Dalam Proses'
	where tanggal_booking='$waktu' and id_pelanggan='$iduser' and id_tagihan='$idt'
	");	
if ($q) { ?>
	<script type="text/javascript">
		alert('Data pembayaran disimpan');
	window.location.href='../../?a=pesan_online'
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