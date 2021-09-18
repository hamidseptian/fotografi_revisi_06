<?php 

 ?><div class="box-header with-border">
  <h3 class="box-title">Pesan Baru</h3>

  <div class="box-tools pull-right">
    <a href="?a=keranjang" class="btn btn-info btn-sm">Lihat Keranjang</a>
    <a href="?a=pesan_online" class="btn btn-info btn-sm">Kembali</a>
    
  </div>
</div>



<hr>
<?php 
  $q1=mysqli_query($conn, "SELECT * from harga_cetak");
  $q2=mysqli_query($conn, "SELECT * from paket");
  $no=1;
 ?>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        <td>Jenis</td>
        <td>Keterangan</td>
        <td>Biaya</td>
        <td>Option</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q1)) { 
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
    <td>Pas Foro</td>
    <td><?php echo $d1['ukuran'] ?></td>
    <td><?php echo number_format($d1['tanpa_frame']) ?></td>
    <td>
      <a href="?a=detail_cetak&idc=<?php echo $d1['id_hc'] ?>" class="btn btn-info btn-xs">Order</a>    
    </td>
  </tr>
  <?php } 
  while ($d2=mysqli_fetch_array($q2)) { 
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
    <td>Paket</td>
    <td><?php echo $d2['nama_paket'] ?></td>
    <td><?php echo number_format($d2['biaya']) ?></td>
    <td>
      <a href="?a=detail_paket&idj=<?php echo $d2['id_paket'] ?>" class="btn btn-info btn-xs">Order</a>    
    </td>
  </tr>
  <?php } ?>
</table>