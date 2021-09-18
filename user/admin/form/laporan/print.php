<style type="text/css">
	table{
		border-collapse: collapse;
	}
</style>
<?php 
include "../../../../assets/koneksi.php";
session_start();
 $namabulan = array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember");
$filter = $_GET['filter'];
if (isset($_GET['bulan']) && isset($_GET['tahun'])) {
	$bulan = $_GET['bulan'];
	$tahun = $_GET['tahun'];
	$caption_bulan = 'Bulan '.$namabulan[$bulan].' '.$tahun;
	$q = mysqli_query($conn, "SELECT a.*, b.*, c.nama_edit, c.harga_edit from cetak_foto as a
left join harga_cetak as b on a.id_hc=b.id_hc
left join harga_edit as c on a.id_he = c.id_he 
	where a.status in ('Dalam Proses','Selesai','Diterima Pelanggan') and month(a.waktu_pesan)='$bulan' and year(a.waktu_pesan)='$tahun'");
$q_book = mysqli_query($conn, "SELECT * from booking as a
left join paket as b on a.id_paket=b.id_paket
	where a.status in ('Dalam Proses','Selesai','Diterima Pelanggan','Berlangsung') and month(a.tanggal_booking)='$bulan' and year(a.tanggal_booking)='$tahun'");
}else{
	$caption_bulan = '';
$q = mysqli_query($conn, "SELECT a.*, b.*, c.nama_edit, c.harga_edit from cetak_foto as a
left join harga_cetak as b on a.id_hc=b.id_hc
left join harga_edit as c on a.id_he = c.id_he 
	where a.status in ('Dalam Proses','Selesai','Diterima Pelanggan') ");
$q_book = mysqli_query($conn, "SELECT * from booking as a
left join paket as b on a.id_paket=b.id_paket
	where a.status in ('Dalam Proses','Selesai','Diterima Pelanggan','Berlangsung') ");
}

$j = mysqli_num_rows($q);




$j_book = mysqli_num_rows($q_book);
?>



<div style="width: 70px;float: left">
  <img src="../../../../home/gambar/logo.png" style="width: 70px; height: 50px; margin-top: 20px">
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
	<h3>Laporan Penjualan <br><?php echo $caption_bulan ?></h3>
</center>

<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">

</div>

	<table width="100%" class="table table-bordered table-striped" border="1">
		<tr >
			<td valign="top">No</td>
			<td valign="top">Jenis Order</td>
			<td valign="top">Keterangan</td>
			<td valign="top">Qty</td>
			<td valign="top">Harga</td>
			<td valign="top">Biaya Tambahan</td>
			<td valign="top">Total Biaya</td>
		
			
		</tr>
<?php 
$no = 1;
$nol=0;
$idtagihan; 
if ($filter=='All' || $filter=="Cetak") {
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
			<td valign="top"><?php echo $no++ ?></td>
			<td valign="top">Cetak Foto</td>
			<td valign="top"><?php echo $d['ukuran'].'<br>'.$ket.'<br>'.$with_edit ?></td>
			<td valign="top"><?php echo $d['qty'] ?> Item</td>
			<td valign="top"><?php echo number_format($biaya) ?></td>
			<td valign="top"><?php echo number_format($biayaedit) ?></td>
			<td valign="top"><?php echo number_format($total_harga) ?></td>
			
			
		</tr>
	

	<?php }
}


if($filter=='Paket' || $filter=='All'){


while ($d_book = mysqli_fetch_array($q_book)) { ?>
		<tr>
			<td valign="top"><?php echo $no++ ?></td>
			<td valign="top">Paket</td>
			<td valign="top">
				Paket : <?php echo $d_book['nama_paket'] ?> <br>
				Untuk Acara : <?php echo $d_book['kegiatan'] ?>
				pada tanggal <?php echo $d_book['tanggal_mulai'] ?>
			</td>
			
			<td valign="top"><?php echo $d_book['lama_acara'] ?> Hari</td>
			<td valign="top"><?php echo number_format($d_book['biaya']) ?></td>
			<td valign="top"></td>
			<td valign="top"><?php 
	$total = $d_book['biaya'] * $d_book['lama_acara'];
$totalbiaya = $nol+=$total;
echo number_format($total);
			?></td>
		</tr>
	

	<?php } 
}
?>
<tr>
	<td colspan="5">Total</td>
	<td colspan="2"><?php echo number_format($totalbiaya) ?></td>
</tr>
	</table>
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