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

if ($tb==$jp) { 
	$q = mysqli_query($conn, "INSERT INTO pembayaran (id_tagihan, id_pelanggan, jumlah_pembayaran, keterangan, bayar_via,  waktu_bayar, status)values ('$idt','$iduser','$jp','$ket','Tunai','$time','Acc')");?>
	<script type="text/javascript">
		alert('pembayaran disimpan');
		window.location.href='../../?a=detail_order&idp=<?php echo $iduser ?>&waktu=<?php echo $waktu ?>&status=Selesai'
	</script>
<?php }
else{ ?>
	<script type="text/javascript">
		alert('Gagal menyimpan\nmasukan jumlah pembayaran sebanyak jumlah sisa');
		window.location.href='../../?a=detail_order&idp=<?php echo $iduser ?>&waktu=<?php echo $waktu ?>'
	</script>
<?php }
?>