
<?php 
include "../../../../assets/koneksi.php";
$tglbook =$_POST['tglbook'];
$id =$_POST['idpaket'];
$lama =$_POST['lama'];
$jenis_waktu =$_POST['jenis_waktu'];
$jambook =$_POST['jambook'];

$jenis_potret =$_POST['jenis_potret'];
$lokasi =$_POST['lokasi'];

$qcek = mysqli_query($conn, "SELECT min(tanggal_mulai) as tglawal, max(tanggal_selesai) as tglakhir from booking ");
 // where status='Booking' or status='Berlangsung'
// where status in ('Berlangsung','Dalam Proses','Order')
$dcek = mysqli_fetch_array($qcek);
$tglawal =  $dcek['tglawal'];
$akhir =  $dcek['tglakhir'];

if ($jenis_waktu=="Hari") {
    $sesudah = date('Y-m-d', strtotime("+".$lama." days", strtotime($tglbook)));
    # code...
}else{
    $pj = explode(':', $jambook);
    $jam_selesai =($pj[0] + $lama).":".$pj[1];
    $sesudah = $tglbook.' '.$jam_selesai;

}
$tgl_booking = $tglbook.' '.$jambook.'';     
echo 'Mulai  : '.$tgl_booking.'<br>';
echo 'Selesai  : '.$sesudah.'<br>';


$q = mysqli_query($conn, "SELECT * from booking b left join paket p on b.id_paket= p.id_paket where b.tanggal_mulai >= '$tglawal' and b. tanggal_selesai <= '$akhir' and status in ('Berlangsung','Dalam Proses','Order')");

$nilai = 0; ?>

<h4> Bookingan Tanggal <?php echo $tglbook ?></h4>
<table class="table table-striped table-bordered">
    <tr>
        <td>No</td>
        <td>Paket</td>
        <td>Pemotretan</td>
        <td>Waktu Mulai Pemotretan</td>
        <td>Waktu Selesai Pemotretan</td>
    </tr>
    <?php
    $no = 0;
    $order =0;

                       
    while ($d=mysqli_fetch_array($q)) {
        $pwm = explode(' ', $d['tanggal_mulai']);
        $pws = explode(' ', $d['tanggal_selesai']);
      
        if (strtotime($tgl_booking) >= strtotime($d['tanggal_mulai']) && strtotime($tgl_booking) <= strtotime($d['tanggal_selesai']) ) {
            $nilai = 1;
            $style="";  
            $order +=1;
            $no++;
            // echo 'Jalan';
        }else{
            $style="style='display:none'";  
            
        }?>
        <tr <?php  echo $style ?>>
            
            <td><?php echo  $no ?></td>
            <td><?php echo  $d['nama_paket'].' '.$d['level_paket'] ?></td>
            <td><?php echo  $d['jenis_pemotretan'].'<br>'.$d['lokasi'] ?></td>
            <td><?php echo  $d['tanggal_mulai'] ?></td>
            <td><?php echo  $d['tanggal_selesai'] ?></td>
        </tr>

    <?php } ?>
</table>

<?php if ($order>=1) { ?>
	Tidak bisa melakukan booking karena jadwal fotografer full
<?php 	}else{ ?>
<a href="?a=addbooking&tgl=<?php echo $tglbook ?>&idj=<?php echo $id ?>&jenis=<?php echo $jenis_potret ?>&lokasi=<?php echo $lokasi ?>&lama=<?php echo $lama ?>&jambook=<?php echo $jambook ?>&tgl_selesai=<?php echo  $sesudah ?>" class="btn btn-info btn-xs">Booking</a>

<?php 	} ?>
    
