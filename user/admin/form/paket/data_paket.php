<?php 

 ?><div class="box-header with-border">
  <h3 class="box-title">Data  Paket</h3>

  <div class="box-tools pull-right">
    <!-- <a href="" class="btn btn-default btn-sm"  target="_blank">Print Data Harga Paket</a> -->
    <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#addpaket">Tambah   Paket</a>
  </div>
</div>
<form action="form/paket/simpan_paket.php" method="post" enctype="multipart/form-data">
<div class="modal fade" id="addpaket">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Harga Paket</h4>
              </div>
              <div class="modal-body">
              <div class="form-group">
                  <label>Nama Paket</label>
                  <input type="text" name="tipe" class="form-control">
              </div> 
              <div class="form-group">
                  <label>Lama Waktu Pemotretan</label>
                  <input type="number" name="lama" required class="form-control" style="margin:bottom:10px">
                  <div class="col-md-4"><input type="radio" name="jenis_waktu" value="Jam" required>Jam</div>
                  <div class="col-md-4"><input type="radio" name="jenis_waktu" value="Hari" required>Hari</div>
                  <div class="clearfix"></div>
              </div> 
              <div class="form-group">
                  <label>Paket Yang Ditawarkan</label>
                  <select class="form-control" name="level">
                  <?php 
                  $p = array('Silver','Gold','Platinum','Titanium');
                  foreach ($p as $pp) { ?>
                  <option value="<?php echo $pp ?>"><?php echo $pp ?></option>
                  <?php  } ?>
                    
                  </select>
              </div> 
              <div class="form-group">
                  <label>Biaya</label>
                  <input type="number" name="biaya" required class="form-control">
              </div> 
           
              <div class="form-group">
                  <label>Fasilitas</label>
                  <textarea name="fasilitas" required class="form-control"></textarea>
              </div> 

              <div class="form-group">
                  <label>Bisa di Booking</label>
                  <select class="form-control" name="book">
                  <?php 
                  $p = array('Ya','Tidak');
                  foreach ($p as $pp) { ?>
                  <option value="<?php echo $pp ?>"><?php echo $pp ?></option>
                  <?php  } ?>
                    
                  </select>
              </div> 
                 <div class="form-group">
                  <label>Gambar</label>
                  <input type="file" name="berkas" required >
              </div> 

        
              
             
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Data Harga Paket</button>
               
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
</form>


<hr>
<?php 
  $q1=mysqli_query($conn, "SELECT * from paket");
  $no=1;
 ?>

 <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td>No</td>
        <td>Thumbnail</td>
        <td>Nama Paket</td>
        <td>Lama Waktu Pemotretan</td>
        <td>Paket Yang Ditawarkan</td>
        <td>Fasilitas</td>
        <td>Biaya</td>
        <td>Bisa Di Booking</td>
        <td>Option</td>
      </tr>
    </thead>
  <?php 
  while ($d1=mysqli_fetch_array($q1)) { 
      if ($d1['gambar']=='') {
          $gambar='../../../../../assets/default_paket.jpg';
          # code...
        }else{
          $gambar=$d1['gambar'];
        } 
    ?>
  <tr>
    <td><?php echo $no++ ?></td>
    <td><img src="form/paket/gambar/<?php echo $gambar ?>" alt="<?php echo $gambar ?>" width="100px"></td>
    <td><?php echo $d1['nama_paket'] ?></td>
    <td><?php echo $d1['lama_potret'].' '.$d1['jenis_waktu'] ?></td>
    <td><?php echo $d1['level_paket'] ?></td>
    <td><?php echo $d1['fasilitas'] ?></td>
    <td><?php echo number_format($d1['biaya']) ?></td>
    <td><?php echo $d1['bisa_booking'] ?></td>
    <td>
      <a href="form/paket/hapus_paket.php?id=<?php echo $d1['id_paket'] ?>" class="btn btn-info btn-xs" onclick="return confirm('Apakah anda yakin.?')">Hapus</a>
      <a href="?a=edit_paket&id=<?php echo $d1['id_paket'] ?>" class="btn btn-info btn-xs">Edit</a>    
    </td>
  </tr>
  <?php } ?>
</table>