<?php
session_start();
include "../../../assets/koneksi.php";
$qt = mysqli_query($conn, "SELECT max(id_tagihan)as idt from tagihan");
$dt = mysqli_fetch_array($qt);
$idt = $dt['idt']+1;
$biaya=$_GET['b'];
$ket_order=$_GET['ket_order'];
$metode_bayar=$_POST['metode_bayar'];
$idpel = $_SESSION['iduser'];
$timestamp = date('Y-m-d h:i:s');
$tiga_hari        = mktime(0,0,0,date("n"),date("j")+3,date("Y"));
$akhir_pembayaran          = date("Y-m-d", $tiga_hari);

$cek_booking_plg = mysqli_query($conn, "SELECT * from booking where id_pelanggan='$idpel' and status='Masuk Ke Keranjang'");
$d_cek_booking = mysqli_fetch_array($cek_booking_plg);
$mulai =  $d_cek_booking['tanggal_mulai'];
$selesai =  $d_cek_booking['tanggal_selesai'];
$cek_booking_proses = mysqli_query($conn, "SELECT * from booking where tanggal_mulai>='$mulai' and tanggal_selesai <='$selesai' and status='Dalam Proses'")or die(mysqli_error());
$j_cek_booking_proses = mysqli_num_rows($cek_booking_proses);
// echo $j_cek_booking_proses;
if ($j_cek_booking_proses>0) { ?>
	<script type="text/javascript">
	alert('Pesanan gagal di Konfirmasi\nWaktu booking anda sudah dimiliki oleh pelangggan lain\nSilahkan ganti dengan jadwal booking baru');
	window.location.href='../../?m=keranjang';
</script>
<?php }else{
$q = mysqli_query($conn, "UPDATE cetak_foto
	set status='Order',
	waktu_pesan='$timestamp',
	id_tagihan='$idt'
 where id_pelanggan='$idpel' and status='Masuk Ke Keranjang'");
$q = mysqli_query($conn, "UPDATE booking
	set status='Order',
	tanggal_booking='$timestamp',
	id_tagihan='$idt'
 where id_pelanggan='$idpel' and status='Masuk Ke Keranjang'");

$q2 = mysqli_query($conn, "INSERT into tagihan (id_tagihan, id_pelanggan, nama_tagihan, jumlah_tagihan, waktu_create, berakhir_pembayaran , metode_pembayaran) values('$idt', '$idpel','$ket_order','$biaya','$timestamp','$akhir_pembayaran','$metode_bayar')")
?>
<script type="text/javascript">
	alert('Pesanan Di Konfirmasi');
	window.location.href='../../?m=detail_history&waktu=<?php echo $timestamp ?>&metode_pembayaran=<?php echo $metode_bayar ?>&id_tagihan=<?php echo $idt ?>';
</script>
<?php } ?>