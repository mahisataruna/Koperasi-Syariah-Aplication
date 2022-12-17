<div class="container-fluid">

	<!-- Mulai Breadcrumb -->
	<nav aria-label="breadcrumb" class="main-breadcrumb">
		<ol class="breadcrumb shadow mb-4 bg-white">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Data Anggota</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
		</ol>
	</nav>
	<!-- End Breadcrumb -->

	<!-- Mulai card -->
	<div class="row gutters-sm">

		<div class="col-sm-4">
			<div class="card shadow mb-4 p-3 bg-white" style="height: 450px;overflow: auto;">
				<div class="card-body text-center bg-gradient-dark rounded">
					<div class="user-box">
						<img src="<?= base_url('assets/img/profile/') . $detail['image']; ?>" alt="user avatar">
					</div>
					<h5 class="mb-1 text-white"><?php echo $detail['name']; ?></h5>
					<small class="text-white">Terdaftar sejak : <?= date('d F Y', $detail['date_created']); ?></small><br>
					<?php $i=1; ?>
					<?php foreach ($simpanP as $sa) :  ?>
						<small class="text-white">Simpanan Pokok : 
							<?php
							if($sa['SUM(nominal)']==100000){
								echo "<a href='' class='badge badge-primary'>LUNAS <i class='fas fa-fw fa-sm fa-check'></i></a>";
							} else {
								echo "<a href='' class='badge badge-danger'>BELUM LUNAS</a>";
							}
							
							?>
								
						</small>
					<?php $i++; ?>
					<?php endforeach ; ?>
				</div>
				<div class="card-body">
					<div class="row text-center mt-1">
						<div class="col p-3">
							<?php $i=1; ?>
							<?php foreach ($simpanA as $sa) :  ?>

								<small class="mb-0">Simp. Wajib</small><hr>
								<h6 class="mb-1 line-height-1 font-weight-bold">Rp. <?= number_format($sa['SUM(nominal)']);?></h6>
								<?php $i++; ?>
							<?php endforeach ; ?>					
						</div>

						<div class="col p-3">
							<?php $a=1; ?>
							<?php foreach ($pinjamA as $pa) :
								?>
								<small class="mb-0">Pinjaman</small><hr>
								<h6 class="mb-1 line-height-1 font-weight-bold">Rp. <?= number_format($pa['SUM(nominal)']);?></h6>
								<?php $a++; ?>
							<?php endforeach ; ?>	
						</div>

						<div class="col p-3">
							<?php $b=1; ?>
							<?php foreach ($infaqA as $ia) :
								?>
								<small class="mb-0">Infaq</small>
								<hr>
								<h6 class="mb-1 line-height-1 font-weight-bold">Rp. <?= number_format($ia['SUM(nominal)']);?></h6>
								<?php $b++; ?>
							<?php endforeach ; ?>	
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-8">
			<div class="card shadow mb-4 p-3 bg-white" style="height: 450px;overflow: auto;">
				<div class="card-body">
					<div class="row gutters-sm">
						<div class="col-sm-4">
							<small class="mb-0">No. Kartu Tanda Penduduk</small>
						</div>
						<div class="col-sm-8 text-secondary">
							<?= $detail['nik']; ?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-4">
							<small class="mb-0">Nama Lengkap</small>
						</div>
						<div class="col-sm-8 text-secondary">
							<?= $detail['name']; ?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-4">
							<small class="mb-0">Tanggal Lahir</small>
						</div>
						<div class="col-sm-8 text-secondary">
							<?= $detail['tgl_lahir']; ?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-4">
							<small class="mb-0">Email</small>
						</div>
						<div class="col-sm-8 text-secondary">
							<?= $detail['email']; ?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-4">
							<small class="mb-0">Telepon/HP</small>
						</div>
						<div class="col-sm-8 text-secondary">
							<?= $detail['no_hp']; ?>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-4">
							<small class="mb-0">Alamat</small>
						</div>
						<div class="col-sm-8 text-secondary">
							<?= $detail['alamat']; ?>
						</div>
					</div>
					<hr>
				</div>
				<div class="col d-flex justify-content-end">
					<label>
						<a href="<?= base_url('admin/data_anggota'); ?>" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-sm fa-reply"></i> Kembali</a>
					</label>
				</div>
			</div>
		</div>
	</div>
	<!-- End -->
</div>

</div>
