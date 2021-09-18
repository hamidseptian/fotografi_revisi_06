<?php
session_start();
include "../../../assets/koneksi.php";

$ekstensi_diperbolehkan	= array('PNG','JPG','GIF','jpg','png');
$lokasifile=$_FILES['file']['tmp_name'];
$file=$_FILES['file']['name'];
$x = explode('.', $file);
$ekstensi = strtolower(end($x));
$ukuran=$_FILES['file']['size'];
$namafile=date('Ymdhis').$file;
$folder="file_transfer/".$namafile;

$tgls=date('Y-m-d');

$tb=$_POST['tb'];
$jp=$_POST['jp'];
$ket=$_POST['ket'];
$rek=$_POST['rek'];
$idt=$_POST['idt'];
$time = date('Y-m-d h:i:s');
$iduser = $_SESSION['iduser'];


if ($tb<$jp) { ?>
	<script type="text/javascript">
		alert('Gagal menyimpan\nJumlah yang anda input lebih besar dari tagihan');
		window.location.href='../../?m=history'
	</script>
<?php }else{

$upload=move_uploaded_file($lokasifile, $folder);
$q = mysqli_query($conn, "INSERT INTO pembayaran (id_tagihan, id_pelanggan, id_rekening, jumlah_pembayaran, keterangan, bayar_via, file, waktu_bayar, status)values ('$idt','$iduser','$rek','$jp','$ket','Transfer','$namafile','$time','Pengecekan')");
$q2 = mysqli_query($conn, "DELETE from pembayaran where status='Reject Transfer' and id_pelanggan='$iduser' and id_tagihan='$idt'");
if ($q) { ?>
	<script type="text/javascript">
		alert('Data pembayaran akan di proses oleh admin kami');
		window.location.href='../../?m=history'
	</script>
<?php }else{
?>
<script type="text/javascript">
	alert('gagal');
	window.location.href='../../?m=history'
</script>

<?php } 
}
?>