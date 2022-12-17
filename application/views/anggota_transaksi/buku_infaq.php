<div class="container-fluid">

	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb" class="main-breadcrumb">
		<ol class="breadcrumb shadow mb-4 bg-white">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
		</ol>
	</nav>
	<!-- /Breadcrumb -->

	<!-- Mulai Card 1 -->
	<div class="row gutters-sm">
		<div class="col-sm">
			<?= $this->session->flashdata('message'); ?>
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardAnggota" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Buku Infaq Anggota</h6>
				</a>

				<!-- Card Content - Collapse -->
				<div class="collapse show" id="collapseCardAnggota">
					<div class="col-sm-12 mx-auto">
						<!-- Header Info Infaq Anggota -->
						<?php
						include 'koneksi.php';
						$id = $user['id'];
						$i=0;
						$simpWjb = mysqli_query($koneksi, "SELECT SUM(nominal), `tb_infaq`.`id`, `tb_infaq`.`name`
							FROM `tb_infaq`
							JOIN `transaksi`
							ON `tb_infaq`.`id_transaksi` = `transaksi`.`id_transaksi`
							JOIN `user`
							ON `tb_infaq`.`id` = `user`.`id`
							WHERE `user`.`id` = '$id'");
						while($data = mysqli_fetch_array($simpWjb))
						{
							?>
							<div class="card-header bg-white" style="height: 100px">
								<small><i class="fas fa-fw fa-bookmark"></i> Nomor Anggota &nbsp;: <b><?= $user['id']; ?></b></small><br>
								<small><i class="fas fa-fw fa-user"></i> Nama Anggota &nbsp;&nbsp;&nbsp;: <b><?= $user['name']; ?></b></small><br>
								<small><i class="fas fa-fw fa-credit-card"></i> Total Infaq &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>Rp. <?= number_format($data['SUM(nominal)']);?></b></small>
							</div>
						<?php } ?>
						<!-- End Info -->
						<div class="card-body">
							<div class="table-responsive table-sm" style="height: 300px;overflow: auto;">
								<table class="table table-bordered table-hover table-xs" id="dataTable" width="100%" cellspacing="0">
									<thead class="thead-light">
										<tr>
											<th scope="col-sm" style="text-align: center;">#</th>
											<th style="text-align: center;">Nomor Infaq</th>
											<th style="text-align: center;">Nomor Transaksi</th>
											<th style="text-align: center;">Tanggal</th>
											<th style="text-align: center;">Nominal Infaq</th>
											<th style="text-align: center;">Lihat Detail</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i=1;
										foreach ($bukuInfaqAnggota as $bi) :
											{
												$nominal = number_format($bi->nominal);
												?>
												<tr>
													<td scope="row" width="3%" style="text-align: center;"><?= $i; ?></td>
													<td width="5%" style="text-align: center;"><?= $bi->id_infaq; ?></td>
													<td width="5%" style="text-align: center;"><?= $bi->id_transaksi; ?></td>
													<td width="15%" style="text-align: center;"><?= $bi->tanggal; ?></td>
													<td width="20%" style="text-align: center;">Rp. <?= $nominal; ?></td>
													<td width="5%" style="text-align: center;">
														<a href="" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalFakturInfaq<?= $bi->id_infaq; ?>"><i class="fas fa-eye fa-sm"></i></a>
													</td>
												</tr>
												<?php $i++;?>
											<?php } ?>
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
	<!-- End card simpanan Koperasi -->
</div>
</div>

<!-- Modal Faktur Infaq -->
<?php
$i=1;
foreach ($bukuInfaqAnggota as $bi) :
	{
		$nominal = number_format($bi->nominal);
		?>
		<div class="modal fade" id="modalFakturInfaq<?= $bi->id_infaq;?>" tabindex="-1" role="dialog" aria-labelledby="modaTambahSimpanlabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalTambahSimpanlabel">Detail</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="" method="post">
						<div class="modal-body">
							<small>Invoice
								<strong><?= $bi->tanggal; ?></strong>
							</small>

							<span class="float-right">
								<small> Status:
									<strong> 
										<?php
										if($bi->validasi == '0')
										{
											echo "Belum disetujui";
										}else{
											echo "Disetujui";
										}
										?>
									</strong>
								</small>
							</span>
							<hr>
							<div class="row mb-4">
								<div class="col-sm-6">
									<h6 class="mb-3">Dari:</h6>
									<div>
										<small><strong>Koperasi Syariah Bundo Saiyo Padang</strong></small>
									</div>
									<div><small>Jl. SMA 13 Tanjung Aur, Balai Gadang, Koto Tangah, Kota Padang</small></div>
									<div><small>Email: koperasi.bundosaiyo@gmail.com</small></div>
									<div><small>Phone: 081363455700</small></div>
								</div>

								<div class="col-sm-6">
									<h6 class="mb-3">Kepada:</h6>
									<div>
										<small><strong><?= $user['name']; ?></strong></small>
									</div>
									<div><small><?= $user['alamat']; ?></small></div>
									<div><small>Email: <?= $user['email']; ?></small></div>
									<div><small>Phone: <?= $user['no_hp'];?></small></div>
								</div>
							</div>
							<div class="table-responsive-sm">
								<table class="table table-striped">
									<thead>
										<tr>
											<th class="center">#</th>
											<th>No. Transaksi</th>
											<th>Nama Anggota</th>
											<th>Jenis Transaksi</th>
											<th class="right">Tanggal</th>
											<th class="right">Jumlah Bayar</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="center">1</td>
											<td class="left strong"><?= $bi->id_transaksi; ?></td>
											<td class="left"><?= $bi->name; ?></td>
											<td class="left"><?= $bi->jenis_transaksi; ?></td>
											<td class="right"><?= $bi->tanggal; ?></td>
											<td class="right">Rp. <?= $nominal; ?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="row">
								<div class="col-lg-4 col-sm-5">

								</div>

								<div class="col-lg-4 col-sm-5 ml-auto">
									<table class="table table-clear">
										<tbody>
											<tr>
												<td class="left">
													<strong>Total</strong>
												</td>
												<td class="right">
													<strong>Rp. <?= $nominal; ?></strong>
												</td>
											</tr>
										</tbody>
									</table>

								</div>

							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php $i++;?>
	<?php } ?>
<?php endforeach; ?>
<!-- End -->