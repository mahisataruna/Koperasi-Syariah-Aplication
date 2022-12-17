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
		<div class="col-lg col-md col-sm">
			<!-- Pesan error validation-->
			<?php if(validation_errors()) : ?>
				<div class="alert alert-danger" role="alert">
					<?= validation_errors(); ?>
				</div>
			<?php endif; ?>

			<?= $this->session->flashdata('message'); ?>
			<!-- Pesan error validation-->
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardSubmenu" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Daftar Submenu </h6>
				</a>
				<div class="collapse show" id="collapseCardSubmenu">
					<div class="card-header bg-white">
						<div class="mx-auto p-2">
							<label>
								<a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalSubMenu">
									<i class="fas fa-fw fa-plus fa-sm text-white-50"></i> Tambah Submenu</a>
								</label>
							</div>
						</div>

						<div class="card-body">
							<!-- Mulai card tabel -->
							<div class="table-responsive" style="height: 300px;overflow: auto;">
								<table id="dataTable" class="table table-bordered table-hover table-xs" width="100%" cellspacing="0">
									<thead class="thead-light">
										<tr>
											<th scope="col-sm" style="text-align: center;">#</th>
											<th scope="col-sm">Nama Submenu</th>
											<th scope="col-sm" style="text-align: center;">Menu</th>
											<th scope="col-sm" style="text-align: center;">Url</th>
											<th scope="col-sm" style="text-align: center;">Icon</th>
											<th scope="col-sm" style="text-align: center;">Status Menu</th>
											<th scope="col-sm" style="text-align: center;">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i=1; ?>
										<?php foreach ($subMenu as $sm) :  ?>
											<tr id="example1_filter">
												<th scope="row" width="2%" style="text-align: center;"><?= $i; ?></th>
												<td><?= $sm['title']; ?></td>
												<td style="text-align: center;"><?= $sm['menu']; ?></td>
												<td style="text-align: center;"><?= $sm['url']; ?></td>
												<td><?= $sm['icon']; ?></td>
												<td style="text-align: center;">
													<?php
													if ($sm['is_active']==1) {
														echo "Aktif";
													} else {
														echo "Tidak Aktif";
													}
													?>
													</td>
												<td width="10%" style="text-align: center;">
													<a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEditSubMenu<?= $sm['id']; ?>"><i class="fas fa-pencil-alt fa-sm"></i></a>
													<a href="<?= base_url('menu/delete_submenu/'). $sm['id'];?>" onclick="return confirm('Apakah anda yakin ingin menghapus submenu ini?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash fa-sm"></i></a>
												</td>
											</tr>
											<?php $i++; ?>
										<?php endforeach ; ?>

									</tbody>
								</table>
							</div>
							<!-- End -->
						</div>
					</div>
				</div>
			</div>   
			<!-- end -->
		</div>
		<!-- End -->




	</div>
</div>



<!-- Modal Tambah Submenu -->
<div class="modal fade col-sm" id="modalSubMenu" tabindex="-1" role="dialog" aria-labelledby="modalSubMenulabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-white">
				<h5 class="modal-title" id="modalSubMenulabel">Tambah Submenu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('menu/submenu'); ?>" method="post">
				<div class="modal-body bg-white">
					<div class="form-group">
						<input type="text" class="form-control" id="title" name="title" placeholder="Nama Submenu">
					</div>
					<div class="form-group">
						<select name="menu_id" id="menu_id" class="form-control">
							<option value="">Pilih Menu</option>
							<?php foreach($menu as $m) : ?>
								<option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>	
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="url" name="url" placeholder="Url Submenu">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="icon" name="icon" placeholder="Icon Submenu">
					</div>
					<div class="form-group">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
							<label class="form-check-label" for="is_active">
								Active?
							</label>
						</div>
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

<!-- Modal Edit Submenu -->
<?php $i = 0;
foreach($subMenu as $sm) : $i++;
?>
<div class="modal fade col-sm" id="modalEditSubMenu<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditSubMenulabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-white">
					<h5 class="modal-title" id="modalSubMenulabel">Tambah Submenu</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?= form_open_multipart('menu/edit_submenu');?>
					<div class="modal-body bg-white">
						<input type="hidden" class="form-control" id="id" name="id" value="<?= $sm['id']; ?>">
						<div class="form-group">
							<input type="text" class="form-control" id="title" name="title" value="<?= $sm['title']; ?>">
						</div>
						<div class="form-group">
							<select name="menu_id" id="menu_id" class="form-control" value="<?= $sm['menu_id']; ?>">
								<option value="">Pilih Menu</option>
								<?php foreach($menu as $m) : ?>
									<option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>	
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="url" name="url" value="<?= $sm['url']; ?>">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="icon" name="icon" value="<?= $sm['icon']; ?>">
						</div>
						<div class="form-group">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
								<label class="form-check-label" for="is_active">
									Active?
								</label>
							</div>
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
<?php endforeach; ?>