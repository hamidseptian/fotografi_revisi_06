<?php 

include "../../../../assets/koneksi.php"; 
$id=$_GET['idc'];
echo $id;
$q = mysqli_query($conn, "SELECT * from harga_cetak where id_hc='$id'");
$q2 = mysqli_query($conn, "SELECT * from harga_cetak");



$qedit = mysqli_query($conn, "SELECT * from harga_edit");
$edit = array();
$data['id'] = '';
$data['nama'] = 'Tanpa Edit';
$data['harga'] = '0';
array_push($edit, $data);

while ($dedit = mysqli_fetch_array($qedit)) {
    $data['id'] = $dedit['id_he'];
    $data['nama'] = $dedit['nama_edit'];
    $data['harga'] = $dedit['harga_edit'];
    array_push($edit, $data);
}


?>

<?php

$d = mysqli_fetch_array($q)  ?>
  


  







  

          
  
         
         Silahkan masukkan orderan
          <form action="form/pesanan/simpan_order_cetak.php" method="post" enctype="multipart/form-data">
          
          <div class="form-group">
    
          </div>
          <div class="form-group">
            <label>jumlah Cetak</label><br>
                        <input type="" name="idc" value="<?php echo $id ?>">
                        <input type="text" name="jml" size="5" required  placeholder="Jumlah Cetak" class="form-control">
          </div>
          <div class="form-group">
            <label>Edit Foto</label><br>
                               <select name="edit" class="form-control">
                            <?php foreach ($edit as $d) { ?>
                                <option value="<?php echo $d['id'] ?>"><?php echo $d['nama'].' - '.$d['harga'] ?></option>
                            <?php } ?>
                        </select>
          </div>
          <div class="form-group">
            <input type="checkbox" name="wf" id="wf"> Order dengan frame
          </div>
          <div class="form-group">
            
                        <input type="submit" class="btn btn-info" value="Masukan ke keranjang">
          </div>
             
          </form>
         
          
        
        </div>




<script>
$('#wf').change(function(){

  var wf = $('#wf').is(':checked');
  if (wf==true) {
    $('#wf').val('Ya');
  }else{
    $('#wf').val('Tidak');

  }

})

</script>