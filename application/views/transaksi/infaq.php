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

	<!-- Mulai table infaq -->
	<div class="row gutters-sm">
		<div class="col-lg col-md col-sm col-xs">
			<?= $this->session->flashdata('message'); ?>
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardAnggota" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Data Infaq Anggota</h6>
				</a>

				<!-- Card Content - Collapse -->
				<div class="collapse show" id="collapseCardAnggota">
					<div class="card-header bg-white">
						<a href="#modalTambahInfaq" class="btn btn-sm btn-primary" data-toggle="modal"><i class="fas fa-fw fa-plus fa-sm text-white-50"></i> Tambah</a>
					</div>	
					<div class="card-body">
						<div class="table-responsive table-sm" style="height: 300px;overflow: auto;">
							<table id="dataTable" class="table table-bordered table-hover table-xs" width="100%" cellspacing="0">
								<thead class="thead-light">
									<tr>
										<th scope="row" width="3%" style="text-align: center;">#</th>
										<th style="text-align: center">Nomor Infaq</th>
										<th style="text-align: center;">Nomor Transaksi</th>
										<th style="text-align: center;">ID Anggota</th>
										<th style="text-align: center;">Nama Anggota</th>
										<th style="text-align: center;">Tanggal Transaksi</th>
										<th style="text-align: center;">Nominal</th>
										<th style="text-align: center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; ?>
									<?php foreach ($infaqAnggota as $in) : 
										{
											$nominal=number_format($in['nominal'],0,",",".")
											?>
											<tr id="example1_filter">
												<th scope="row" width="3%" style="text-align: center;"><?= $i; ?></th>
												<td width="5%" style="text-align: center;"><?= $in['id_infaq']; ?></td>
												<td width="5%" style="text-align: center;"><?= $in['id_transaksi']; ?></td>
												<td width="5%" style="text-align: center;"><?= $in['id']; ?></td>
												<td width="14%"><?= $in['name']; ?></td>
												<td width="13%" style="text-align: center;"><?= $in['tanggal']; ?></td>
												<td width="20%" style="text-align: center;">Rp. <?= $nominal; ?></td>
												<td width="12%" style="text-align: center;">

													<a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEditInfaq<?= $in['id_infaq']; ?>"><i class="fas fa-fw fa-edit fa-sm"></i></a>
													<a href="<?= base_url('Dom_pdf/cetakfaktur_in/'). $in['id_infaq']; ?>" onclick="return confirm('Cetak bukti simpanan ini?')" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-print fa-sm"></i></a>
													<a href="<?= base_url('transaksi/delete_infaq/'). $in['id_transaksi']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus submenu ini?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash fa-sm"></i></a>
													
												</td>
											</tr>
											<?php $i++;?>
										<?php }?>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End  -->

</div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambahInfaq" tabindex="-1" role="dialog" aria-labelledby="modalTambahEditlabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-white">
				<h5 class="modal-title" id="modalTambahEditlabel">Tambah Infaq Anggota</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('transaksi/tambah_infaq'); ?>" method="post">
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
					<input type="hidden" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value="Infaq">
					<div class="form-group">
						<input type="text" class="form-control" id="nominal" name="nominal" placeholder="Nominal Bayar (Cth. 10000)">
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

<!--  Modal edit infaq -->
<?php $i = 0;
foreach($infaqAnggota as $in) : $i++;
	?>
	<div class="modal fade" id="modalEditInfaq<?= $in['id_infaq']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditSimpanlabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-white">
					<h5 class="modal-title" id="modalTambahEditlabel">Edit Infaq Anggota</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?= form_open_multipart('transaksi/edit_infaq');?>
				<div class="modal-body bg-white">
					<input type="hidden" name="id_infaq" value="<?= $in['id_infaq'];?>">
					<div class="form-group">
						<input type="hidden" class="form-control" id="id_transaksi" name="id_transaksi" value="<?= $in['id_transaksi'];?>" readonly>
					</div>
					<div class="form-group">
						<input type="hidden" class="form-control" id="id" name="id" value="<?= $in['id'];?>" readonly>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" value="<?= $in['name'];?>" readonly>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="tanggal" name="tanggal" value="<?= $in['tanggal'];?>" readonly>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nominal" name="nominal" value="<?= $in['nominal'];?>">
					</div>
				</div>
				<div class="modal-footer bg-white">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-sm btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach; ?>
<!-- End -->