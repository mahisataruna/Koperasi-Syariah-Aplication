<div class="container-fluid">

	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb" class="main-breadcrumb">
		<ol class="breadcrumb shadow mb-4 bg-white">
			<li class="breadcrumb-item"><a href="index.html">Home</a></li>
			<li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
		</ol>
	</nav>
	<!-- /Breadcrumb -->

	<!-- Mulai card menu-->
	<div class="row gutters-sm">
		<div class="col-md-6 mb-3">
			<!-- Pesan error validation-->
			<?= $this->session->flashdata('message'); ?>
			<!-- End Pesan -->
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardInformasi" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Role  </h6>
				</a>
				<div class="collapse show" id="collapseCardInformasi">
					<div class="card-body">
						<!-- Mulai card tabel -->
						<h5>Role : <?= $role['role'];?></h5>
						<div class="table-responsive table-sm">
							<div class="d-flex">
								<div class="d-flex align-items-justify">
									
								</div>
								<!-- Mulai tabel -->
								<table class="table table-bordered table-hover table-sm" id="tabelanggota" width="100%" cellspacing="0">
									<thead class="thead-light">
										<tr>
											<th scope="col-sm">#</th>
											<th scope="col-sm">Menu</th>
											<th scope="col-sm"><center>Hak Akses</center></th>
										</tr>
									</thead>
									<tbody>
										<?php $i=1; ?>
										<?php foreach($menu as $m) : ?>
											<tr id="example1_filter">
												<th scope="row" width="2%"><?= $i; ?></th>
												<td width="20%"><?= $m['menu'];?></td>
												<td width="10%">
													<div class="form-check text-center">
														<input class="form-check-input" type="checkbox" <?= check_access($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>"> 
													</div>
												</td>
												
											</tr>
											<?php $i++; ?>
										<?php endforeach; ?> 
									</tbody>
								</table>
								<!-- End -->

							</div>	
						</div> 	
						<div class="col d-flex justify-content-end">
							<label>
								<a href="<?= base_url('admin/role'); ?>" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-sm fa-reply"></i> Kembali</a>
								</label>
							</div>
						</div>
					</div>	
				</div>	
			</div>
		</div>
	</div>

</div>	