<div class="container-fluid">

	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb" class="main-breadcrumb">
		<ol class="breadcrumb shadow mb-4 bg-white">
			<li class="breadcrumb-item"><a href="<?= base_url('admin');?>">Home</a></li>
			<li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
		</ol>
	</nav>
	<!-- /Breadcrumb -->


	<!-- Mulai card role -->
	<div class="row gutters-sm">
		<!-- Card Untuk Role -->
		<div class="col-sm-6">
			<!-- Pesan error validation-->
			<?= form_error('menu', '<div class="alert alert-danger" role="alert">', ' </div>'); ?>

			<?= $this->session->flashdata('message'); ?>
			<!-- End Pesan -->
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardRole" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Role  </h6>
				</a>
				<div class="collapse show" id="collapseCardRole">
					<div class="card-body">
						<!-- Mulai card tabel -->
						<div class="table-responsive table-sm" style="height: 360px;overflow: auto;">
							<div class="d-flex">
								<div class="d-flex align-items-justify">
									<div class="mx-auto p-2">
										<label>
											<a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalRole">
												<i class="fas fa-fw fa-plus fa-sm text-white-50"></i> Tambah Role</a>
											</label>
										</div>
									</div>
								</div>
								<!-- Mulai tabel -->
								<table class="table table-bordered table-hover table-xs" id="tabelanggota" width="100%" cellspacing="0">
									<thead class="thead-light">
										<tr>
											<th class="sm" style="text-align: center;">#</th>
											<th>Nama Role</th>
											<th style="text-align: center;">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i=1; ?>
										<?php foreach($role as $r) : ?>
											<tr id="example1_filter">
												<th scope="row" width="2%" style="text-align: center;"><?= $i; ?></th>
												<td width="15%" style="text-align: left;"><?= $r['role'];?></td>
												<td width="8%" style="text-align: center;">
													<a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEditRoleMenu<?php echo $r['id'];?>"><i class="fas fa-edit fa-sm"></i></a>
													<a href="<?= base_url('admin/roleaccess/') . $r['id'];?>" class="btn btn-sm btn-warning"><i class="fas fa-cog fa-sm"></i></a>
													<a href="<?= base_url('admin/delete_role/') . $r['id'];?>" onclick="return confirm('Apakah anda yakin ingin menghapus role ini?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash fa-sm"></i></a>
													
												</td>
											</tr>
											<?php $i++; ?>
										<?php endforeach; ?> 
									</tbody>
								</table>
								<!-- End -->
							</div>	
						</div> 	
					</div>	
				</div>	
			</div>
			<!-- End -->
			<!-- Card Untuk role anggota -->
			<div class="col-sm-6">
			<!-- Pesan error validation
			Letakkan disiniS
			End Pesan -->
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardInformasi" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Kelola Role User</h6>
				</a>
				<div class="collapse show" id="collapseCardInformasi">
					<div class="card-body">
						<!-- Mulai card tabel -->
						<div class="table-responsive table-sm" style="height: 260px;overflow: auto;">
							<div class="d-flex">
								<div class="d-flex align-items-justify">
									<div class="mx-auto p-2">
										<label>
											
										</label>
									</div>
								</div>
							</div>
							<!-- Mulai tabel -->
							<table class="table table-bordered table-hover table-xs" id="tabelanggota" width="100%" cellspacing="0">
								<thead class="thead-light">
									<tr>
										<th class="sm" style="text-align: center;">#</th>
										<th>Nama user</th>
										<th style="text-align: center;">Role</th>
										<th style="text-align: center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; ?>
									<?php 
												//Koneksi database
									include 'koneksi.php';

									$data_role_user = mysqli_query($koneksi, "SELECT * FROM user WHERE id AND is_active=1");

									$jumlah_anggota = mysqli_fetch_array($data_role_user);

									?>
									<?php $i = 1; ?>
									<?php 
									if (isset($data_role_user)) {
										foreach($data_role_user as $dr) :  
											?>
											<tr id="example1_filter">
												<th scope="row" width="2%" style="text-align: center;"><?= $i; ?></th>
												<td width="12%"><?= $dr['name'];?></td>
												<td width="10%" style="text-align: center;">
													<?php
													if($dr['role_id']==1){
														echo "Administrator";
													} elseif ($dr['role_id']==2) {
														echo "Anggota";
													} elseif ($dr['role_id']==3) {
														echo "Pemilik";
													}
													?>
												</td>
												<td width="2%" style="text-align: center;">	
													<a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEditRoleUser<?php echo $dr['id'];?>"><i class="fas fa-edit fa-sm"></i></a>
												</td>
											</tr>
											<?php $i++; ?>
										<?php endforeach; ?> 
									<?php } ?>
								</tbody>
							</table>
							<!-- End -->
						</div>	
						<br>
						<div class="table-responsive" style="height: 78px;overflow: auto;">
							<small><b>Catatan :</small><br>
								<small>*Pilih role user sesuai dengan status user</small>
							</div>
						</div> 	
					</div>	
				</div>	
			</div>
			<!-- End -->
		</div>	
		<!-- End -->
	</div>

</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalRole" tabindex="-1" role="dialog" aria-labelledby="modaRolelabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-white">
				<h5 class="modal-title" id="modalRolelabel">Tambah Role</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/tambah_role'); ?>" method="post">
				<div class="modal-body bg-white">
					<div class="form-group">
						<input type="text" class="form-control" id="role" name="role" placeholder="Jenis Role">
					</div>
				</div>
				<div class="modal-footer bg-white">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-sm btn-primary">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End -->

<!-- Modal Edit Role User -->
<?php $i = 0;
foreach ($role as $r) : $i++;
?>
<div class="modal fade" id="modalEditRoleMenu<?php echo $r['id'];?>" tabindex="-1" role="dialog" aria-labelledby="modalEditRoleMenulabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-white">
				<h5 class="modal-title" id="modalEditRoleMenulabel">Edit Role</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open_multipart('admin/edit_role');?>
				<div class="modal-body bg-white">
					<input type="hidden" name="id" value="<?= $r['id'];?>">
					<div class="form-group">
						<input type="text" class="form-control" id="role" name="role" value="<?= $r['role'];?>">
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

<!-- Modal Edit Role User -->
<?php $i = 0;
foreach ($data_role_user as $dr) : $i++;
?>
<div class="modal fade" id="modalEditRoleUser<?php echo $dr['id'];?>" tabindex="-1" role="dialog" aria-labelledby="modalEditRoleUserlabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-white">
				<h5 class="modal-title" id="modalEditRoleUserlabel">Edit Role User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open_multipart('user/edit_role_user');?>
				<div class="modal-body bg-white">
					<input type="hidden" name="id" value="<?= $dr['id'];?>">
					<select class="form-control" id="role_id" name="role_id">
						<option value="">Pilih Role User</option>
						<option value="1">Administrator</option>
						<option value="2">Anggota</option>
						<option value="3">Pemilik</option>
					</select>
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

