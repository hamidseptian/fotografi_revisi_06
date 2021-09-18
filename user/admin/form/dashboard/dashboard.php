<?php 
  $idus= $_SESSION['id_admin'];
  $level= $_SESSION['level'];
 
  $prt=mysqli_query($conn, "SELECT * from admin where id='$idus'")or die("salah");
  $data=mysqli_fetch_array($prt);
  $namauser=$data['nama_admin'];

 ?>

<div class="col-md-12">

<div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h5 class="widget-user-desc">Selamat datang di halaman administrator <br> Sistem informasi Jasa Fotografi</h5>
              <h3 class="widget-user-username"><?php echo $namauser ?> - <?php echo $level ?></h3>
            </div>
           <!--  <div class="widget-user-image">
              
              <img class="" src="../admin/images/user.jpg" alt="User Avatar">
            </div> -->
            <div class="box-footer">







    
      







   
              <!-- /.row -->
            </div>
          </div>

    </div>