<?php 
    include "connectdb.php";
          $nama=$_POST['cari'];
          $perintah = "select * from kegiatan where namakegiatan like '%$nama%' and status='Telah Dilaksanakan'" ;
          $no=1;
          $jalan = mysqli_query($conn, $perintah);
         $jumlahdata=mysqli_num_rows($jalan);



if ($jumlahdata == 0) {
 echo "<h2>Pencarian data anak asuh  dengan keyword <a style='color:blue;'>";
 echo $nama;
 echo "</a> Tidak Ditemukan </h2>";
}

else{
  if (isset($nama)) {
    ?>




<h2>Hasil Pencarian <a style="color:blue;"><?php echo $nama; ?></a> </h2>

 <table class="table table-striped table-bordered">
    <thead style="background-color: #08088A;" >
      <tr>
        <th style="width:5%">No</th>
        <th>Nama Kegiatan</th>
        <th>Lokasi Kegiatan</th>  
        <th>Pelaksana</th>
        <th>Waktu Pelaksana</th>
      
        <th style="width:15%">Option</th>
          

      </tr>
    </thead>
      <tbody> 
          <?php   

          while ($data=mysqli_fetch_array($jalan))
{ 
$id=$data['id_kegiatan'];
$nmk=$data['namakegiatan'];
$plk=$data['pelaksana'];
$alm=$data['alamatkegiatan'];
$tgl=$data['tanggal'];
$pisah=explode("-", $tgl);
$tg=$pisah[2];
$bl=$pisah[1];
if ($bl==1) {
  $txbl="January";
}
elseif ($bl==2) {
  $txbl="February";
}
elseif ($bl==3) {
  $txbl="Maret";
}
elseif ($bl==4) {
  $txbl="April";
}
elseif ($bl==5) {
  $txbl="Mei";
}
elseif ($bl==6) {
  $txbl="Juni";
}
elseif ($bl==7) {
  $txbl="Juli";
}
elseif ($bl==8) {
  $txbl="Agustus";
}
elseif ($bl==9) {
  $txbl="September";
}
elseif ($bl==10) {
  $txbl="Oktober";
}
elseif ($bl==11) {
  $txbl="November";
}
elseif ($bl==12) {
  $txbl="Desember";
}
$th=$pisah[0];
$wk=$data['waktu'];
           ?>



      <tr>
        <td><?php echo $no++;?></td>
        <td><?php echo $nmk; ?></td>
        <td><?php echo $alm; ?></td>
        
        <td><?php echo $plk; ?></td>
        <td><?php echo $tg." ".$txbl." ".$th." / Jam ".$wk; ?></td>
        <td>
         <a href="?m=lihatalbum&id=<?php echo $id; ?>" class="btn btn-warning btn-xs">Lihat Album Foto</a>
         </td>
        </tr>
      <?php } ?>
    </tbody>



      </tbody>

</table>

<label>Jumlah Data yang ditemukan dengan keyword  <a style="color:blue;"><?php echo $nama; ?></a> adalah : <?php echo $jumlahdata; ?> Data</label>
<a href="index.php?m=wargapanti" class="btn btn-primary btn-xs" style="float:right;"><label>Kembali </label></a>
<?php
  }
}
?>