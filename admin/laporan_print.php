<?php
if ($_SESSION['status'] != "administrator_logedin") {
	header("location:../index.php?alert=belum_login");
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Laporan Aplikasi Keuangan</title>
	<link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">

</head>

<body>

	<center>
		<h2>Majelis Perwakilan Khusus</h2>
		<h3>Yayasan Pelayanan Pekabaran Injil Indonesia Batu di Jakarta</h3>
		<h4>LAPORAN KEUANGAN</h4>
	</center>


	<?php
	include '../koneksi.php';
	if (isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari']) && isset($_GET['kategori'])) {
		$tgl_dari = $_GET['tanggal_dari'];
		$tgl_sampai = $_GET['tanggal_sampai'];
		$kategori = $_GET['kategori'];
	?>

		<div class="row">
			<div class="col-lg-6">
				<table class="table table-bordered">
					<tr>
						<th width="30%">DARI TANGGAL</th>
						<th width="1%">:</th>
						<td><?php echo date('d-m-Y', strtotime($tgl_dari)); ?></td>
					</tr>
					<tr>
						<th>SAMPAI TANGGAL</th>
						<th>:</th>
						<td><?php echo date('d-m-Y', strtotime($tgl_sampai)); ?></td>
					</tr>
					<tr>
						<th>KATEGORI</th>
						<th>:</th>
						<td>
							<?php
							if ($kategori == "semua") {
								echo "SEMUA KATEGORI";
							} else {
								$k = mysqli_query($koneksi, "select * from kategori where kategori_id='$kategori'");
								$kk = mysqli_fetch_assoc($k);
								echo $kk['kategori'];
							}
							?>

						</td>
					</tr>
				</table>

			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th width="1%" rowspan="2">NO</th>
						<th width="10%" rowspan="2" class="text-center">TANGGAL</th>
						<th rowspan="2" class="text-center">KATEGORI</th>
						<th rowspan="2" class="text-center">KETERANGAN</th>
						<th rowspan="2" class="text-center">REKENING</th> <!-- Add this line -->
						<th colspan="2" class="text-center">JENIS</th>
					</tr>
					<tr>
						<th class="text-center">PEMASUKAN</th>
						<th class="text-center">PENGELUARAN</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$no = 1;
					$total_pemasukan = 0;
					$total_pengeluaran = 0;
					if ($kategori == "semua") {
						$data = mysqli_query($koneksi, "SELECT transaksi.*, kategori.kategori, bank.* FROM transaksi
    JOIN kategori ON kategori.kategori_id=transaksi.transaksi_kategori
    JOIN bank ON bank.bank_id=transaksi.transaksi_bank
    WHERE date(transaksi_tanggal)>='$tgl_dari' AND date(transaksi_tanggal)<='$tgl_sampai'");
					} else {
						$data = mysqli_query($koneksi, "SELECT transaksi.*, kategori.kategori, bank.* FROM transaksi
    JOIN kategori ON kategori.kategori_id=transaksi.transaksi_kategori
    JOIN bank ON bank.bank_id=transaksi.transaksi_bank
    WHERE kategori.kategori_id='$kategori' AND date(transaksi_tanggal)>='$tgl_dari' AND date(transaksi_tanggal)<='$tgl_sampai'");
					}
					while ($d = mysqli_fetch_array($data)) {

						if ($d['transaksi_jenis'] == "Pemasukan") {
							$total_pemasukan += $d['transaksi_nominal'];
						} elseif ($d['transaksi_jenis'] == "Pengeluaran") {
							$total_pengeluaran += $d['transaksi_nominal'];
						}
					?>
						<tr>
							<td class="text-center"><?php echo $no++; ?></td>
							<td class="text-center"><?php echo date('d-m-Y', strtotime($d['transaksi_tanggal'])); ?></td>
							<td><?php echo $d['kategori']; ?></td>
							<td><?php echo $d['transaksi_keterangan']; ?></td>
							<td><?php echo $d['bank_nama']; ?> <br> <?php echo $d['bank_nomor']; ?> <br> a.n. <?php echo $d['bank_pemilik']; ?></td> <!-- Add this line -->
							<td class="text-center">
								<?php
								if ($d['transaksi_jenis'] == "Pemasukan") {
									echo "Rp. " . number_format($d['transaksi_nominal']) . " ,-";
								} else {
									echo "-";
								}
								?>
							</td>
							<td class="text-center">
								<?php
								if ($d['transaksi_jenis'] == "Pengeluaran") {
									echo "Rp. " . number_format($d['transaksi_nominal']) . " ,-";
								} else {
									echo "-";
								}
								?>
							</td>
						</tr>
					<?php
					}
					?>
					<tr>
						<th colspan="5" class="text-right">TOTAL</th> <!-- was 4 -->
						<td class="text-center text-bold text-success"><?php echo "Rp. " . number_format($total_pemasukan) . " ,-"; ?></td>
						<td class="text-center text-bold text-danger"><?php echo "Rp. " . number_format($total_pengeluaran) . " ,-"; ?></td>
					</tr>
					<tr>
						<th colspan="5" class="text-right">SALDO</th> <!-- was 4 -->
						<td colspan="2" class="text-center text-bold text-white bg-primary"><?php echo "Rp. " . number_format($total_pemasukan - $total_pengeluaran) . " ,-"; ?></td>
					</tr>
				</tbody>
			</table>



		</div>

	<?php
	} else {
	?>

		<div class="alert alert-info text-center">
			Silahkan Filter Laporan Terlebih Dulu.
		</div>

	<?php
	}
	?>


	<script>
		window.print();
	</script>

</body>

</html>