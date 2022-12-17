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
					<h6 class="m-0 font-weight-bold text-primary">Buku Pinjaman Anggota</h6>
				</a>

				<!-- Card Content - Collapse -->
				<div class="collapse show" id="collapseCardAnggota">
					<div class="col-sm-12 mx-auto">	
					<?php
					include 'koneksi.php';
					$id = $user['id'];
					$i=0;
					$pjmagt = mysqli_query($koneksi, "SELECT SUM(nominal), `user`.`id`, `user`.`name`
						FROM `tb_pinjaman`
						JOIN `transaksi`
						ON `tb_pinjaman`.`id_transaksi` = `transaksi`.`id_transaksi`
						JOIN `user`
						ON `tb_pinjaman`.`id` = `user`.`id`
						AND `user`.`id` = '$id'");
					while($data = mysqli_fetch_array($pjmagt))
					{
						?>
						<div class="card-header bg-white" style="height: 120px">
							<small><i class="fas fa-fw fa-bookmark"></i> Nomor Anggota &nbsp;: <b><?= $data['id']; ?></b></small><br>
							<small><i class="fas fa-fw fa-user"></i> Nama Anggota &nbsp;&nbsp;&nbsp;: <b><?= $data['name']; ?></b></small><br>
							<small><i class="fas fa-fw fa-credit-card"></i> Sisa Pinjaman&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b>Rp. <?= number_format($data['SUM(nominal)']);?></b></small><br>
							<small><i class="fas fa-fw fa-calculator"></i> Pembayaran Terakhir :</small>
						</div>
					<?php } ?>
						<div class="card-body">
							<div class="table-responsive table-sm" style="height: 300px;overflow: auto;">
								<table class="table table-bordered table-hover table-xs" id="dataTable" width="100%" cellspacing="0">
									<thead class="thead-light">
										<tr>
											<th scope="col-sm" style="text-align: center;">#</th>
											<th style="text-align: center;">Nomor Pinjaman</th>
											<th style="text-align: center;">Nomor Transaksi</th>
											<th style="text-align: center;">Tanggal Pinjam</th>
											<th style="text-align: center;">Nominal Pinjam</th>
											<th style="text-align: center;">Lama</th>
											<th style="text-align: center;">Status</th>
											<th style="text-align: center;">Lihat Detail</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i=1;
										foreach ($bukuPinjamAnggota as $bp) :
											{
												$nominal = number_format($bp->nominal);
												?>
												<tr>
													<td scope="row" width="3%" style="text-align: center;"><?= $i; ?></td>
													<td width="5%" style="text-align: center;"><?= $bp->id_pinjaman; ?></td>
													<td width="5%" style="text-align: center;"><?= $bp->id_transaksi; ?></td>
													<td width="10%" style="text-align: center;"><?= $bp->tanggal; ?></td>
													<td width="15%" style="text-align: center;">Rp. <?= $nominal; ?></td>
													<td width="5%" style="text-align: center;"><?= $bp->lama_pinjam; ?></td>
													<td width="10%" style="text-align: center;">
														<?php
														if($bp->status == '0')
														{
															echo "BELUM LUNAS";
														}else{
															echo "LUNAS";
														}
														?>
													</td>
													<td width="15%" style="text-align: center;">
														<a href="" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalBukuPinj<?= $bp->id_pinjaman; ?>"><i class="fas fa-eye fa-sm"></i></a>
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

<!-- Modal Faktur -->
<?php
$i=1;
foreach ($bukuPinjamAnggota as $bp) :
	{
		$nominal = number_format($bp->nominal);
		?>
		<div class="modal fade" id="modalBukuPinj<?= $bp->id_pinjaman; ?>" tabindex="-1" role="dialog" aria-labelledby="modaTambahSimpanlabel" aria-hidden="true">
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
								<strong><?= $bp->tanggal; ?></strong>
							</small>

							<span class="float-right">
								<small> Status:
									<strong>Disetujui</strong>
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
											<th class="center">No. Pinjaman</th>
											<th>No. Transaksi</th>
											<th class="right">Tanggal</th>
											<th class="right">Jumlah Pinjaman</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="center">1</td>
											<td class="left strong"><?= $bp->id_pinjaman; ?></td>
											<td class="left strong"><?= $bp->id_transaksi; ?></td>
											<td class="right"><?= $bp->tanggal; ?></td>
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
											Keterangan :
											<?php
														if($bp->status == '0')
														{
															echo "BELUM LUNAS";
														}else{
															echo "LUNAS";
														}
														?>
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