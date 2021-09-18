<div class="modal fade" id="addalbum" role="dialog">
    <form method="post" action="form/dashboard/addadmin.php"> 
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
                Penambahan Admin Baru
              </div>
              <div class="modal-body">
                <label>Nama Pengurus</label>
                <?php   
                  include "../connectdb.php";
                   $add="select * From pengurus ";
                    $p=mysqli_query($conn, $add);
                    $no =1;
    

                 ?>
                <select name="id_p" class=" form-control">
                <?php
                  while ($data=mysqli_fetch_array($p))
                  { 
                  $id=$data['id_pengurus'];
                  $nama=$data['nama'];
                  ?>
                <option value="<?php  echo $id; ?>"><?php   echo $nama; ?></option>
              <?php   } ?>
                </select>
                <br>  
                <label>Username</label>
                <input type="text" name="user" class="  form-control">
                <label>Password</label>
                <input type="password" name="pass" class="  form-control">

              </div>
              <div class="modal-footer">
                <input type="submit" value="Tambahkan Album" class="btn btn-info">
                <button data-dissmis="modal">Tutup</button>
              </div>
            </div>
          </div>
      </form>
    </div>