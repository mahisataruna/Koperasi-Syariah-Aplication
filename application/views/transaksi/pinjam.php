<!-- Mulai Main Content -->
<div class="container-fluid">


	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb" class="main-breadcrumb">
		<ol class="breadcrumb shadow mb-4 bg-white">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('transaksi'); ?>">Transaksi</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
		</ol>
	</nav>
	<!-- /Breadcrumb -->


	<!-- Mulai Card 1 -->
	<div class="row gutters-sm">
		<div class="col-sm">
			<?= $this->session->flashdata('message'); ?>
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardPinjam" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Data Pinjaman Anggota</h6>
				</a>

				<!-- Card Content - Collapse -->
				<div class="collapse show" id="collapseCardPinjam">
					<div class="card-header bg-white">
						<a href="#modalTambahPinjam" class="btn btn-sm btn-primary" data-toggle="modal"><i class="fas fa-fw fa-plus fa-sm text-white-50"></i> Tambah</a>
					</div>	
					<div class="card-body">
						<div class="table-responsive table-sm" style="height: 300px;overflow: auto;">
							<table id="dataTable" class="table table-bordered table-hover table-xs" width="100%" cellspacing="0">
								<thead class="thead-light">
									<tr>
										<th scope="col-sm" style="text-align: center;">#</th>
										<th style="text-align: center;">No Pinjaman</th>
										<th style="text-align: center;">No Transaksi</th>
										<th style="text-align: center;">ID Anggota</th>
										<th style="text-align: center;">Nama Anggota</th>
										<th style="text-align: center;">Tanggal Pinjam</th>
										<th style="text-align: center;">Nominal</th>
										<th style="text-align: center;">Lama Angsuran</th>
										<th style="text-align: center;">Status</th>
										<th style="text-align: center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; ?>
									
									<?php foreach ($PinjamAnggota as $pa) : 

										{ 
											$nominal=number_format($pa['nominal'],0,",",".");
											?>
											<tr id="example1_filter">
												<th scope="row" width="3%"><?= $i; ?></th>
												<td width="5%" style="text-align: center;"><?= $pa['id_pinjaman']; ?></td>
												<td width="5%" style="text-align: center;"><?= $pa['id_transaksi']; ?></td>
												<td width="5%" style="text-align: center;"><?= $pa['id']; ?></td>
												<td width="15%"><?= $pa['name']; ?></td>
												<td width="10%" style="text-align: center;"><?= $pa['tanggal']; ?></td>
												<td width="10%" style="text-align: center;">Rp. <?= $nominal; ?></td>
												<td width="10%" style="text-align: center;"><?= $pa['lama_pinjam'] ?></td> 
												<td width="10%" style="text-align: center;">
													<?php
													if($pa['status'] == '0')
													{
														echo "BELUM LUNAS";
													}else{
														echo "LUNAS";
													}
													?>
												</td>
												<td width="15%" style="text-align: center;">
													<a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEditPinjaman<?= $pa['id_pinjaman']; ?>"><i class="fas fa-fw fa-edit fa-sm"></i></a>
													<a href="<?= base_url('Dom_pdf/cetakfaktur_pj/'). $pa['id_pinjaman']; ?>" onclick="return confirm('Cetak bukti pinjaman ini?')" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-print fa-sm"></i></a>
													<a href="<?= base_url('transaksi/delete_pinjaman/'). $pa['id_transaksi']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus simpanan ini?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash fa-sm"></i></a>
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
		<!-- End Card 1 -->
	</div>

</div>
</div>	

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambahPinjam" tabindex="-1" role="dialog" aria-labelledby="modalTambahEditlabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-white">
				<h5 class="modal-title" id="modalTambahEditlabel">Form Pinjaman Anggota</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('transaksi/tambah_pinjaman'); ?>" method="post">
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
					<input type="hidden" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value="Pinjaman">
					<input type="hidden" id="status" name="status" value="0">
					<div class="form-group">
						<select name="lama_pinjam" id="lama_pinjam" class="form-control">
							<option>Lama Pinjam</option>
							<option value="7 Hari">7 Hari</option>
							<option value="14 Hari">14 Hari</option>
							<option value="30 Hari">30 Hari</option>
							<option value="100 Hari">100 Hari</option>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nominal" name="nominal" placeholder="Nominal Pinjam (Cth. 10000)">
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

<!-- Modal Edit Pinjam -->
<?php $i = 0;
foreach($PinjamAnggota as $pa) : $i++;
?>
<div class="modal fade" id="modalEditPinjaman<?= $pa['id_pinjaman']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditSimpanlabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-white">
				<h5 class="modal-title" id="modalTambahEditlabel">Edit Infaq Anggota</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open_multipart('transaksi/edit_pinjaman');?>
				<div class="modal-body bg-white">
					<input type="hidden" name="id_pinjaman" value="<?= $pa['id_pinjaman'];?>">
					<div class="form-group">
						<input type="hidden" class="form-control" id="id_transaksi" name="id_transaksi" value="<?= $pa['id_transaksi'];?>" readonly>
					</div>
					<div class="form-group">
						<input type="hidden" class="form-control" id="id" name="id" value="<?= $pa['id'];?>" readonly>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" value="<?= $pa['name'];?>" readonly>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="tanggal" name="tanggal" value="<?= $pa['tanggal'];?>" readonly>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nominal" name="nominal" value="<?= $pa['nominal'];?>">
					</div>
					<div class="form-group">
						<select name="status" id="status" class="form-control" value="<?= $pa['nominal'];?>">
							<option>Status Pinjaman</option>
							<option value="0">BELUM LUNAS</option>
							<option value="1">LUNAS</option>
						</select>
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