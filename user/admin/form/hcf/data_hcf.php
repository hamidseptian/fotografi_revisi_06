<?php 

 ?><div class="box-header with-border">
  <h3 class="box-title">Data Harga Cetak</h3>

  <div class="box-tools pull-right">
    <!-- <a href="" class="btn btn-default btn-sm"  target="_blank">Print Data Harga Cetak</a> -->
    <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#addhc">Tambah  Harga Cetak</a>
  </div>
</div>

<form action="form/hcf/simpan_hcf.php" method="post" enctype="multipart/form-data">
<div class="modal fade" id="addhc">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Harga Cetak</h4>
              </div>
              <div class="modal-body">
              <div class="form-group">
                  <label>Ukuran</label>
                  <input type="text" name="ukuran" class="form-control">
              </div> 
              <div class="form-group">
                  <label>Keterangan</label>
                  <input type="text" name="ket" required class="form-control" maxlength="3">
              </div> 
              <div class="form-group">
                  <label>Harga Tanpa Frame</label>
                  <input type="number" name="htf" required class="form-control" maxlength="3">
              </div> 
              <div class="form-group">
                  <label>Harga Dengan Frame</label>
                  <input type="number" name="hdf" required class="form-control" maxlength="3">
              </div> 
        
              
             
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah data yang anda masukan sudah benar.?')">Simpan Data Harga Cetak</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>


<hr>
<?php 
  $q1=mysqli_query($conn, "SELECT * from harga_cetak");
  $no=1;
 ?>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        <td>Ukuran</td>
        <td>Keterangan</td>
        <td>Harga tanpa frame</td>
        <td>Harga dengan frame</td>
        <td>Option</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q1)) { 
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
    <td><?php echo $d1['ukuran'] ?></td>
    <td><?php echo $d1['keterangan'] ?></td>
    <td><?php echo number_format($d1['tanpa_frame']) ?></td>
    <td><?php echo number_format($d1['dengan_frame']) ?></td>
    <td>
      <a href="form/hcf/hapus_hcf.php?id=<?php echo $d1['id_hc'] ?>" class="btn btn-info btn-xs" onclick="return confirm('Apakah anda yakin.?')">Hapus</a>
      <a href="?a=edit_hc&id=<?php echo $d1['id_hc'] ?>" class="btn btn-info btn-xs">Edit</a>    
    </td>
  </tr>
  <?php } ?>
</table>