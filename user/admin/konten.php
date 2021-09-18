<?php 
$menu = $_GET['a'];
if ($menu=='') {
  include "form/dashboard/dashboard.php";
}
elseif ($menu=='edit-akun') {
  include "form/dashboard/edit_akun.php";
}
else if ($menu=='hcf'/*Harga cetak foto*/) {
  include "form/hcf/data_hcf.php";
}
else if ($menu=='paket'/*Harga paket foto*/) {
  include "form/paket/data_paket.php";
}
else if ($menu=='rekening'/*Harga rekening foto*/) {
  include "form/rekening/data_rekening.php";
}
else if ($menu=='edit_hc'/*Harga cetak foto*/) {
  include "form/hcf/edit_hcf.php";
}
else if ($menu=='edit_paket') {
  include "form/paket/edit_paket.php";
}
else if ($menu=='pesan_online') {
  include "form/pesanan/pesanan_online.php";
}
else if ($menu=='booking_online') {
  include "form/pesanan/booking_online.php";
}
else if ($menu=='daftar_booking') {
  include "form/pesanan/daftar_booking.php";
}
else if ($menu=='lap_cetak') {
  include "form/laporan/laporan_cetak_foto.php";
}
else if ($menu=='laporan') {
  include "form/laporan/laporan.php";
}
else if ($menu=='proses_cetak') {
  include "form/proses/list_order.php";
}
else if ($menu=='jadwal_booking') {
  include "form/proses/list_booking.php";
}
else if ($menu=='kalender_booking') {
  include "form/proses/kalender_booking.php";
}
else if ($menu=='new_order_cetak') {
  include "form/pesanan/new_order.php";
}
else if ($menu=='detail_cetak'){ 
  include "form/pesanan/det_cetak.php";
}
else if ($menu=='detail_paket'){ 
  include "form/jasa/det_jasa.php";
}

else if ($menu=='addbooking'){ 
  include "form/jasa/booking.php";
}
else if ($menu=='keranjang'){ 
  include "form/pesanan/keranjang.php";
}
else if ($menu=='detail_pesanan') {
  include "form/pesanan/detail_pesanan_online.php";
}
else if ($menu=='detail_pesanan_selesai') {
  include "form/selesai_proses/detail_pesanan_online_selesai.php";
}
else if ($menu=='detail_booking') {
  include "form/pesanan/detail_booking_online.php";
}
else if ($menu=='detail_order') {
  include "form/selesai_proses/detail_order.php";
}
else if ($menu=='detail_proses') {
  include "form/proses/detail_proses.php";
}
else if ($menu=='selesai_cetak') {
  include "form/selesai_proses/selesai_proses.php";
}
else if ($menu=='detail_pengambilan') {
  include "form/selesai_proses/detail_pengambilan.php";
}
else if ($menu=='booking_selesai') {
  include "form/selesai_proses/selesai_proses_booking.php";
}
else if ($menu=='detail_booking_selesai') {
  include "form/selesai_proses/detail_booking.php";
}
else if ($menu=='edit_rekening') {
  include "form/rekening/edit_rekening.php";
}
else if ($menu=='galeri') {
  include "form/galeri/data_galeri.php";
}
else if ($menu=='pelanggan') {
  include "form/pelanggan/data_pelanggan.php";
}
else if ($menu=='tambah_pelanggan') {
  include "form/pelanggan/tambah_pelanggan.php";
}
else{
	echo "Fitur ini belum tersedia";
}
 ?>
