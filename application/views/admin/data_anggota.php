<div class="container-fluid">

	<!-- Mulai Breadcrumb -->
	<nav aria-label="breadcrumb" class="main-breadcrumb">
		<ol class="breadcrumb shadow mb-4 bg-white">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Dashbord</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
		</ol>
	</nav>
	<!-- End Breadcrumb -->

	<!-- Mulai Data anggota Koperasi -->
	<div class="row gutters-sm">
		<div class="col-lg col-md col-sm col-xs">
			<!-- Pesan error validation-->
			<?php if(validation_errors()) : ?>
				<div class="alert alert-danger" role="alert">
					<?= validation_errors(); ?>
				</div>
			<?php endif; ?>

			<?= $this->session->flashdata('message'); ?>
			<!-- Pesan error validation-->
			<!-- Mulai tabel daftar anggota -->
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardAnggota" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Daftar Anggota Koperasi</h6>
				</a>

				<!-- Card Content - Collapse -->
				<div class="collapse show" id="collapseCardAnggota">
					<div class="card-header bg-white">
						<div class="d-flex align-items-justify">
							<div class="d-flex">

								<div class="xs-auto p-1 my-md-1">
									<div class="justify-content">
										
										<label>
											<a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-fw fa-plus fa-sm text-white-50"></i> Tambah</a>
											<a href="http://localhost/aplikasikoperasi/dom_pdf" target="blank_page" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-print fa-sm text-white-50"></i></a>
										</label>

									</div>
								</div>	
							</div>
						</div>
						<!-- End Fitur -->
					</div>
					
					<div class="card-body">
						<!-- Fitur Table -->

						<div class="table-responsive table-sm" style="height: 700px;overflow: auto;">
							<table id="dataTable" class="table table-bordered table-hover table-xs" width="100%" cellspacing="0">
								<thead class="thead-light">
									<tr>
										<th style="text-align: center;">#</th>
										<th style="text-align: center;">ID Anggota</th>
										<th style="text-align: center;">Nama Anggota</th>
										<th style="text-align: center;">NIK. KTP</th>
										<th style="text-align: center;">No. Telp</th>
										<th style="text-align: center;">Alamat</th>
										<th style="text-align: center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php

									include 'koneksi.php';

									if(isset($_GET['cari'])){
										$cari = $_GET['cari'];
										$data = mysqli_query($koneksi, "SELECT * FROM user WHERE name LIKE '%".$cari."%' AND role_id=2");	
									}else{
										$data = mysqli_query($koneksi, "SELECT * FROM user WHERE role_id=2 AND is_active=1 ORDER BY id ASC");
									}
									$i = 1;
									while($d = mysqli_fetch_array($data)){
										?>
										<tr>
											<th scope="row" width="3%" style="text-align: center"><?= $i; ?></th>
											<td width="5%" style="text-align: center;"><?= $d['id']; ?></td>
											<td width="12%"><?= $d['name']; ?></td>
											<td width="12%" style="text-align: center;"><?= $d['nik']; ?></td>
											<td width="12%" style="text-align: center;"><?= $d['no_hp']; ?></td>
											<td width="20%"><?= $d['alamat']; ?></td>
											<td width="10%" style="text-align: center;">
												<a href="<?= base_url('admin/detail_anggota/') . $d['id'];?>" class="btn btn-sm btn-info"><i class="fas fa-fw fa-eye fa-sm"></i></a>
												<a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEdit<?php echo $d['id'];?>"><i class="fas fa-edit fa-sm"></i></a>
												<a href="<?= base_url('admin/delete_anggota/') . $d['id'];?>" onclick="return confirm('Apakah anda yakin ingin menghapus anggota?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash fa-sm"></i></a>
											</td>
										</tr>
										<?php $i++;?>
									<?php }?>
								</tbody>
							</table>
						</div>
					</div>

					<div class="card-footer bg-white">
						<div class="col d-flex justify-content-end">
							<label>
								<a href="<?= base_url('admin'); ?>" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-reply"></i> Kembali</a>
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End data anggota Koperasi -->
</div>	
</div>	

<!-- Mulai Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahlabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-white">
				<h5 class="modal-title" id="modalTambahlabel">Tambah Anggota</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form class="user" method="post" accept-charset="utf-8" action="<?= base_url('admin/tambah_anggota');?>">
				<div class="modal-body bg-white">
					<?php if(validation_errors()) : ?>
						<div class="alert alert-danger" role="alert">
							<?= validation_errors(); ?>
						</div>
					<?php endif; ?>
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>">
						<?= form_error('name','<small class="text-danger pl-3">','</small>'); ?>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="email" name="email" placeholder="Alamat Email " value="<?= set_value('email'); ?>"> 
						<!-- Untuk menampilkan form error -->
						<?= form_error('email','<small class="text-danger pl-3">','</small>'); ?>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
						<?= form_error('password1','<small class="text-danger pl-3">','</small>'); ?>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" id="password2" name="password2" placeholder="Ulangi Password">
					</div>
					<div class="form form-group">
						<input type="text" id="nik" name="nik" class="form-control" placeholder="Nomor KTP">
					</div>
					<div class="form form-group">
						<input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" max="2001-01-01" placeholder="Tanggal Lahir">
					</div>
					<div class="form form-group">
						<textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat"></textarea>
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
<!-- End Modal -->

<!-- Mulai Modal Edit -->
<?php $i = 0;
foreach ($data as $d) : $i++;
	?>
	<div class="modal fade" id="modalEdit<?php echo $d['id'];?>" tabindex="-1" role="dialog" aria-labelledby="modaEditlabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-white">
					<h5 class="modal-title" id="modalEditlabel">Edit Data Anggota</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?= form_open_multipart('admin/edit_anggota');?>
				<div class="modal-body bg-white">
					<input type="hidden" name="id" value="<?= $d['id'];?>">
					<div class="form-group">
						<input type="text" class="form-control" id="name" name="name" value="<?= $d['name'];?>">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nik" name="nik" value="<?= $d['nik'];?>">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $d['no_hp'];?>">
					</div>
					<div class="form-group">
						<textarea type="text" class="form-control" id="alamat" name="alamat"><?= $d['alamat'];?></textarea>
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
<!-- End Modal -->

<!-- Modal Hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modaHapuslabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalHapuslabel">Anda yakin akan menghapus anggota?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form action="<?= base_url('admin/delete_anggota/') . $d['id'];?>" method="post">
				<div class="modal-body">
					<span>Apakah anda akan menghapus anggota ini?</span>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-sm btn-danger">Hapus</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- End Modal-->







