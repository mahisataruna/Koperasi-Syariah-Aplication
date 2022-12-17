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
					<h6 class="m-0 font-weight-bold text-primary">Buku Angsuran Anggota</h6>
				</a>

				<!-- Card Content - Collapse -->
				<div class="collapse show" id="collapseCardAnggota">
					<div class="col-sm-12 mx-auto">
						<!-- Info Angsuran Anggota -->
						<?php
						include 'koneksi.php';
						$id = $user['id'];
						$i=0;
						$simpWjb = mysqli_query($koneksi, "SELECT SUM(jumlah_angsuran), `tb_angsuran`.`id`, `tb_angsuran`.`name`
							FROM `tb_angsuran`
							JOIN `transaksi`
							ON `tb_angsuran`.`id_transaksi` = `transaksi`.`id_transaksi`
							JOIN `user`
							ON `tb_angsuran`.`id` = `user`.`id`
							AND `user`.`id` = '$id'");
						while($data = mysqli_fetch_array($simpWjb))
						{
							?>
							<div class="card-header bg-white" style="height: 100px">
								<small><i class="fas fa-fw fa-bookmark"></i> Nomor Anggota &nbsp;: <b><?= $user['id']; ?></b></small><br>
								<small><i class="fas fa-fw fa-user"></i> Nama Anggota &nbsp;&nbsp;&nbsp;: <b><?= $user['name']; ?></b></small><br>
								<small><i class="fas fa-fw fa-credit-card"></i> Total Angsur  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>Rp. <?= number_format($data['SUM(jumlah_angsuran)']);?></b></small>
							</div>
						<?php } ?>
						<!-- End Info -->
						<div class="card-body">
							<div class="table-responsive table-sm" style="height: 360px;overflow: auto;">
								<table class="table table-bordered table-hover table-xs" id="dataTable" width="100%" cellspacing="0">
									<thead class="thead-light">
										<tr>
											<th scope="col-sm" style="text-align: center;">#</th>
											<th style="text-align: center;">No Angsuran</th>
											<th style="text-align: center;">No Pinjaman</th>
											<th style="text-align: center;">No Transaksi</th>
											<th style="text-align: center;">Angsuran Ke</th>
											<th style="text-align: center;">Nominal</th>
											<th style="text-align: center;">Tanggal Angsur</th>
											<th style="text-align: center;">Sisa</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$i=1;
										foreach ($bukuAngsurAnggota as $ba) :
											{
												$nominal = number_format($ba->jumlah_angsuran);
												$nominal1 = number_format($ba->sisa_pinjam);
												?>
												<tr>
													<th scope="row" width="3%" style="text-align: center;"><?= $i; ?></th>
													<td width="5%" style="text-align: center;"><?= $ba->id_angsuran; ?></td>
													<td width="5%" style="text-align: center;"><?= $ba->id_pinjaman; ?></td>
													<td width="5%" style="text-align: center;"><?= $ba->id_transaksi; ?></td>
													<td width="15%" style="text-align: center;"><?= $ba->angsuran_ke; ?></td>
													<td width="15%" style="text-align: center;">Rp. <?= $nominal;?></td>
													<td width="15%" style="text-align: center;"><?= $ba->tanggal;?></td>
													<td width="15%" style="text-align: center;">Rp. <?= $nominal1;?></td>
													
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