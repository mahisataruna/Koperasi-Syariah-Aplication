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
	<div class="row">
		<div class="col-lg col-md col-sm col-xs">
			<?= $this->session->flashdata('message'); ?>
			<div class="card">
				<div class="card-header bg-white">
					<h6 class="m-0 font-weight-bold text-primary">Bagi Hasil Usaha Koperasi</h6>
				</div>	
				<div class="card-header bg-white">
					<div class="row">
						<form action="<?= base_url('transaksi/bagihasilagt');?>" method="post">
							<input type="hidden" id="id_transaksi"name="id_transaksi">
							<label>
								<select id="id" name="id" class="form-control">
									<option>--Pilih Anggota--</option>
									<?php
									include 'koneksi.php';
								//Tampilkan id
									$query=mysqli_query($koneksi, "SELECT * FROM user WHERE role_id=2 ORDER BY id");
									while($data = mysqli_fetch_array($query)) {
										?>
										
										<option value="<?= $data['id'];?>"><?php echo $data['name'];?></option>
										<?php	
									} 

									?>
								</select>
							</label>
							<label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Ulangi Nama">
							</label>
							<label>
								<input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="--Pilih--">
							</label>
							<input type="hidden"  id="nominal"  name="nominal">
							<label>
								<input type="submit" class="form-control btn btn-sm btn-primary" name="" value="Bagikan">
							</label>
						</form>
					</div>
				</div>	
				<div class="card-body bg-white">
					<div class="table-responsive table-sm" style="height: 350px;overflow: auto;">
						<table id="dataTable" class="table table-bordered table-hover table-xs" width="100%" cellspacing="0">
							<thead class="thead-light">
								<tr>
									<th scope="row" width="3%" style="text-align: center;">#</th>
									<th style="text-align: center">Nomor BHU</th>
									<th style="text-align: center;">Nomor Transaksi</th>
									<th style="text-align: center;">Nama Anggota</th>
									<th style="text-align: center;">Tanggal Transaksi</th>
									<th style="text-align: center;">Nominal</th>
									<th style="text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; ?>
								<?php foreach ($bhuAnggota as $bhu) : 
									{
										$nominal=number_format($bhu['nominal'],0,",",".");
										?>
										<tr id="example1_filter">
											<th scope="row" width="3%" style="text-align: center;"><?= $i; ?></th>
											<td width="10%" style="text-align: center;"><?= $bhu['id_bhu']; ?></td>
											<td width="10%" style="text-align: center;"><?= $bhu['id_transaksi']; ?></td>
											<td width="15%"><?= $bhu['name']; ?></td>
											<td width="10%" style="text-align: center;"><?= $bhu['tanggal']; ?></td>
											<td width="15%" style="text-align: center;">Rp. <?= $nominal; ?></td>
											<td width="10%" style="text-align: center;">

												<a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEditbhu<?= $bhu['id_bhu']; ?>"><i class="fas fa-fw fa-edit fa-sm"></i></a>
												<a href="<?= base_url('Dom_pdf/cetakfaktur_bhu/'). $bhu['id_bhu']; ?>" onclick="return confirm('Cetak bukti bagi hasil ini?')" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-print fa-sm"></i></a>
												<a href="<?= base_url('transaksi/delete_bhu/'). $bhu['id_transaksi']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus submenu ini?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash fa-sm"></i></a>

											</td>
										</tr>
										<?php $i++;?>
									<?php }?>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer bg-white">
					<span>*Catatan penting:</span><br>
					<small>1. Besaran bagi hasil usaha sebesar 10% untuk anggota</small><br>
					<small>2. Besaran bagi hasil usaha sebesar 10% untuk pengelola</small><br>
					<small>3. Besaran bagi hasil usaha sebesar 10% untuk Panti Asuhan Bundo Saiyo Padang</small><br>
					<small>4. Besaran bagi hasil usaha sebesar 10% untuk fakir miskin</small><br>
					<small>5. Besaran bagi hasil usaha sebesar 60% untuk pemilik</small>
				</div>
			</div>
		</div>
	</div>

</div>
</div>	

<!-- Modal Edit-->
<?php $i = 0;
foreach($bhuAnggota as $bhu) : $i++;
	?>
	<div class="modal fade" id="modalEditbhu<?= $bhu['id_bhu']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditSimpanlabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalTambahEditlabel">Edit Bagi Hasil Usaha</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?= form_open_multipart('transaksi/edit_bhu');?>
				<div class="modal-body">
					<input type="hidden" name="id_infaq" value="<?= $bhu['id_bhu'];?>">
					<div class="form-group">
						<input type="hidden" class="form-control" id="id_transaksi" name="id_transaksi" value="<?= $bhu['id_transaksi'];?>" readonly>
					</div>
					<div class="form-group">
						<input type="hidden" class="form-control" id="id" name="id" value="<?= $bhu['id'];?>" readonly>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" value="<?= $bhu['name'];?>" readonly>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="tanggal" name="tanggal" value="<?= $bhu['tanggal'];?>" readonly>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nominal" name="nominal" value="<?= $bhu['nominal'];?>">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-sm btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach; ?>
<!-- End -->