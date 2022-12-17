<!-- Mulai Main Content -->
<div class="container-fluid">


	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb" class="main-breadcrumb">
		<ol class="breadcrumb shadow mb-4 bg-white">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item"><a href="javascript:void(0)">Transaksi</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
		</ol>
	</nav>
	<!-- /Breadcrumb -->

	<!-- Mulai Card 1 -->
	<div class="row">
		<div class="col-lg col-md col-sm col-xs">
			<?= $this->session->flashdata('message'); ?>
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardAnggota" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Data Simpanan Pokok Anggota</h6>
				</a>

				<!-- Card Content - Collapse -->
				<div class="collapse show" id="collapseCardAnggota">
					<div class="card-header bg-white">
						<a href="#modalTambahSimpanPokok" class="btn btn-sm btn-primary" data-toggle="modal"><i class="fas fa-fw fa-plus fa-sm text-white-50"></i> Tambah</a>
					</div>
					<div class="card-body">
						<div class="table-responsive" style="height: 330px;overflow: auto;">
							<table id="dataTable" class="table table-bordered table-hover table-sm" width="100%" cellspacing="0">
								<thead class="thead-light">
									<tr>
										<th scope="col-sm" style="text-align: center;">#</th>
										<th style="text-align: center;">Nomor Simpanan</th>
										<th style="text-align: center;">Nomor Transaksi</th>
										<th style="text-align: center;">ID Anggota</th>
										<th>Nama Anggota</th>
										<th style="text-align: center;">Tanggal Transaksi</th>
										<th style="text-align: center;">Nominal</th>
										<th style="text-align: center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; ?>
									<?php 
									if (is_array($simpanPokok) || is_object($simpanPokok)) {

										foreach ($simpanPokok as $sa) : 
											{
												$nominal=number_format($sa['nominal'],0,",",".")

												?>
												<tr id="example1_filter">
													<th scope="row" width="3%" style="text-align: center;"><?= $i; ?></th>
													<td width="5%" style="text-align: center;"><?= $sa['id_simpanan']; ?></td>
													<td width="5%" style="text-align: center;"><?= $sa['id_transaksi']; ?></td>
													<td width="5%" style="text-align: center;"><?= $sa['id']; ?></td>
													<td width="14%"><?= $sa['name']; ?></td>
													<td width="10%" style="text-align: center;"><?= $sa['tanggal']; ?></td>
													<td width="15%" style="text-align: center;">Rp. <?= $nominal; ?></td>
													<td width="15%" style="text-align: center;">
														<label>
															<a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEditSimpanPokok<?= $sa['id_simpanan']; ?>"><i class="fas fa-edit fa-sm"></i></a>
															<a href="<?= base_url('Dom_pdf/cetakfaktur_sp/'). $sa['id_simpanan']; ?>" onclick="return confirm('Cetak bukti simpanan ini?')" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-print fa-sm"></i></a>
															<a href="<?= base_url('transaksi/delete_simpanan/'). $sa['id_transaksi']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus simpanan ini?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash fa-sm"></i></a>
														</label>
													</td>
												</tr>
												<?php $i++;?>
											<?php } ?>
										<?php endforeach; ?>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

	<!-- Simpanan Wajib -->
	<div class="row">
		<div class="col-lg col-md col-sm col-xs">
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardSimpananWajibAnggota" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Data Simpanan Wajib Anggota</h6>
				</a>

				<!-- Card Content - Collapse -->
				<div class="collapse show" id="collapseCardSimpananWajibAnggota">
					<div class="card-header bg-white">
						<a href="#modalTambahSimpanWajib" class="btn btn-sm btn-primary" data-toggle="modal"><i class="fas fa-fw fa-plus fa-sm text-white-50"></i> Tambah</a>
					</div>
					<div class="card-body">
						<div class="table-responsive" style="height: 330px;overflow: auto;">
							<table id="dataTable" class="table table-bordered table-hover table-sm" width="100%" cellspacing="0">
								<thead class="thead-light">
									<tr>
										<th scope="col-sm" style="text-align: center;">#</th>
										<th style="text-align: center;">Nomor Simpanan</th>
										<th style="text-align: center;">Nomor Transaksi</th>
										<th style="text-align: center;">ID Anggota</th>
										<th>Nama Anggota</th>
										<th style="text-align: center;">Tanggal Transaksi</th>
										<th style="text-align: center;">Nominal</th>
										<th style="text-align: center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; ?>
									<?php foreach ($simpanWajib as $sw) : 
										{
											$nominal=number_format($sw['nominal'],0,",",".")
											?>
											<tr id="example1_filter">
												<th scope="row" width="3%" style="text-align: center;"><?= $i; ?></th>
												<td width="5%" style="text-align: center;"><?= $sw['id_simpanan']; ?></td>
												<td width="5%" style="text-align: center;"><?= $sw['id_transaksi']; ?></td>
												<td width="5%" style="text-align: center;"><?= $sw['id']; ?></td>
												<td width="14%"><?= $sw['name']; ?></td>
												<td width="10%" style="text-align: center;"><?= $sw['tanggal']; ?></td>
												<td width="15%" style="text-align: center;">Rp. <?= $nominal; ?></td>
												<td width="15%" style="text-align: center;">
													<label>
														<a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEditSimpanWajib<?= $sw['id_simpanan']; ?>"><i class="fas fa-edit fa-sm"></i></a>
														<a href="<?= base_url('Dom_pdf/cetakfaktur_sp/'). $sw['id_simpanan']; ?>" onclick="return confirm('Cetak bukti simpanan ini?')" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-print fa-sm"></i></a>
														<a href="<?= base_url('transaksi/delete_simpanan/'). $sw['id_transaksi']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus simpanan ini?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash fa-sm"></i></a>
													</label>
												</td>
											</tr>
											<?php $i++;?>
										<?php } ?>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- End card simpanan Koperasi -->
</div>
</div>

<!-- Modal Tambah Simpanan Pokok Anggota-->
<div class="modal fade" id="modalTambahSimpanPokok" tabindex="-1" role="dialog" aria-labelledby="modaTambahSimpanlabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-white">
				<h5 class="modal-title" id="modalTambahSimpanlabel">Tambah Simpanan Pokok Anggota</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('transaksi/tambah_simpan'); ?>" method="post">
				<div class="modal-body bg-white">
					<div class="form-group">
						<select name="id" id="id" class="form-control">
							<option value="">Pilih Anggota</option>
							<?php foreach($anggota as $a) : ?>
								<option value="<?= $a['id']; ?>"><?= $a['name']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" placeholder="Nama Anggota">
					</div>
					<div class="form-group">
						<input type="date" class="form-control" id="tanggal" name="tanggal">
					</div>
					<div class="form-group">
						<input type="hidden" name="jenis_transaksi" id="jenis_transaksi" class="form-control" value="Simpanan Pokok" placeholder="Simpanan Pokok" readonly>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nominal" name="nominal" placeholder="Nominal Bayar (Cth. 100000)">
					</div>
				</div>
				<div class="modal-footer bg-white">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-sm btn-primary">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End -->

<!-- Modal Tambah Simpanan Wajib-->
<div class="modal fade" id="modalTambahSimpanWajib" tabindex="-1" role="dialog" aria-labelledby="modaTambahSimpanlabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-white">
				<h5 class="modal-title" id="modalTambahSimpanWajiblabel">Tambah Simpanan Wajib Anggota</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('transaksi/tambah_simpan'); ?>" method="post">
				<div class="modal-body bg-white">
					<div class="form-group">
						<select name="id" id="id" class="form-control">
							<option value="">Pilih Anggota</option>
							<?php foreach($anggota as $a) : ?>
								<option value="<?= $a['id']; ?>"><?= $a['name']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" placeholder="Nama Anggota">
					</div>
					<div class="form-group">
						<input type="date" class="form-control" id="tanggal" name="tanggal">
					</div>
					
					<div class="form-group">
						<input type="hidden" name="jenis_transaksi" id="jenis_transaksi" class="form-control" value="Simpanan Wajib" placeholder="Simpanan Wajib" readonly>
					</div>
					<div class="form-group">
						<input type="hidden" class="form-control" id="nominal" name="nominal" value="10000" placeholder="Nominal Bayar (Cth. 10000)">
					</div>
				</div>
				<div class="modal-footer bg-white">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-sm btn-primary">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End -->

<!-- Modal Edit Simpanan Pokok -->
<?php $i = 0;
foreach($simpanPokok as $sa) : $i++;
	?>
	<div class="modal fade" id="modalEditSimpanPokok<?= $sa['id_simpanan']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditSimpanlabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-white">
					<h5 class="modal-title" id="modalTambahSimpanlabel">Edit Simpanan Anggota</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?= form_open_multipart('transaksi/edit_simpananagt');?>
				<div class="modal-body bg-white">
					<input type="hidden" id="id_simpanan" name="id_simpanan" value="<?= $sa['id_simpanan']; ?>">
					<input type="hidden" id="id_transaksi" name="id_transaksi" value="<?= $sa['id_transaksi']; ?>">
					<div class="form-group">
						<input type="hidden" class="form-control" id="id" name="id" value="<?= $sa['id'];?>" readonly>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" value="<?= $sa['name']; ?>" readonly>
					</div>
					<div class="form-group">
						<input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $sa['tanggal']; ?>">
					</div>
					<div class="form-group">
						<select name="jenis_transaksi" id="jenis_transaksi" class="form-control">
							<option value="<?= $sa['jenis_transaksi']; ?>"><?= $sa['jenis_transaksi']; ?></option>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nominal" name="nominal" value="<?= $sa['nominal']; ?>">
					</div>
				</div>
				<div class="modal-footer bg-white">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
					<input type="submit" value="Simpan" class="btn btn-sm btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach;?>
<!-- End -->

<!-- Modal Edit Simpanan Wajib -->
<?php $i = 0;
foreach($simpanWajib as $sw) : $i++;
	?>
	<div class="modal fade" id="modalEditSimpanWajib<?= $sw['id_simpanan']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditSimpanlabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-white">
					<h5 class="modal-title" id="modalTambahSimpanlabel">Edit Simpanan Wajib Anggota</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?= form_open_multipart('transaksi/edit_simpananagt');?>
				<div class="modal-body bg-white">
					<input type="hidden" id="id_simpanan" name="id_simpanan" value="<?= $sw['id_simpanan']; ?>">
					<input type="hidden" id="id_transaksi" name="id_transaksi" value="<?= $sw['id_transaksi']; ?>">
					<div class="form-group">
						<input type="hidden" class="form-control" id="id" name="id" value="<?= $sw['id'];?>" readonly>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" value="<?= $sw['name']; ?>" readonly>
					</div>
					<div class="form-group">
						<input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $sw['tanggal']; ?>">
					</div>
					<div class="form-group">
						<select name="jenis_transaksi" id="jenis_transaksi" class="form-control">
							<option value="<?= $sw['jenis_transaksi']; ?>"><?= $sw['jenis_transaksi']; ?></option>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nominal" name="nominal" value="<?= $sw['nominal']; ?>">
					</div>
				</div>
				<div class="modal-footer bg-white">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
					<input type="submit" value="Simpan" class="btn btn-sm btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach;?>
<!-- End -->









