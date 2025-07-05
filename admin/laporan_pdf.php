<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Check authentication
if (!isset($_SESSION['status']) || ($_SESSION['status'] != "administrator_logedin" && $_SESSION['status'] != "manajemen_logedin")) {
  header("location:../index.php?alert=belum_login");
  exit();
}

// memanggil library FPDF
require('../library/fpdf181/fpdf.php');


include '../koneksi.php';
$tgl_dari = $_GET['tanggal_dari'];
$tgl_sampai = $_GET['tanggal_sampai'];

// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 18);
// mencetak string 
$pdf->Cell(280, 7, 'Majelis Perwakilan Khusus', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(280, 7, 'Yayasan Pelayanan Pekabaran Injil Indonesia Batu di Jakarta', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(280, 7, 'LAPORAN KEUANGAN', 0, 1, 'C');
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(35, 6, 'DARI TANGGAL', 0, 0);
$pdf->Cell(5, 6, ':', 0, 0);
$pdf->Cell(35, 6, date('d-m-Y', strtotime($tgl_dari)), 0, 0);
$pdf->Cell(10, 7, '', 0, 1);
$pdf->Cell(35, 6, 'SAMPAI TANGGAL', 0, 0);
$pdf->Cell(5, 6, ':', 0, 0);
$pdf->Cell(35, 6, date('d-m-Y', strtotime($tgl_sampai)), 0, 0);
$pdf->Cell(10, 7, '', 0, 1);
$pdf->Cell(35, 6, 'KATEGORI', 0, 0);
$pdf->Cell(5, 6, ':', 0, 0);
$kategori = $_GET['kategori'];
if ($kategori == "semua") {
  $kkk = "SEMUA KATEGORI";
} else {
  $k = mysqli_query($koneksi, "select * from kategori where kategori_id='$kategori'");
  $kk = mysqli_fetch_assoc($k);
  $kkk = $kk['kategori'];
}
$pdf->Cell(35, 6, $kkk, 0, 0);


$pdf->Cell(10, 10, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(10, 14, 'NO', 1, 0, 'C');
$pdf->Cell(35, 14, 'TANGGAL', 1, 0, 'C');
$pdf->Cell(45, 14, 'KATEGORI', 1, 0, 'C');
$pdf->Cell(50, 14, 'KETERANGAN', 1, 0, 'C');
$pdf->Cell(51, 14, 'REKENING BANK', 1, 0, 'C');
$pdf->Cell(86, 7, 'JENIS', 1, 1, 'C'); // End the row here

$pdf->Cell(191, 0, '', 0, 0); // 10+35+45+50+51=191
$pdf->Cell(43, 7, 'PEMASUKAN', 1, 0, 'C');
$pdf->Cell(43, 7, 'PENGELUARAN', 1, 1, 'C');

$pdf->Cell(10, 0, '', 0, 1);




$pdf->SetFont('Arial', '', 10);

$no = 1;
$total_pemasukan = 0;
$total_pengeluaran = 0;
if ($kategori == "semua") {
  $data = mysqli_query($koneksi, "SELECT transaksi.*, kategori.kategori, bank.* FROM transaksi
    JOIN kategori ON kategori.kategori_id=transaksi.transaksi_kategori
    JOIN bank ON bank.bank_id=transaksi.transaksi_bank
    WHERE date(transaksi_tanggal)>='$tgl_dari' and date(transaksi_tanggal)<='$tgl_sampai'");
} else {
  $data = mysqli_query($koneksi, "SELECT transaksi.*, kategori.kategori, bank.* FROM transaksi
    JOIN kategori ON kategori.kategori_id=transaksi.transaksi_kategori
    JOIN bank ON bank.bank_id=transaksi.transaksi_bank
    WHERE kategori.kategori_id='$kategori' and date(transaksi_tanggal)>='$tgl_dari' and date(transaksi_tanggal)<='$tgl_sampai'");
}
while ($d = mysqli_fetch_array($data)) {

  if ($d['transaksi_jenis'] == "Pemasukan") {
    $total_pemasukan += $d['transaksi_nominal'];
  } elseif ($d['transaksi_jenis'] == "Pengeluaran") {
    $total_pengeluaran += $d['transaksi_nominal'];
  }

  $pdf->Cell(10, 21, $no++, 1, 0, 'C');
  $pdf->Cell(35, 21, date('d-m-Y', strtotime($d['transaksi_tanggal'])), 1, 0, 'C');
  $pdf->Cell(45, 21, $d['kategori'], 1, 0, 'C');
  $pdf->Cell(50, 21, $d['transaksi_keterangan'], 1, 0, 'C');

  // Multi-line bank information
  $x = $pdf->GetX();
  $y = $pdf->GetY();

  // Draw the border for bank cell
  $pdf->Rect($x, $y, 51, 21);

  // Bank name
  $pdf->SetXY($x + 1, $y + 2);
  $pdf->Cell(49, 5, $d['bank_nama'], 0, 0, 'C');

  // Bank number
  $pdf->SetXY($x + 1, $y + 8);
  $pdf->Cell(49, 5, $d['bank_nomor'], 0, 0, 'C');

  // Account holder
  $pdf->SetXY($x + 1, $y + 14);
  $pdf->Cell(49, 5, "a.n. " . $d['bank_pemilik'], 0, 0, 'C');

  // Move to next column
  $pdf->SetXY($x + 51, $y);

  if ($d['transaksi_jenis'] == "Pemasukan") {
    $pem = "Rp. " . number_format($d['transaksi_nominal']) . " ,-";
  } else {
    $pem = "-";
  }

  if ($d['transaksi_jenis'] == "Pengeluaran") {
    $peng = "Rp. " . number_format($d['transaksi_nominal']) . " ,-";
  } else {
    $peng = "-";
  }

  $pdf->Cell(43, 21, $pem, 1, 0, 'C');
  $pdf->Cell(43, 21, $peng, 1, 1, 'C');

  $pdf->Cell(10, 0, '', 0, 1);
}

$pdf->Cell(191, 7, "TOTAL", 1, 0, 'R'); // 10+35+45+50+51=191
$pdf->Cell(43, 7, "Rp. " . number_format($total_pemasukan) . " ,-", 1, 0, 'C');
$pdf->Cell(43, 7, "Rp. " . number_format($total_pengeluaran) . " ,-", 1, 1, 'C');

$pdf->Cell(191, 7, "SALDO", 1, 0, 'R');
$pdf->Cell(86, 7, "Rp. " . number_format($total_pemasukan - $total_pengeluaran) . " ,-", 1, 1, 'C');





$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->SetFont('Arial', '', 10);


$pdf->Output();
