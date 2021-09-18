<?php
session_start();
include "../../../../assets/koneksi.php";
$qt = mysqli_query($conn, "SELECT max(id_tagihan)as idt from tagihan");
$dt = mysqli_fetch_array($qt);
$idt = $dt['idt']+1;
$biaya=$_GET['b'];
$idpel = $_GET['id'];

$ket_order=$_GET['ket_order'];
$timestamp = date('Y-m-d h:i:s');

$tiga_hari        = mktime(0,0,0,date("n"),date("j")+3,date("Y"));
$akhir_pembayaran          = date("Y-m-d", $tiga_hari);
$q = mysqli_query($conn, "UPDATE cetak_foto
	set order_via='Offline',
	status='Order',
	waktu_pesan='$timestamp',
	id_tagihan='$idt',
	id_pelanggan='$idpel'
 where  status='Masuk Ke Keranjang' and id_pelanggan=''");

$q = mysqli_query($conn, "UPDATE booking
	set status='Order',
	tanggal_booking='$timestamp',
	id_tagihan='$idt',
		id_pelanggan='$idpel'

 where id_pelanggan='' and status='Masuk Ke Keranjang'");

$q2 = mysqli_query($conn, "INSERT into tagihan (id_tagihan, id_pelanggan, nama_tagihan, jumlah_tagihan, waktu_create, berakhir_pembayaran, metode_pembayaran) values('$idt', '$idpel','$ket_order','$biaya','$timestamp','$akhir_pembayaran','Tunai')");
?>
<script type="text/javascript">
	alert('Pesanan Di Konfirmasi');
	window.location.href='../../?a=detail_pesanan&idp=<?php echo $idpel ?>&waktu=<?php echo $timestamp ?>&via=Offline&id_tagihan=<?php echo $idt ?>&menu=pesan_online'
</script>