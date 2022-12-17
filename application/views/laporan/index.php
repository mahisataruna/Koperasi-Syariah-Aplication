<!-- Mulai Main Content -->
<div class="container-fluid">


	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb" class="main-breadcrumb">
		<ol class="breadcrumb shadow mb-4 bg-white">
			<li class="breadcrumb-item"><a href="<?= base_url('user'); ?>">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
		</ol>
	</nav>
	<!-- /Breadcrumb -->
	<!-- Mulai Card -->
	<div class="row">
		<div class="col-lg col-md col-sm">
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardLaporan" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Cetak Laporan</h6>
				</a>

				<!-- Card Content - Collapse -->
				<div class="collapse show" id="collapseCardLaporan">
					<div class="col-sm-12 mx-auto">
						<div class="card-body">
							<div class="col-sm">
								<div class="row">	
									<form action="<?= base_url('dom_pdf/cetak_laporan'); ?>" method="post">
										<div class="ol-sm-auto p-1 my-md-1">
											<label>	
												<select class="form-control sm" id="jenis_laporan" name="jenis_laporan">
													<option value="">--Pilih Laporan--</option>
													<option value="data_anggota">Laporan Data Anggota</option>
													<option value="data_simpanan_pokok">Laporan Simpanan Pokok Anggota</option>
													<option value="data_simpanan_wajib">Laporan Simpanan Wajib Anggota</option>
													<option value="data_pinjaman">Laporan Pinjaman Anggota</option>
													<option value="angsuran">Laporan Angsuran Anggota</option>
													<option value="infaq">Laporan Infaq Anggota</option>
													<option value="bghasil">Laporan Bagi Hasil Usaha</option>
												</select>
											</label>	
											<label>
												<select class="form-control sm-auto" id="bulan" name="bulan">
													<option value="">--Pilih Bulan--</option>
													<?=
													include 'koneksi.php';
													$query = "SELECT month(tanggal) AS bulan FROM tb_simpanan GROUP BY month(tanggal)";
													$sql = mysqli_query($koneksi, $query);
													while ($data = mysqli_fetch_array($sql)){
														echo '<option value="'.$data['bulan'].'">'.$data['bulan'].
														
														//if ($data['bulan'] == '03') {
														//	echo "Maret";
														//} // DISINI MASIH ERROR
														
														'</option>';
													}
													?>
													
												</select>
											</label>
											<label>
												<select class="form-control sm-auto" id="tahun" name="tahun">
													<option value="">--Pilih Tahun--</option>
													<?=
													include 'koneksi.php';
													$query = "SELECT year(tanggal) AS tahun FROM tb_simpanan GROUP BY year(tanggal)";
													$sql = mysqli_query($koneksi, $query);
													while ($data = mysqli_fetch_array($sql)){
														echo '<option value="'.$data['tahun'].'">'
														.$data['tahun'].
														'</option>';
													}
													?>
													
												</select>
											</label>
											<label>
												<button type="submit" name="cari" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-print fa-sm"></i>&nbsp;Cetak</button>
											</label>
										</div>
									</form>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End card simpanan Koperasi -->

		</div>

	</div>	
	<!-- End Card -->

</div>

</div>