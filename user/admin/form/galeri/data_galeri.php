<div class="box-header with-border">
  <h3 class="box-title">Data Galeri</h3>

  <div class="box-tools pull-right">
    <!-- <a href="" class="btn btn-default btn-sm"  target="_blank">Print Data Paket</a> -->
    <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#addballroom">Tambah Foto</a>
  </div>
</div>

<form action="form/galeri/save_galeri.php" method="post" enctype="multipart/form-data">
<div class="modal fade" id="addballroom">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Foto</h4>
              </div>
              <div class="modal-body">
              <div class="form-group">
                  <label>File</label>
                  <input type="file" name="gambar[]"  multiple>
              </div> 
              
           
             
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="reset" class="btn btn-primary" >Clear</button>
                <button type="submit" class="btn btn-primary" >Simpan Foto</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>

<form action="form/galeri/hapus_multiple.php" method="post" enctype="multipart/form-data">
<hr>
<?php 
  $q1=mysqli_query($conn, "SELECT * from galeri");
  $no=1;
  $j1 = mysqli_num_rows($q1);
 ?>


  <?php 
  while ($d1=mysqli_fetch_array($q1)) { 
    ?>
    <div class="col-md-4" style="margin-bottom:20px">
      <img src="form/galeri/gambar/<?php echo $d1['foto'] ?>" width="100%">
      <input type="checkbox" name="idfoto[]" value="<?php echo $d1['id_galeri'] ?>">
    </div>


  <?php } ?>
  <div class="clearfix"></div>
  <?php if ($j1>0) { ?>
  <button class="btn btn-info" onclick="return confirm('Hapus foto terpilih.?')">Hapus Foto Terpilih</button>
    
  <?php } ?>
</form>
