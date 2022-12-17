<div class="container-fluid">

	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb" class="main-breadcrumb">
		<ol class="breadcrumb shadow mb-4 bg-white">
			<li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
			<li class="breadcrumb-item"><a href="javascript:void(0)">Menu</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
		</ol>
	</nav>
	<!-- /Breadcrumb -->

	<!-- Mulai card menu-->
	<div class="row">
		<div class="col-lg-6 col-md col-sm">
			<!-- Pesan error validation-->
			<?= form_error('menu', '<div class="alert alert-danger" role="alert">', ' </div>'); ?>
			<?= $this->session->flashdata('message'); ?>
			<!-- Pesan error validation-->
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardMenu" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Daftar Menu </h6>
				</a>
				<div class="collapse show" id="collapseCardMenu">
					<div class="card-header bg-white">
						<div class="mx-auto p-2">
							<label>
								<a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalMenu">
								<i class="fas fa-fw fa-plus fa-sm text-white-50"></i> Tambah Menu</a>
							</label>
						</div>
					</div>
					<div class="card-body">
						<!-- Mulai card tabel -->
						<div class="table-responsive table-sm" style="height: 380px;overflow: auto;">
							<div class="table-responsive">
									<table class="table table-bordered table-hover table-sm" id="tabelanggota" width="100%" cellspacing="0">
										<thead class="thead-light">
											<tr>
												<th class="sm" style="text-align: center;">#</th>
												<th>Menu</th>
												<th style="text-align: center;">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1; ?>
											<?php foreach($menu as $m) : ?>
												<tr id="example1_filter">
													<th scope="row" width="2%" style="text-align: center;"><?= $i; ?></th>
													<td width="20%"><?= $m['menu']; ?></td>
													<td width="4%" style="text-align: center;">
														<a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEditMenu<?php echo $m['id'];?>"><i class="fas fa-pencil-alt fa-sm"></i></a>
														<a href="<?= base_url('menu/delete_menu/') . $m['id'];?>" onclick="return confirm('Apakah anda yakin ingin menghapus menu?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash fa-sm"></i></a>
													</td>
												</tr>
												<?php $i++; ?>
											<?php endforeach; ?> 
										</tbody>
									</table>
							</div>
						</div>
					</div>
				</div>
			</div>   
		</div>
	</div>

</div>
</div>

<!-- Modal Tambah Menu -->
<div class="modal fade col-sm" id="modalMenu" tabindex="-1" role="dialog" aria-labelledby="modalMenulabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-white">
				<h5 class="modal-title" id="modalMenulabel">Tambah Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('menu'); ?>" method="post">
				<div class="modal-body bg-white">
					<div class="form-group">
						<input type="text" class="form-control" id="menu" name="menu" placeholder="Nama Menu">
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

<!-- Modal Edit -->
<?php $i = 0;
foreach ($menu as $m) : $i++;
?>
<div class="modal fade col-sm" id="modalEditMenu<?php echo $m['id'];?>" tabindex="-1" role="dialog" aria-labelledby="modalEditMenulabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-white">
				<h5 class="modal-title" id="modalEditMenulabel">Edit Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open_multipart('menu/edit_menu');?>
				<div class="modal-body bg-white">
					<input type="hidden" name="id" id="id" value="<?php echo $m['id']; ?>">
					<div class="form-group">
						<input type="text" class="form-control" id="menu" name="menu" value="<?= $m['menu'] ?>">
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