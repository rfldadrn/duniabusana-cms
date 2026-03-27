<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Master Data</li>
		<li class="breadcrumb-item active" aria-current="page">Data Transaksi</li>
	</ol>
</nav>
<div class="card card-light">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-users"></i> Data Transaksi
		</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="<?= BASE_URL ?>/transaction/create" class="btn btn-outline-primary btn-sm">
					<i class="fa fa-edit"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped table-sm-custom">
				<thead>
					<tr>
						<th width="5%">No</th> 
						<th>Kode Transaksi</th>
						<th>Nama Pelanggan</th>
						<th>Jenis Transaksi</th>
						<th>Tanggal Transaksi</th>
						<th>Tanggal Transaksi</th>
						<th>Status Transaksi</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
                    <?php
					$no = 1;
					foreach ($transactions as $data) {
					?>

						<tr>
							<td class="text-center">
								<?php echo $no++; ?>
							</td>
							<td>
								<?php echo $data['TransactionCode']; ?>
							</td>
							<td>
								<?php echo $data['CustomerName']; ?>
							</td>
							<td>
								<?php echo $data['AgencyName']; ?>
							</td>
							<td>
								<?= MenuHelper::formatTanggal($data['TransactionDate']); ?>
							</td>
							<td>
								<?= MenuHelper::formatTanggal($data['CompletionDate']); ?>
							</td>
							<td>
								under construction
							</td>
							<td class="text-center">
								<a href="<?= BASE_URL ?>/transaction/edit/<?= $data['Id']; ?>" title="Ubah" class="btn btn-outline-success btn-sm">
									<i class="fa fa-edit"></i>
								</a>
								<button type="button" onclick="confirmDelete('<?= BASE_URL ?>/transaction/delete/<?= $data['Id']; ?>', '<?= addslashes($data['CustomerName']); ?>')" title="Hapus" class="btn btn-outline-danger btn-sm">
									<i class="fa fa-trash"></i>
                                </button>
							</td>
						</tr>		

					<?php
					}
					?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
</div>
	<!-- /.card-body -->