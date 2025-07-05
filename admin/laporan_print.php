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
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Laporan Aplikasi Keuangan</title>
	<link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 20px;
		}

		.header-section {
			text-align: center;
			margin-bottom: 30px;
		}

		.header-section h2 {
			font-size: 18px;
			font-weight: bold;
			margin-bottom: 5px;
		}

		.header-section h3 {
			font-size: 15px;
			font-weight: bold;
			margin-bottom: 5px;
		}

		.header-section h4 {
			font-size: 11px;
			font-weight: bold;
			margin-bottom: 20px;
		}

		.info-table {
			margin-bottom: 20px;
		}

		.info-table th {
			font-weight: bold;
			font-size: 10px;
			padding: 3px 5px;
			text-align: left;
		}

		.info-table td {
			font-size: 10px;
			padding: 3px 5px;
			text-align: left;
		}

		.main-table {
			font-size: 10px;
			width: 100%;
		}

		.main-table th {
			background-color: #f8f9fa;
			font-weight: bold;
			text-align: center;
			vertical-align: middle;
			padding: 8px 4px;
			border: 1px solid #000;
		}

		.main-table td {
			text-align: center;
			vertical-align: middle;
			padding: 8px 4px;
			border: 1px solid #000;
			line-height: 1.3;
		}

		.bank-cell {
			text-align: center;
			font-size: 9px;
			line-height: 1.4;
		}

		.total-row th {
			background-color: #e9ecef;
			font-weight: bold;
		}

		.saldo-row th {
			background-color: #007bff;
			color: white;
			font-weight: bold;
		}

		.saldo-row td {
			background-color: #007bff;
			color: white;
			font-weight: bold;
		}

		.text-success {
			color: #28a745 !important;
		}

		.text-danger {
			color: #dc3545 !important;
		}

		@media print {
			body {
				margin: 0;
			}

			.no-print {
				display: none;
			}
		}
	</style>
</head>

<body>

	<div class="header-section">
		<h2>Majelis Perwakilan Khusus</h2>
		<h3>Yayasan Pelayanan Pekabaran Injil Indonesia Batu di Jakarta</h3>
		<h4>LAPORAN KEUANGAN</h4>
	</div>


	<?php
	include '../koneksi.php';
	if (isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari']) && isset($_GET['kategori'])) {
		$tgl_dari = $_GET['tanggal_dari'];
		$tgl_sampai = $_GET['tanggal_sampai'];
		$kategori = $_GET['kategori'];
	?>

		<div class="row">
			<div class="col-lg-4">
				<table class="info-table" style="width: auto;">
					<tr>
						<th style="width: 120px;">DARI TANGGAL</th>
						<th style="width: 10px;">:</th>
						<td><?php echo date('d-m-Y', strtotime($tgl_dari)); ?></td>
					</tr>
					<tr>
						<th style="width: 120px;">SAMPAI TANGGAL</th>
						<th style="width: 10px;">:</th>
						<td><?php echo date('d-m-Y', strtotime($tgl_sampai)); ?></td>
					</tr>
					<tr>
						<th style="width: 120px;">KATEGORI</th>
						<th style="width: 10px;">:</th>
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
			<table class="main-table table-bordered">
				<thead>
					<tr>
						<th width="3%" rowspan="2">NO</th>
						<th width="12%" rowspan="2">TANGGAL</th>
						<th width="15%" rowspan="2">KATEGORI</th>
						<th width="17%" rowspan="2">KETERANGAN</th>
						<th width="18%" rowspan="2">REKENING BANK</th>
						<th colspan="2">JENIS</th>
					</tr>
					<tr>
						<th width="17.5%">PEMASUKAN</th>
						<th width="17.5%">PENGELUARAN</th>
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
							<td><?php echo $no++; ?></td>
							<td><?php echo date('d-m-Y', strtotime($d['transaksi_tanggal'])); ?></td>
							<td><?php echo $d['kategori']; ?></td>
							<td><?php echo $d['transaksi_keterangan']; ?></td>
							<td class="bank-cell">
								<div><?php echo $d['bank_nama']; ?></div>
								<div><?php echo $d['bank_nomor']; ?></div>
								<div>a.n. <?php echo $d['bank_pemilik']; ?></div>
							</td>
							<td>
								<?php
								if ($d['transaksi_jenis'] == "Pemasukan") {
									echo "Rp. " . number_format($d['transaksi_nominal']) . " ,-";
								} else {
									echo "-";
								}
								?>
							</td>
							<td>
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
					<tr class="total-row">
						<th colspan="5">TOTAL</th>
						<td class="text-bold text-success"><?php echo "Rp. " . number_format($total_pemasukan) . " ,-"; ?></td>
						<td class="text-bold text-danger"><?php echo "Rp. " . number_format($total_pengeluaran) . " ,-"; ?></td>
					</tr>
					<tr class="saldo-row">
						<th colspan="5">SALDO</th>
						<td colspan="2" class="text-bold"><?php echo "Rp. " . number_format($total_pemasukan - $total_pengeluaran) . " ,-"; ?></td>
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