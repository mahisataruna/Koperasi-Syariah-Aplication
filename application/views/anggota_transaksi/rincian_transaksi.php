<div class="container-fluid">

	<!-- Breadcrumb -->
	<nav aria-label="breadcrumb" class="main-breadcrumb">
		<ol class="breadcrumb shadow mb-4 bg-white">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
		</ol>
	</nav>
	<!-- /Breadcrumb -->

	<!-- Mulai Content Rincian 1 -->
	<div class="row gutters-sm">
		<div class="col-lg col-md col-sm col-xs">
			<div class="card bg-white shadow mb-4">
				<a href="#collapseCardSaldo" class="d-block card-header py-3 bg-white" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<!-- Judul Konten -->
					<h6 class="m-0 font-weight-bold text-primary">Rincian Transaksi Terakhir</h6>
				</a>
				<div class="collapse show" id="collapseCardSaldo">
					<div class="card-header bg-white">
						<form action="<?= base_url('dom_pdf/cetak_rincian/').$user['id']; ?>" method="post">
							<label>
								<select class="form-control sm" id="jenis_laporan" name="jenis_laporan">
									<option value="semua">Semua Transaksi</option>
									<option value="data_simpanan">Transaksi Simpanan</option>
									<option value="data_pinjaman">Transaksi Pinjaman</option>
									<option value="angsuran">Transaksi Angsuran</option>
									<option value="infaq">Transaksi Infaq</option>
									<!--<option value="bghasil">Bagi Hasil Usaha</option>-->
								</select>
							</label>
							<label>
								<button type="submit" name="cari" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-print fa-sm"></i>&nbsp;Cetak</button>
							</label>
						</form>
					</div>	
					<div class="card-body" style="height: 350px;overflow: auto;">
						<div class="table-responsive table-sm" style="height: 300px;overflow: auto;">
							<table class="table table-bordered table-hover table-xs" id="dataTable" width="100%" cellspacing="0">
								<thead class="thead-light">
									<tr>
										<th style="text-align: center;">#</th>
										<th style="text-align: center;">No Transaksi</th>
										<th style="text-align: center;">Jenis Transaksi</th>
										<th style="text-align: center;">Tanggal Pembayaran</th>
									</tr>
								</thead>
								<tbody>
									<?php
									include 'koneksi.php';
									$id = $user['id'];
									$i=1;
									$simpWjb = mysqli_query($koneksi, "SELECT `transaksi`.`id_transaksi`, `transaksi`.`jenis_transaksi`, `transaksi`.`tanggal`
										FROM `transaksi`
										JOIN `user`
										ON `transaksi`.`id` = `user`.`id`
										WHERE `transaksi`.`id`='$id'
										ORDER BY `transaksi`.`tanggal` DESC");
									while($data = mysqli_fetch_array($simpWjb))
									{
										?>

										<tr>
											<td width="3%" style="text-align: center;"><?= $i++; ?></td>
											<td width="5%" style="text-align: center;"><?= $data['id_transaksi'];?></td>
											<td width="15%" style="text-align: center;"><?= $data['jenis_transaksi'];?></td>
											<td width="10%" style="text-align: center;"><?= $data['tanggal'];?></td>
										</tr>

									<?php } ?>	
								</tbody>
							</table>	
						</div>
					</div>
				</div>		
			</div>	
		</div>	
	</div>	
	<!-- End -->

</div>
</div>