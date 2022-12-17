<div class="container-fluid">

	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb" class="main-breadcrumb">
		<ol class="breadcrumb shadow mb-4">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
		</ol>
	</nav>
	<!-- /Breadcrumb -->

	<div class="row">
		<div class="col-lg col-md col-sm">
			<?= $this->session->flashdata('message'); ?>
			<div class="card shadow mb-4">
				<div class="card-body">
					<div class="text-center">
						<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10rem; position: auto" src="<?= base_url('assets/img/animate_simpan/cancel.svg'); ?>" alt="">
					</div>
					<br>
					<h5 style="text-align: center;">Hallo <b><?= $user['name'];?>.</b></h5> 
					<h6 style="text-align: center;">Maaf, pengajuan transaksimu belum berhasil. Kamu masih memiliki pinjaman aktif.<br> Hubungi administrator untuk informasi lebih lanjut. <a target="_blank" rel="nofollow" href="https://api.whatsapp.com/send?phone=6281363455700">Klik disini!</a></h6><br>
					<div class="card-footer bg-white">
						<br>
						<center>
							<a href="<?= base_url('anggota_transaksi'); ?>" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-reply"></i>   &nbsp;Kembali</a>
							<a href="" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-home"></i>   &nbsp;Beranda</a>
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>	



</div>
</div>