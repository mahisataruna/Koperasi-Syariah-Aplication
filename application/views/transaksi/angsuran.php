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
		<div class="col-lg col-md col-sm">
			<?= $this->session->flashdata('message'); ?>
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardAngsuran" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Data Angsuran Anggota</h6>
				</a>
				<!-- Card Content - Collapse -->
				<div class="collapse show" id="collapseCardAngsuran">
					<div class="card-header bg-white">
						<a href="#modalTambahAngsur" class="btn btn-sm btn-primary" data-toggle="modal"><i class="fas fa-fw fa-plus fa-sm text-white-50"></i> Tambah</a>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							
							<table id="dataTable" class="table table-bordered table-hover table-sm" width="100%" cellspacing="0">
								<thead class="thead-light">
									<tr>
										<th style="text-align: center;">#</th>
										<th style="text-align: center;">Nomor Angsuran</th>
										<th style="text-align: center;">Nomor Pinjaman</th>
										<th style="text-align: center;">Nomor Anggota</th>
										<th style="text-align: center;">Nama Anggota</th>
										<th style="text-align: center;">Angsuran ke</th>
										<th style="text-align: center;">Jumlah Angsuran</th>
										<th style="text-align: center;">Tanggal Angsuran</th>
										<th style="text-align: center;">Sisa Piutang</th>
										<th style="text-align: center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; ?>
									<?php foreach ($angsurpj as $ang) : 
										{
											$nominal1=number_format($ang['jumlah_angsuran'],0,",",".");
											$nominal2=number_format($ang['nominal'],0,",",".")
											?>
											<tr id="example1_filter">
												<th scope="row" width="3%" style="text-align: center;"><?= $i; ?></th>									
												<td width="3%" style="text-align: center;"><?= $ang['id_angsuran']; ?></td>
												<td width="5%" style="text-align: center;"><?= $ang['id_pinjaman']; ?></td>
												<td width="5%" style="text-align: center;"><?= $ang['id']; ?></td>
												<td width="15%" style="text-align: center;"><?= $ang['name'] ?></td>
												<td width="5%" style="text-align: center;"><?= $ang['angsuran_ke'] ?></td>
												<td width="10%" style="text-align: center;">Rp. <?= $nominal1; ?></td>
												<td width="10%" style="text-align: center;"><?= $ang['tanggal'] ?></td>
												<td width="10%" style="text-align: center;">Rp. <?= $nominal2; ?></td>
												<td width="20%" style="text-align: center;">
													<a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEditAngsuran<?= $ang['id_angsuran']; ?>"><i class="fas fa-fw fa-edit fa-sm"></i></a>
													<a href="<?= base_url('Dom_pdf/cetakfaktur_ang/'). $ang['id_angsuran']; ?>" onclick="return confirm('Cetak bukti simpanan ini?')" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-print fa-sm"></i></a>
													<a href="<?= base_url('transaksi/delete_angsuran/'). $ang['id_transaksi']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus angsuran anggota?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash fa-sm"></i></a>
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
				<!-- End data anggota Koperasi -->
			</div>
		</div>
	</div>

</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambahAngsur" tabindex="-1" role="dialog" aria-labelledby="modalTambahEditlabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-white">
				<h5 class="modal-title" id="modalTambahEditlabel">Form Angsuran Anggota</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('transaksi/tambah_angsuran'); ?>" method="post">
				<div class="modal-body bg-white">
					<div class="form-group">
						<select name="id" id="id" class="form-control">
							<option>Pilih Anggota</option>
							<?php foreach($NoPinjam as $np) : ?>
								<option value="<?= $np['id']; ?>"><?= $np['name']; ?></option>	
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" placeholder="Ulangi Nama Anggota">
					</div>
					<div class="form-group">
						<select name="id_pinjaman" id="id_pinjaman" class="form-control">
							<option>Pilih Nomor Pinjaman</option>
							<?php foreach($NoPinjam as $npa) : ?>
							<option value="<?= $npa['id_pinjaman'];?>">No. Pinjam : <?= $npa['id_pinjaman'];?>  - <?= $npa['name'];?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<select name="angsuran_ke" id="angsuran_ke" class="form-control">
							<option>Angsuran Ke :</option>
							<?php for ($i=1; $i<=30; $i++) { 
								echo "<option value='$i'>$i</option>";
							}?>
						</select>
					</div>
					<div class="form-group">
						<input type="date" class="form-control datepicker" id="tanggal" name="tanggal">
					</div>
					<input type="hidden" class="form-control" id="jenis_transaksi" name="jenis_transaksi" value="Angsuran">
					<input type="hidden" id="status" name="status" value="1">
						
					<div class="form-group">
						<input type="text" class="form-control" id="jumlah_angsuran" name="jumlah_angsuran" placeholder="Nominal Angsuran (Cth. 10000)">
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

<!--  Modal edit angsuran -->
<?php $i = 0;
foreach($angsuran as $ang) : $i++;
?>
<div class="modal fade" id="modalEditAngsuran<?= $ang['id_angsuran']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditSimpanlabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-white">
				<h5 class="modal-title" id="modalTambahEditlabel">Edit Angsuran Anggota</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open_multipart('transaksi/edit_angsuran');?>
				<div class="modal-body bg-white">
					<input type="hidden" name="id_angsuran" id="id_angsuran" value="<?= $ang['id_angsuran'];?>">
					<div class="form-group">
						<input type="hidden" class="form-control" id="id_transaksi" name="id_transaksi" value="<?= $ang['id_transaksi'];?>" readonly>
					</div>
					<div class="form-group">
						<input type="hidden" class="form-control" id="id" name="id" value="<?= $ang['id'];?>" readonly>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" value="<?= $ang['name'];?>" readonly>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="tanggal" name="tanggal" value="<?= $ang['tanggal'];?>" readonly>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="jumlah_angsuran" name="jumlah_angsuran" value="<?= $ang['jumlah_angsuran'];?>">
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