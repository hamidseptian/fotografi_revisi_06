<?php 
 $namabulan = array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember");
$filter = $_GET['filter'];
if (isset($_GET['bulan']) && isset($_GET['tahun'])) {
	$bulan = $_GET['bulan'];
	$tahun = $_GET['tahun'];
	$caption_bulan = 'Bulan '.$namabulan[$bulan].' '.$tahun;
	$target_print = 'filter='.$filter.'&bulan='.$bulan.'&tahun='.$tahun;
	$q = mysqli_query($conn, "SELECT a.*, b.*, c.nama_edit, c.harga_edit from cetak_foto as a
left join harga_cetak as b on a.id_hc=b.id_hc
left join harga_edit as c on a.id_he = c.id_he 
	where a.status in ('Dalam Proses','Selesai','Diterima Pelanggan') and month(a.waktu_pesan)='$bulan' and year(a.waktu_pesan)='$tahun'");
$q_book = mysqli_query($conn, "SELECT * from booking as a
left join paket as b on a.id_paket=b.id_paket
	where a.status in ('Dalam Proses','Selesai','Diterima Pelanggan','Berlangsung') and month(a.tanggal_booking)='$bulan' and year(a.tanggal_booking)='$tahun'");
}else{
	$caption_bulan = '';
	$target_print = 'filter='.$filter;
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
<div class="box-header">
<h3 class="box-title">Laporan Penjualan <br><?php echo $caption_bulan ?></h3>
	<div class="pull-right">
	
		<a href="form/laporan/print.php?<?php echo $target_print ?>" class="btn btn-info">Print</a>
		<a href="#" class="btn btn-info"  data-toggle="modal" data-target="#filter_by_jenis">Filter</a>
	</div>
</div>


<form action="" method="GET" enctype="multipart/form-data">
<div class="modal fade" id="filter_by_jenis">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Filter By Jenis Order</h4>
              </div>
              <div class="modal-body">
             
              <div class="form-group">
                  <label>Jenis Filter</label>
                  <input type="hidden" name="a" class="form-control" value="laporan">
                  <select class="form-control" name="filter">
                  <?php 
                  $p = array('Paket' =>'Paket','Cetak' =>'Cetak','All' =>'Semua Laporan');
                  foreach ($p as $k =>$pp) { ?>
                  <option value="<?php echo $k ?>"><?php echo $pp ?></option>
                  <?php  } ?>
                    
                  </select>
              </div>
              <div class="form-group">
                  <label>Bulan</label>
                  <select class="form-control" name="bulan">
                  <?php 
                 
                  foreach ($namabulan as $k =>$pp) { ?>
                  <option value="<?php echo $k ?>"><?php echo $pp ?></option>
                  <?php  } ?>
                    
                  </select>
              </div>
              <div class="form-group">
                  <label>Tahun</label>
                  <select class="form-control" name="tahun">
                  <?php 
                  $p = array('Paket','Cetak','All');
                  for ($i=date('Y'); $i >=(date('Y')-5); $i--) {  ?>
                  <option value="<?php echo $i ?>"><?php echo $i ?></option>
                  <?php  } ?>
                    
                  </select>
              </div> 
            
             
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Filter</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>

<!-- <div class="col-md-2">
</div> -->
<?php if (($j+$j_book)==0) {
	echo '
<div class="col-md-12">
	<div class="alert alert-info">Tidak ada laporan</div>
	</div>';	
}else{ ?>


<div class="col-md-12">
	<div style="overflow-x: scroll	">
	<!-- <h4>Biaya Cetak</h4> -->
	<table class="table table-bordered table-striped" id="example1">
		<thead>
			<tr style="background: aqua">
			<td>No</td>
			<td>Tanggal Order</td>
			<td>Jenis Order</td>
			<td>Keterangan Order</td>
			<td>Qty</td>
			<td>Harga</td>
			<td>Biaya Tambahan</td>
			<td>Total Biaya</td>
			<!-- <td>File</td> -->
			
		</tr>
		</thead>
<?php 
$no = 1;
$nol=0;
$idtagihan; 

if ($filter=='All' || $filter=="Cetak") {
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
				$ket = "Tanpa Frame";

				}
				if($d['id_he']==''){
				 $biayaedit = 0;
				 $with_edit =  "";
				 $tambahan_biaya ='';
				 $total_harga = $d['qty'] * $biaya;
				}else{
				 $biayaedit = $d['harga_edit'];
				 $with_edit =  'Dengan edit '.$d['nama_edit'];
				 $tambahan_biaya = number_format($biayaedit);
				 $total_harga = $d['qty'] * $biaya + $biayaedit;

				}
				$totalbiaya = $nol+=$total_harga;
				?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $d['waktu_pesan'] ?></td>
				<td>Cetak Foto</td>
				<td><?php echo $d['ukuran'].'<br>'.$ket.'<br>'.$with_edit ?></td>
				<td><?php echo $d['qty'] ?> Item</td>
				<td><?php echo number_format($biaya) ?></td>
				<td><?php echo number_format($biayaedit) ?></td>
				<td><?php echo number_format($total_harga) ?></td>
				
				
			</tr>
		<?php } 

	}

	if($filter=='Paket' || $filter=='All'){



	while ($d_book = mysqli_fetch_array($q_book)) { ?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $d_book['tanggal_booking'] ?></td>
				<td>Paket</td>
				<td>
				Paket : <?php echo $d_book['nama_paket'] ?> <br>
				Pemotretan : <?php echo $d_book['jenis_pemotretan'].'<br>'.$d_book['lokasi'] ?>
				pada tanggal <?php echo $d_book['tanggal_mulai'] ?>
			</td>
			
			<td><?php echo 1 ?>  Kali Pemotretan</td>
				<td><?php echo number_format($d_book['biaya']) ?></td>
				<td>0</td>
				<td>
					<?php 
		$total = $d_book['biaya'] * 1;
	$totalbiaya = $nol+=$total;
	echo number_format($total);
				?></td>
				<td></td>
			</tr>
		

		<?php } 
	} ?>
<tfoot>
	<tr>
		<td colspan="7">Total</td>
		<td><?php echo number_format($totalbiaya) ?></td>
	</tr>
</tfoot>
	</table>
</div>

	<br>
	
	
</div>


<?php } ?>


