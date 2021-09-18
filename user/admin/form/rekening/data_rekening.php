<div class="box-header with-border">
  <h3 class="box-title">Data Rekening</h3>

  <div class="box-tools pull-right">
    <!-- <a href="" class="btn btn-default btn-sm"  target="_blank">Print Data Paket</a> -->
    <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#addballroom">Tambah Rekening</a>
  </div>
</div>

<form action="form/rekening/simpan_rekening.php" method="post" enctype="multipart/form-data">
<div class="modal fade" id="addballroom">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Rekening</h4>
              </div>
              <div class="modal-body">
              <div class="form-group">
                  <label>Bank</label>
                  <input type="text" name="bank" class="form-control">
              </div> 
              
              <div class="form-group">
                  <label>Kode Bank</label>
                  <input type="text" name="kodebank" required class="form-control">
              </div> 
              <div class="form-group">
                  <label>No Rekening</label>
                  <input type="text" name="rekening" required class="form-control" >
              </div> 
              <div class="form-group">
                  <label>Nama Rekening</label>
                  <input type="text" name="nama" required class="form-control" >
              </div> 
              
             
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah data yang anda masukan sudah benar.?')">Simpan Data Rekening</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>


<hr>
<?php 
  $q1=mysqli_query($conn, "SELECT * from rekening");
  $no=1;
 ?>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        
        <td>Bank</td>
        <td>Kode Bank</td>
        <td>No Rekening</td>
        <td>Nama Rekening</td>
       
        <td>Option</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q1)) { 
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
   
  
    <td><?php echo $d1['namabank'] ?></td>
   
    <td><?php echo $d1['kodebank'] ?></td>
    <td><?php echo $d1['no_rek'] ?></td>
    <td><?php echo $d1['namarekening'] ?></td>
    
    <td>
      <a href="form/rekening/hapus_rekening.php?id=<?php echo $d1['id_rekening'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin.?')">Hapus</a>
      <a href="?a=edit_rekening&id=<?php echo $d1['id_rekening'] ?>" class="btn btn-warning btn-xs">Edit</a>    
    </td>
  </tr>
  <?php } ?>
</table>