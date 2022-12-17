<div class="container-fluid">
	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb" class="main-breadcrumb">
		<ol class="breadcrumb shadow mb-4 bg-white">
			<li class="breadcrumb-item"><a href="index.html">Home</a></li>
			<li class="breadcrumb-item"><a href="javascript:void(0)">Pengaturan</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
		</ol>
	</nav>
	<!-- /Breadcrumb -->
	<!-- Page Heading -->
	<!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->
	
	<div class="row">
		<div class="col mb-3">
			<div class="card shadow mb-1 bg-white">
				<div class="card-body">
					<div class="e-profile">
						<div class="row">
								<div class="col-12 col-sm-auto mb-3">
									<div class="mx-auto" style="width: 140px;">
										<div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
										<img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
										</div>
									</div>
								</div>
								<div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
									<div class="text-center text-sm-left mb-2 mb-sm-0">
										<h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?= $user['name']; ?></h4>
										<p class="mb-0"><?= $user['email']; ?></p>
										<div class="mt-2">
										<?= form_open_multipart('user/edit');?>
											<div class="custom-file">
												<input type="file" class="custom-file-input" id="image" name="image">
												<label class="custom-file-label" for="image">Cari gambar</label>
											</div>
										</div>
									</div>
									<div class="text-center text-sm-right">
										<span class="badge badge-secondary"><?= $user['name']; ?></span>
										<div class="text-muted"><small>Bergabung <?= date('d F Y', $user['date_created']); ?></small></div>
									</div>
								</div>
							</div>
							<ul class="nav nav-tabs">
								<li class="nav-item"><a href="" class="active nav-link">Edit Profil</a></li>
							</ul>
						<div class="tab-content pt-3">
							<div class="tab-pane active">
								
									<div class="row">
										<div class="col">
											<div class="row">
												<div class="col">
													<div class="form-group">
														<label for="nik" class="col-sm col-form-label">No. KTP</label>
														<div class="col-sm">
															<input type="text" class="form-control" id="nik" name="nik" value="<?= $user['nik'];?>">
															<?= form_error('nik','<small class="text-danger">','</small>'); ?>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col">
													<div class="form-group">
														<label for="name" class="col-sm col-form-label">Nama Lengkap</label>
														<div class="col-sm">
															<input type="text" class="form-control" id="name" name="name" value="<?= $user['name'];?>">
															<?= form_error('name','<small class="text-danger">','</small>'); ?>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col">
													<div class="form-group">
														<label for="tgl_lahir" class="col-sm col-form-label">Tanggal Lahir</label>
														<div class="col-sm">
															<input  type="date" class="form-control col-sm-4" rows="3" name="tgl_lahir" id="tgl_lahir" value="<?= $user['tgl_lahir'];?>">

														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col">
													<div class="form-group">
														<label for="email" class="col-sm col-form-label">Email</label>
														<div class="col-sm">
															<input type="text" class="form-control" id="email" name="email" value="<?= $user['email'];?>" readonly >
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col">
													<div class="form-group">
														<label for="no_hp" class="col-sm col-form-label">No. Telepon</label>
														<div class="col-sm">
															<input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $user['no_hp'];?>">
														</div>														
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col mb-3">
													<div class="form-group">
														<label for="alamat" class="col-sm col-form-label">Alamat</label>
														<div class="col-sm">
															<textarea class="form-control" rows="5" name="alamat" id="alamat"><?= $user['alamat']; ?></textarea>
														</div>
													</div>
												</div>
											</div>

										</div>
									</div>
									
									<div class="col-sm d-flex justify-content-end">
											<button type="submit" class="btn btn-sm btn-primary">Edit Profil</button>
									</div>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!-- konten edit profil -->
		<div class="row">
			<div class="col-lg-8">


			<!-- Disini Form Multipart 
				Untuk Menu Edit data user

			-->



		</div>

	</div>


</div>


<!-- Content Row -->

</div>
<!-- End of Main Content -->