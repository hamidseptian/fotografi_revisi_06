<?php 
$id=$_GET['idj'];
$q = mysqli_query($conn, "SELECT * from paket where id_paket='$id'");
$q2 = mysqli_query($conn, "SELECT * from harga_cetak");
?>
<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
<h3>Detail Paket</h3>
</div>
<?php

$d = mysqli_fetch_array($q);
 if ($d['gambar']=='') {
          $gambar='../../assets/default_paket.jpg';
          # code...
        }else{
          $gambar='form/paket/gambar/'.$d['gambar'];
        }

          ?>
	

<div class="col-lg-6 col-sm-6">
	<div class="product-item">
		<div class="pi-pic">
			<?php if ($d['bisa_booking']=='Ya') { ?>
				<!-- <div class="tag-sale">System Booking</div> -->
			<?php } ?>
			<img src="<?php echo $gambar ?>" width="100%">
		</div>
	
	</div>
</div>
	






	<div class="col-lg-6 product-details">
		<form>
			
					<h2 class="p-title"><?php echo $d['nama_paket'] ?></h2>
					<h3 class="p-price">Rp. <?php echo number_format($d['biaya']) ?></h3>
					
					
					
					<h4 class="p-stock">Silahkan isi form booking dan cek ketersediaan</h4>
						<div class="form-group">							
							<label>Tanggal Acara</label>
							<input type="date" name="tglbook" class="form-control" required id="tglbook">
						</div>
						<div class="form-group">							
							<label>Jam Acara</label>
							<input type="time" name="tglbook" class="form-control" required id="jambook">
						</div>
						<div class="form-group">							
							<label>Jenis Pemotretan</label>
							<select class="form-control" required id="jenis">
								<option value="Studio">Studio</option>
								<option value="Outdoor">Outdoor</option>
							</select>
							<script type="text/javascript">
								$('#jenis').change(function(){
									var jenis=$('#jenis').val();
									// alert(jenis);
									if (jenis=='Outdoor') {
										$('#form_lokasi').attr('style','');
									}else{
										$('#form_lokasi').attr('style','display:none');
									}
								})
							</script>
						</div>
						<div class="form-group" id="form_lokasi" style="display: none">							
							<label>Lokasi Pemotretan</label>
							<input type="text" name="lokasi" class="form-control" required id="lokasi">
						</div>
						
						<div class="form-group">							
							<button type="button" class="btn btn-info" id="cekbooking">Cek Ketersediaan</button>
						</div>
                    
				
					
				
		</form>
				</div>


 <div class="clearfix"></div>
 <div class="col-lg-12 col-sm-12" style="margin-bottom: 30px">
	<div id="hasilbook"></div>
</div>


<script>
	$('#cekbooking').click(function(){
		var tglbook = $('#tglbook').val();
		var kegiatan = $('#kegiatan').val();
		var lama = $('#lama').val();
		var jambook = $('#jambook').val();
		var jenis = $('#jenis').val();
		var lokasi = $('#lokasi').val();

		if (tglbook=='') {
			alert("anda belum memilih tanggal kegiatan");
			return false
		}
		if (jambook=='') {
			alert("anda belum memilih waktu kegiatan");
			return false
		}
		if (jenis=='') {
			alert("anda belum mengisi jenis pemotretan");
			return false
		}
		if (jenis!='Studio' && lokasi=='') {
			alert("anda belum mengisi lokasi pemotretan");
			return false
		}

			$.ajax({
				url : "form/jasa/cek_booking.php",
				data: {
					'tglbook' : tglbook,
					'jambook' : jambook,
					'jenis_potret' : jenis,
					'lokasi' : lokasi,
					'lama' : '<?php echo $d['lama_potret'] ?>',
					'jenis_waktu' : '<?php echo $d['jenis_waktu'] ?>',
					'kegiatan' : kegiatan,
					'idpaket' : '<?php echo $id ?>'
				},
				type : 'POST',
				success : function(data){
					$('#hasilbook').html(data);
				},
				error : function(){
					alert('ajax cek booking error');
				}
			})
		
	})
</script>