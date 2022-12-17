<div class="container-fluid">

	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb" class="main-breadcrumb">
		<ol class="breadcrumb shadow mb-4 bg-white">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
		</ol>
	</nav>
	<!-- /Breadcrumb -->

	<!-- Mulai Card 1 -->
	<div class="row gutters-sm">
		<div class="col-lg-8">
			<?= $this->session->flashdata('message'); ?>
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardAnggota" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Form Pengajuan Transaksi</h6>
				</a>
				<!-- Card Content - Collapse -->
				<div class="collapse show" id="collapseCardAnggota">
					<div class="card-body">
						<div class="row">
							<div class="container-fluid" style="height: 320px;overflow: auto;">
								<form action="<?= base_url('anggota_transaksi/pengajuan_tra'); ?>" method="post">
									<div class="form-group row">
										<label for="name_berkas" class="col-sm-3 col-form-label">Jenis Pengajuan</label>
										<div class="col-sm-9">
											<select class="form-control sm" id="jenis_transaksi" name="jenis_transaksi">
												<option> Pilih Jenis Pengajuan </option>
												<option value="Simpanan Pokok">Pembayaran Simpanan Pokok</option>
												<option value="Simpanan Wajib">Pembayaran Simpanan Wajib</option>
												<option value="Pinjaman">Pinjaman Keuangan</option>
												<option value="Angsuran">Angsuran</option>
												<option value="Infaq">Infaq</option>
											</select>
										</div>
									</div>
									<input type="hidden" id="id_transaksi" name="id_transaksi">
									<input type="hidden" id="id" name="id">
									<div class="form-group row">
										<input type="hidden" id="id" name="id" value="<?= $user['id'];?>">
										<label for="name_berkas" class="col-sm-3 col-form-label">Nama Lengkap</label>
										<div class="col-sm-9">
											<input type="text" class="form-control col-sm" id="name" name="name" value="<?= $user['name']; ?>" placeholder="<?= $user['name']; ?>" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label for="name_berkas" class="col-sm-3 col-form-label">Tanggal</label>
										<div class="col-sm-9">
											<input type="date" class="form-control col-sm" id="tanggal" name="tanggal">
										</div>
									</div>
									<div class="form-group row">
										<label for="name_berkas" class="col-sm-3 col-form-label">Nominal</label>
										<div class="col-sm-9">
											<input type="text" class="form-control col-sm" id="nominal" name="nominal"  placeholder="(Cth. 10000)">
										</div>
									</div>
									<br>
									<div class="card-footer bg-white col-lg col-md col-sm d-flex justify-content-center">
										<br>
										<label>
											<a href="<?= base_url('user'); ?>" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-reply"></i> Kembali</a>
											<input type="submit" name="submit" class="btn btn-sm btn-primary" value="Ajukan">
										</label>
									</div>
								</form>		
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardSaldo" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Saldo & Pinjaman</h6>
				</a>
				<div class="collapse show" id="collapseCardSaldo">
					<div class="card-body" style="height: 360px;overflow: auto;">
						<div class="row">
							<div class="col-lg col-md col-sm">
								<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
									<ol class="carousel-indicators">
										<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
										<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
									</ol>
									<div class="carousel-inner" style="height: 150px;overflow: auto;">
										<div class="carousel-item active">
											<div class="col-lg col-md col-sm">
												<?php
               									include 'koneksi.php';
               									$id = $user['id'];
                								$i=0;
                								$pinjaman = mysqli_query($koneksi, "SELECT SUM(nominal) 
                									FROM tb_simpanan 
                									JOIN transaksi
                									ON transaksi.id_transaksi = tb_simpanan.id_transaksi
                									AND transaksi.validasi = '1'
                									JOIN user ON tb_simpanan.id = user.id
                									WHERE user.id = '$id'");
                								while($data = mysqli_fetch_array($pinjaman))
                								{
                 	 							?>
												<div class="card bg-gradient-mahisa shadow h-100 py-2">
													<div class="card-body">
														<div class="row no-gutters align-items-center">
															<div class="col mr-2">
																<div class="text-xs font-weight-bold text-white text-uppercase mb-1">SALDO</div>
																<div class="h5 mb-0 font-weight-bold text-white">Rp. <?= number_format($data['SUM(nominal)']);?></div>
															</div>
															<div class="col-auto">
																<i class="fas fa-fw fa-wallet fa-2x text-white"></i>
															</div>
														</div>
													</div>
												</div>
												<?php } ?>
											</div>	
										</div>
										<div class="carousel-item">
											<div class="col-lg col-md col-sm">
												<?php
               									include 'koneksi.php';
               									$id = $user['id'];
                								$i=0;
                								$pinjaman = mysqli_query($koneksi, "SELECT SUM(nominal) 
                									FROM tb_pinjaman
                									JOIN transaksi
                									ON transaksi.id_transaksi = tb_pinjaman.id_transaksi
                									AND transaksi.validasi = '1' 
                									JOIN user ON tb_pinjaman.id = user.id 
                									WHERE user.id = '$id'");
                								while($data = mysqli_fetch_array($pinjaman))
                								{
                 	 							?>
												<div class="card bg-gradient-taruna shadow h-100 py-2">
													<div class="card-body">
														<div class="row no-gutters align-items-center">
															<div class="col mr-2">
																<div class="text-xs font-weight-bold text-white text-uppercase mb-1">PINJAMAN</div>
																<div class="h5 mb-0 font-weight-bold text-white">Rp. <?= number_format($data['SUM(nominal)']);?></div>
															</div>
															<div class="col-auto">
																<i class="fas fa-fw fa-credit-card fa-2x text-white"></i>
															</div>
														</div>
													</div>
												</div>
												<?php } ?>
											</div>	
										</div>	
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer bg-white">
						<span><b>*Catatan penting :</b></span><br>
						<small>1. Mohon hubungi pengelola koperasi terlebih dahulu sebelum mengajukan sebuah transaksi.</small><br>
						<small>2. Mohon periksa kembali jumlah nominal transaksi yang anda ajukan.</small>
					</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End card simpanan Koperasi -->
	</div>

</div>
</div>