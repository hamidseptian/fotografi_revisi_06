<?php  
$q1=mysqli_query($conn, "SELECT * from kelurahan"); ?>

 <h2>Daftar Akun Pelanggan</h2>
 <hr>
         <div class="col-md-12 log">          
                 <form action="form/register/simpan_pelanggan.php" method="post">
                     <h5>Nama</h5>    
                     <input type="text" value="" name="nama">
                    <h5>Domisili</h5>    
                     <select name="idkel">
                        <?php while($d1=mysqli_fetch_array($q1)){ ?>
                         <option value="<?php echo $d1['id_kelurahan'] ?>"><?php echo $d1['nama_kelurahan'] ?></option>
                         <?php } ?>
                     </select>
                     <h5>Alamat</h5>    
                     <input type="text" value="" name="alm">
                     <h5>No HP</h5>    
                     <input type="text" value="" name="hp">
                    
                     <h5>Email</h5>    
                     <input type="email" value="" name="email">
                     <h5>Password</h5>
                     <input type="password" value="" name="password">                   
                     <input type="submit" value="Daftar">
                     
                 </form>                 
         </div>
          
         <div class="clearfix"></div>