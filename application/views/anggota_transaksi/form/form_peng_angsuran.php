<div class="container-fluid">

	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb" class="main-breadcrumb">
		<ol class="breadcrumb shadow mb-4">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('anggota_transaksi'); ?>">Pengajuan Transaksi</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
		</ol>
	</nav>
	<!-- /Breadcrumb -->

	<!-- Mulai Card 1 -->
	<div class="row gutters-sm">
		<div class="col-lg-8">
			<?= $this->session->flashdata('message'); ?>
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardAnggota" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Form Pengajuan Angsuran</h6>
				</a>
				<!-- Card Content - Collapse -->
				<div class="collapse show" id="collapseCardAnggota">
					<div class="card-body">
						<div class="row">
							<div class="container-fluid" style="height: 350px;overflow: auto;">
								<form action="<?= base_url('anggota_transaksi/pengajuan_tra'); ?>" method="post">
									<!-- Hidden input -->
									<input type="hidden" id="jenis_transaksi" name="jenis_transaksi">
									<input type="hidden" id="id_transaksi" name="id_transaksi">
									<input type="hidden" id="id" name="id" value="<?= $user['id'] ?>">
									<input type="hidden" class="form-control col-sm" id="name" name="name" value="<?= $user['name']; ?>">
									<!-- End -->
									<div class="form-group row">
										<label for="name_berkas" class="col-sm-3 col-form-label">No. Pinjaman</label>
										<div class="col-sm-9">
											<select name="id_pinjaman" id="id_pinjaman" class="form-control">
												<option>Pilih Nomor Pinjaman</option>
												<?php foreach($NoPinjamAgt as $npa) : ?>
													<option value="<?= $npa['id_pinjaman'];?>">No. Pinjam : <?= $npa['id_pinjaman'];?>  - <?= $npa['name'];?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="name_berkas" class="col-sm-3 col-form-label">No. Pinjaman</label>
										<div class="col-sm-9">
											<select name="angsuran_ke" id="angsuran_ke" class="form-control">
												<option>Pilih Angsuran Ke :</option>
												<?php for ($i=1; $i<=30; $i++) { 
													echo "<option value='$i'>$i</option>";
												}?>
											</select>
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
											<a href="<?= base_url('anggota_transaksi'); ?>" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-reply"></i> Kembali</a>
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
	</div>

</div>
</div>