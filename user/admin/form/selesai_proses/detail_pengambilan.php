<?php 
$id = $_GET['idp'];
$waktu = $_GET['waktu'];
$via = $_GET['via'];
$id_tagihan = $_GET['id_tagihan'];
$status_pengambilan = $_GET['status_pengambilan'];

$q = mysqli_query($conn, "SELECT * from cetak_foto as a
left join harga_cetak as b on a.id_hc=b.id_hc
left join harga_edit as c on a.id_he = c.id_he 
	where a.status!='Masuk Ke Keranjang' and a.id_pelanggan='$id' and a.waktu_pesan='$waktu'");
$j = mysqli_num_rows($q);



$q_book = mysqli_query($conn, "SELECT * from booking as a
left join paket as b on a.id_paket=b.id_paket
	where a.status!='Masuk Ke Keranjang' and a.id_pelanggan='$id' and a.tanggal_booking='$waktu'");
$j_book = mysqli_num_rows($q_book);

$qpel = mysqli_query($conn, "SELECT * from pelanggan where id_pelanggan='$id'");
$dpel = mysqli_fetch_array($qpel);

$q_tagihan = mysqli_query($conn, "SELECT *, (SELECT sum(jumlah_pembayaran) from pembayaran where id_tagihan='$id_tagihan' and status='Acc') as dibayar from tagihan where id_tagihan='$id_tagihan'");
$d_tagihan = mysqli_fetch_array($q_tagihan);
$sisa_tagihan = $d_tagihan['jumlah_tagihan']-$d_tagihan['dibayar'];

?>
<div class="box-header">
<h3 class="box-title">Detail Pesanan</h3>
<a href="?a=pesan_online" class="pull-right btn btn-info">Kembali</a>
</div>


<!-- <div class="col-md-2">
</div> -->
<?php if ($j==0) {
	echo '
<div class="col-md-12">
	<div class="alert alert-info">Keranjang Kosong</div>
	</div>';	
}else{ ?>


<div class="col-md-8">
	<div style="overflow-x: scroll	">
	<!-- <h4>Biaya Cetak</h4> -->
	<table class="table table-bordered table-striped">
		<tr style="background: aqua">
			<td>No</td>
			<td>Jenis Order</td>
			<td>Keterangan Order</td>
			<td>Qty</td>
			<td>Harga</td>
			<td>Total Biaya</td>
			<td>Status</td>
			<!-- <td>File</td> -->
			
		</tr>
<?php 
$no = 1;
$nol=0;
$idtagihan; 
while ($d = mysqli_fetch_array($q)) { 
	$idtagihan= $d['id_tagihan'];


	if ($d['order_via']=="Offline") {
				$foto =  "Diluar System";
			}else{ 
				$foto = '<img src="../../home/form/galeri/file_foto/'.$d['foto'].'" width="100%">';
			}
	
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
			<td><?php echo number_format($total_harga) ?></td>
			
			<td width='30%'><?php echo $d['status'] ?></td>
			
		</tr>
	<?php } 




while ($d_book = mysqli_fetch_array($q_book)) { ?>
		<tr style="color:red">
			<td><?php echo $no++ ?></td>
			<td>Paket</td>
			<td>
				Paket : <?php echo $d_book['nama_paket'] ?> <br>
				Untuk Acara : <?php echo $d_book['kegiatan'] ?>
				pada tanggal <?php echo $d_book['tanggal_mulai'] ?>
			</td>
			
			<td><?php echo $d_book['lama_acara'] ?> Hari</td>
			<td><?php echo number_format($d_book['biaya']) ?></td>
			<td><?php 
	$total = $d_book['biaya'] * $d_book['lama_acara'];
$totalbiaya = $nol+=$total;
echo number_format($total);
			?></td>
			<td><?php echo $d_book['status'] ?></td>
		</tr>
	

	<?php } ?>
<tr>
	<td colspan="5">Total</td>
	<td colspan="2"><?php echo number_format($totalbiaya) ?></td>
</tr>
	</table>
</div>

	<br>
	
	
</div>

<div class="col-md-4">
	<h4>Detail Pelanggan</h4>
	<table class="table">
		<tr>
			<td>Nama</td>
			<td><?php echo $dpel['nama_pelanggan'] ?></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><?php echo $dpel['alamat_pelanggan'] ?></td>
		</tr>
		<tr>
			<td>No HP</td>
			<td><?php echo $dpel['nohp_pelanggan'] ?></td>
		</tr>
	</table>
	<hr>

	<h4>Detail Orderan</h4>
	<h4>Total Biaya : <?php echo number_format($totalbiaya) ?></h4>
	<?php if ($sisa_tagihan>0) { ?>
		<a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#bayar_manual">Pembayaran Manual</a>
	<?php } ?>
	
	



<form  method="post" action="form/pesanan/bayar.php?via=<?php echo $via ?>" enctype="multipart/form-data">
<div class="modal fade" id="bayar_manual">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pembayaran Manual</h4>
              </div>
              <div class="modal-body">
	              <div class="form-group">
			 		<label>Jumlah Pembayaran</label>
			 		<input type="hidden" name="idpel" class="form-control" value="<?php echo $id ?>">
			 		<input type="hidden" name="waktu" class="form-control" value="<?php echo $waktu ?>">
			 		<input type="hidden" name="idt" class="form-control" value="<?php echo $id_tagihan ?>">
			 		<input type="hidden" name="tb" class="form-control" value="<?php echo $sisa_tagihan ?>">
			 		<input type="number" name="jp" class="form-control" value="<?php echo $sisa_tagihan ?>">
			 	</div>
			 	<div class="form-group">
			 		<label>Keterangan</label>
			 		<input type="text" name="ket" class="form-control" value="Lunas" readonly>
			 	</div>
             
        
              
             
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>

<table class="table">
	<tr>
		<td>Tanggal Transaksi</td>
		<td>Metode Pembayaran</td>
		<td>Jumlah</td>
		<td>Status</td>
		<td>Action</td>
	</tr>
<?php 
$total_bayar =0;
$q_pembayaran = mysqli_query($conn, "SELECT * from pembayaran p left join rekening r on p.id_rekening= r.id_rekening where p.id_tagihan='$id_tagihan'")or die(mysqli_error());
while ($d_pembayaran = mysqli_fetch_array($q_pembayaran)) { 
	if ($d_pembayaran['status']=='Acc') {
		$total_bayar += $d_pembayaran['jumlah_pembayaran'];
	}
	?>
	<tr>
		<td><?php echo $d_pembayaran['waktu_bayar'] ?></td>
		<td><?php echo $d_pembayaran['bayar_via'] ?></td>
		<td><?php echo $d_pembayaran['jumlah_pembayaran'] ?></td>
		<td><?php echo $d_pembayaran['status'] ?></td>
		<td>
			<?php if ($d_pembayaran['bayar_via']=='Transfer') {  ?>
				<a href="#" data-toggle="modal" data-target="#lihat_bukti_<?php echo $d_pembayaran['id_pembayaran'] ?>">Lihat Bukti Pembayaran</a>
			<?php } ?>
		</td>
	</tr>


<form action="form/paket/simpan_paket.php" method="post" enctype="multipart/form-data">
<div class="modal fade" id="lihat_bukti_<?php echo $d_pembayaran['id_pembayaran'] ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Bukti Pembayaran</h4>
              </div>
              <div class="modal-body">
              <div class="form-group">
                 <img src="../../home/form/pesanan/file_transfer/<?php echo $d_pembayaran['file'] ?>" width="100%">
              </div> 
             
        
              
             
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <?php  if ($d_pembayaran['status']=='Pengecekan') { ?>
                <a href="form/pesanan/reject_transfer.php?idpel=<?php echo $id ?>&idt=<?php echo $id_tagihan ?>&id_pembayaran=<?php echo $d_pembayaran['id_pembayaran'] ?>&waktu=<?php echo $waktu ?>&via=<?php echo $via ?>" class="btn btn-info" onclick="return confirm('Apakah anda akan mereject Transfer.??')">Reject</a>
                <a href="form/pesanan/acc_transfer.php?idpel=<?php echo $id ?>&idt=<?php echo $id_tagihan ?>&id_pembayaran=<?php echo $d_pembayaran['id_pembayaran'] ?>&waktu=<?php echo $waktu ?>&via=<?php echo $via ?>" class="btn btn-info" onclick="return confirm('Apakah anda akan acc Transfer.??')">Acc</a>
               	<?php  } ?>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>

<?php } ?>

</table>
	Total Tagihan :<?php echo number_format($totalbiaya) ?> <br>
	Total Dibayar :<?php echo number_format($total_bayar) ?> <br>
	Sisa :<?php echo number_format($sisa_tagihan) ?>
		<br>

	<?php if ($total_bayar>0) {
		if ($status_pengambilan=='Diterima Pelanggan') {
			echo "Barang sudah diterima pelanggan";
		}else{
		?>
		<a href="form/selesaI_proses/terima_foto.php?idpel=<?php echo $id ?>&waktu=<?php echo $waktu ?>" class="btn btn-default" onclick="return confirm('Apakah foto hasil cetak sudah diberikan ke pelanggan')">Foto Diterima Pelanggan</a>
	<?php } 
	} ?>
</div>
<?php } ?>