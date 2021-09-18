<?php 
$q = mysqli_query($conn, "SELECT * from paket");
$q2 = mysqli_query($conn, "SELECT * from harga_cetak");
?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Layanan Kami</h3>
</div>
<?php

while ($d = mysqli_fetch_array($q)) { ?>
	

<div class="col-lg-4 col-sm-6" style="margin-bottom:35px">
	<div class="product-item">
		<div class="pi-pic">
			
				<div class="tag-sale">Paket </div>
			
			<img src="gambar/logofoto.jpg" alt="">
			<div class="pi-links">
				
				<a href="?m=v_jasa&idj=<?php echo $d['id_paket'] ?>" class="add-card"><i class="flaticon-bag"></i><span>View Detail</span></a>
				
			</div>
		</div>
		<div>
			<br>
			<h6 style="float:right;"><?php echo number_format($d['biaya']) ?></h6>
			<?php echo $d['nama_paket'] ?> - 
			<?php echo $d['level_paket'] ?>
			

		</div>
	</div>
</div>
	<?php } ?>


	<?php while ($d2 = mysqli_fetch_array($q2)) { ?>

<div class="col-lg-4 col-sm-6" style="margin-bottom:35px">
	<div class="product-item">
		<div class="pi-pic">
			<div class="tag-sale">Cetak </div>
			<img src="gambar/logofoto.jpg" alt="">
			<div class="pi-links">
				
				<a href="?m=v_cetak&idc=<?php echo $d2['id_hc'] ?>" class="add-card"><i class="flaticon-bag"></i><span>View Detail</span></a>
				
			</div>
		</div>
		<div>
			<br>
			<h6 style="float:right;"><?php echo number_format($d2['tanpa_frame']) ?></h6>
			<?php echo $d2['ukuran'] ?>
			
			
		</div>
	</div>
</div>
	<?php } ?>
 <div class="clearfix"></div>

