<style type="text/css">
	table{
		border-collapse: collapse;
	}
</style>
<?php 
include "../../../assets/koneksi.php";
session_start();
 $namabulan = array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember");
$id = $_SESSION['iduser'];
$waktu = $_GET['waktu'];
$id_tagihan = $_GET['id_tagihan'];
$q_plg = mysqli_query($conn, "SELECT * from pelanggan where id_pelanggan='$id'")or die(mysqli_error());
$d_plg = mysqli_fetch_array($q_plg);

$q = mysqli_query($conn, "SELECT * from cetak_foto as a
left join harga_cetak as b on a.id_hc=b.id_hc
left join harga_edit as c on a.id_he = c.id_he 
	where a.status!='Masuk Ke Keranjang' and a.id_pelanggan='$id' and a.waktu_pesan='$waktu'");
$j = mysqli_num_rows($q);

$q_book = mysqli_query($conn, "SELECT * from booking as a
left join paket as b on a.id_paket=b.id_paket
	where a.status!='Masuk Ke Keranjang' and a.id_pelanggan='$id' and a.tanggal_booking='$waktu'");
$j_book = mysqli_num_rows($q_book);
?>



<div style="width: 100px;float: left">
  <img src="../../gambar/logo.png" style="width: 100px; height: 50px; margin-top: 20px">
</div>

<div style="width: 500px; float: right;">
  
    <h2>
      GLOWING ART STUDIO</h2>
      <p>Jl. Ir. H. Juanda No.15, Rimbo Kaluang, Kec. Padang Bar., Kota Padang, Sumatera Barat 25515
      	<br>
    Telp : +627517057671
</p>



</div>
<div style="clear:both;"></div>
<hr>
<center>
	<h3>Tanda Terima Orderan</h3>
</center>
<h4>Data Pelanggan</h4>

<table width="100%">
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><?php echo $d_plg['nama_pelanggan'] ?></td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td>:</td>
		<td><?php echo $d_plg['alamat_pelanggan'] ?></td>
	</tr>
	<tr>
		<td>No HP</td>
		<td>:</td>
		<td><?php echo $d_plg['nohp_pelanggan'] ?></td>
	</tr>
</table>

<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h4>Pesanan</h4>
</div>

	<table width="100%" class="table table-bordered table-striped" border="1">
		<tr >
			<td>No</td>
			<td>Jenis Order</td>
			<td>Keterangan</td>
			<td>Qty</td>
			<td>Harga</td>
			<td>Biaya Tambahan</td>
			<td>Total Biaya</td>
		
			
		</tr>
<?php 
$no = 1;
$nol=0;
$idtagihan; 
while ($d = mysqli_fetch_array($q)) { 
	$idtagihan= $d['id_tagihan'];
	if($d['with_frame']=='Ya'){
			$biaya = $d['dengan_frame'];
			$ket = "Menggunakan Frame";

			}else{
			$biaya = $d['tanpa_frame'];
			$ket = "Tidak Menggunakan Frame";

			}
			if($d['id_he']==''){
			 $biayaedit = 0;
			 $with_edit =  "";
			 $total_harga = $d['qty'] * $biaya;
			}else{
			 $biayaedit = $d['harga_edit'];
			 $with_edit =  'Dengan edit '.$d['nama_edit'].' <br>[Tambahan biaya '.number_format($biayaedit).']';
			 $total_harga = $d['qty'] * $biaya + $biayaedit;

			}
			$totalbiaya = $nol+=$total_harga;
			?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td>Cetak Foto</td>
			<td><?php echo $d['ukuran'].'<br>'.$ket.'<br>'.$with_edit ?></td>
			<td><?php echo $d['qty'] ?> Item</td>
			<td><?php echo number_format($biaya) ?></td>
			<td><?php echo number_format($biayaedit) ?></td>
			<td><?php echo number_format($total_harga) ?></td>
			
			
		</tr>
	

	<?php }



while ($d_book = mysqli_fetch_array($q_book)) { ?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td>Paket</td>
			<td>
				Paket : <?php echo $d_book['nama_paket'] ?> <br>
				Untuk Acara : <?php echo $d_book['kegiatan'] ?>
				pada tanggal <?php echo $d_book['tanggal_mulai'] ?>
			</td>
			
			<td><?php echo $d_book['lama_acara'] ?> Hari</td>
			<td><?php echo number_format($d_book['biaya']) ?></td>
			<td></td>
			<td><?php 
	$total = $d_book['biaya'] * $d_book['lama_acara'];
$totalbiaya = $nol+=$total;
echo number_format($total);
			?></td>
		</tr>
	

	<?php } ?>
<tr>
	<td colspan="5">Total</td>
	<td colspan="2"><?php echo number_format($totalbiaya) ?></td>
</tr>
	</table>


<?php $q_pemb= mysqli_query($conn, "SELECT * from pembayaran where id_pelanggan='$id' and id_tagihan='$id_tagihan' and status='Acc'");
$j_pemb = mysqli_num_rows($q_pemb); 
if ($j_pemb>0) { ?>
<h4>Pembayaran</h4>
<table width="100%" border="1">
	<tr>
		<td>Pembayaran Via</td>
		<td>Keterangan Transaksi</td>
		<td>Waktu Transaksi</td>
		<td>Jumlah Pembayaran</td>
	</tr>
	<?php 
	$total_bayar = 0;
	while ($d_pemb = mysqli_fetch_array($q_pemb)) { 
	$total_bayar += $d_pemb['jumlah_pembayaran']; ?>
		<tr>
			<td><?php echo $d_pemb['bayar_via'] ?></td>
			<td><?php echo $d_pemb['keterangan'] ?></td>
			<td><?php echo $d_pemb['waktu_bayar'] ?></td>
			<td><?php echo $d_pemb['jumlah_pembayaran'] ?></td>
		</tr>
	<?php }

	$sisa = $totalbiaya - $total_bayar; ?>
	<tr>
		<td colspan="3">Total</td>
		<td><?php echo $total_bayar ?></td>
	</tr>
</table>
<br>
<?php }else{
	$sisa = $totalbiaya;
} ?>
<h4>Status Pembayaran : <?php echo $sisa==0 ? 'Lunas' : 'Sisa '.number_format($sisa); ?></h4>

<br>	
<div style="float:right">
	<center>	
		Padang, <?php echo 	date('d').' '.$namabulan[date('m')].' '.date('Y');
	$q_admin =mysqli_query($conn, "SELECT * from admin");
	$d_admin = mysqli_fetch_array($q_admin);
	echo "<br><br><br><br>".$d_admin['nama_admin'];
	echo "<br>".$d_admin['jabatan'];
	 ?>	
	</center>
</div>

<script type="text/javascript">
	window.print()
</script>