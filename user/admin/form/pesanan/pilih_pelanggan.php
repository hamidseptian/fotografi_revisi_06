<hr>
<?php 
include "../../../../assets/koneksi.php";
$b = $_GET['b'];
$ket_order = $_GET['ket_order'];

 ?><div class="box-header with-border">
  <h3 class="box-title">Pilih Pelanggan yang memesan</h3>

  <div class="box-tools pull-right">
    <!-- <a href="" class="btn btn-default btn-sm"  target="_blank">Print Data Paket</a> -->
    <a href="?a=tambah_pelanggan" class="btn btn-info">Pelanggan Baru</a>
  </div>
</div>


<?php 
  $q1=mysqli_query($conn, "SELECT * from pelanggan");
  $no=1;
 ?>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        
        <td>Nama</td>
        <td>Alamat</td>
        <td>No HP</td>
        <td>Email</td>
        <td>Register Via</td>
        <td>Option</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q1)) { 
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
   
    <td><?php echo $d1['nama_pelanggan'] ?></td>
    <td><?php echo $d1['alamat_pelanggan'] ?></td>
    <td><?php echo $d1['nohp_pelanggan'] ?></td>
    <td><?php echo $d1['email_pelanggan'] ?></td>
    <td><?php echo $d1['reg_via'] ?></td>
    <td>
      
      <a href="form/pesanan/konfirmasi.php?b=<?php echo $b ?>&id=<?php echo $d1['id_pelanggan'] ?>&ket_order=<?php echo $ket_order ?>" class="btn btn-info btn-xs" onclick="return confirm('Pesanan dilakukan oleh <?php echo $d1['nama_pelanggan'] ?>.?')">Pilih</a>
        
     
    </td>
  </tr>
  <?php } ?>
</table>