<?php
session_start();
include "../../../../assets/koneksi.php";

$idpel=$_GET['idpel'];

$waktu = $_GET['waktu'];
$via = $_GET['via'];
$idt = $_GET['idt'];
$id_pembayaran = $_GET['id_pembayaran'];

$q2 = mysqli_query($conn, "UPDATE pembayaran set
	status='Reject Transfer'
	where id_pembayaran='$id_pembayaran' ");

?>
<script type="text/javascript">
		alert('Pembayaran transfer direject');
	window.location.href='../../?a=detail_pesanan&idp=<?php echo $idpel ?>&waktu=<?php echo $waktu ?>&via=<?php echo $via ?>&id_tagihan=<?php echo $idt ?>'
	</script>