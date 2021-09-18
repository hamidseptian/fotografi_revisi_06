
<?php 
include "../../../assets/koneksi.php";
$tglbook =$_POST['tglbook'];
$id =$_POST['idpaket'];
$lama =$_POST['lama'] -1;
$jambook =$_POST['jambook'];
$kegiatan =$_POST['kegiatan'];
$qcek = mysqli_query($conn, "SELECT min(tanggal_mulai) as tglawal, max(tanggal_selesai) as tglakhir from booking where status in ('Berlangsung','Dalam Proses','Order')");
 // where status='Booking' or status='Berlangsung'
$dcek = mysqli_fetch_array($qcek);
$tglawal =  $dcek['tglawal'];
$akhir =  $dcek['tglakhir'];
$sesudah = date('Y-m-d', strtotime("+".$lama." days", strtotime($tglbook)));
echo 'Mulai  : '.$tglbook.'<br>';
echo 'Selesai  : '.$sesudah.'<br>';

$q = mysqli_query($conn, "SELECT * from booking where tanggal_mulai >= '$tglawal' and tanggal_selesai <= '$akhir' and status in ('Berlangsung','Dalam Proses','Order')");
$j = mysqli_num_rows($q);
?>
<h4>Bookingan Tanggal <?php echo $tglbook ?></h4>

<table class="table table-striped table-bordered">
    <tr>
        <td>No</td>
        <td>Kegiatan</td>
        <td>Lama Kegiatan</td>
        <td>Waktu Mulai Acara</td>
        <td>Waktu Selesai Acara</td>
    </tr>
    <?php  
    $no = 0;
    $order = 0;
     while ($d=mysqli_fetch_array($q)) { 
     	if ($tglbook >= $d['tanggal_mulai'] && $sesudah <= $d['tanggal_selesai']) {
     		$style="";	
	     	$order +=1;
	     	$no++;
     	}else{
     		$style="style='display:none'";	
     		
     	}
     	?>
        <tr <?php // echo $style ?>>
            <td><?php echo 	$no ?></td>
            <td><?php echo 	$d['kegiatan'] ?></td>
            <td><?php echo 	$d['lama_acara'] ?> Hari</td>
            <td><?php echo 	$d['tanggal_mulai'] ?></td>
            <td><?php echo 	$d['tanggal_selesai'] ?></td>
        </tr>

            
    <?php } ?>
</table>

<?php if ($order>3) { ?>
	Tidak bisa melakukan booking karena jadwal fotografer full
<?php 	}else{ ?>
<a href="?m=addbooking&tgl=<?php echo $tglbook ?>&idj=<?php echo $id ?>&k=<?php echo $kegiatan ?>&lama=<?php echo $lama ?>&jambook=<?php echo $jambook ?>&tgl_selesai=<?php echo  $sesudah ?>" class="btn btn-info btn-xs">Booking</a>

<?php 	} ?>
    
