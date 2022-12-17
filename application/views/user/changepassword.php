<!-- Pengerjaan Kodingan Change Password -->
<div class="container-fluid">

	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb" class="main-breadcrumb">
		<ol class="breadcrumb shadow mb-4 bg-white">
			<li class="breadcrumb-item"><a href="index.html">Home</a></li>
			<li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
		</ol>
	</nav>
	<!-- /Breadcrumb -->

	<div class="row">
		<div class="col-sm-6 mb-3">
			<div class="card shadow mb-2 bg-white">
				<!-- Card Header -->
				<div class="card-header py-3 bg-white">
					<h6 class="m-0 font-weight-bold text-primary">Ganti Password</h6>
				</div>
				<div class="card-body">
					<?= $this->session->flashdata('message');?>
					<form action="<?= base_url('user/changepassword');?>" method="post">
						<div class="row">
							<div class="col-sm mb-3">

								<div class="row">
									<div class="col">
										<div class="form-group">
											<label for="current_password">Password sekarang</label>
											<input type="password" class="form-control" id="current_password" name="current_password" placeholder="••••••">
											<?= form_error('current_password','<small class="text-danger">','</small>'); ?>

										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col">
										<div class="form-group">
											<label for="new_password1">Password Baru</label>
											<input type="password" class="form-control" id="new_password1" name="new_password1"placeholder="••••••">
											<?= form_error('new_password1','<small class="text-danger">','</small>'); ?>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col">
										<div class="form-group">
											<label for="new_password2">Konfirmasi <span class="d-none d-xl-inline">Password</span></label>
											<input type="password" class="form-control" id="new_password2" name="new_password2"  placeholder="••••••">
											<?= form_error('new_password2','<small class="text-danger">','</small>'); ?>
										</div>
									</div>
								</div>
							</div>

						</div>

						<div class="form-group">
							<div class="col d-flex justify-content-end">
								<button class="btn btn-sm btn-primary" type="submit">Simpan</button>
							</div>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>



</div>