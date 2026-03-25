<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Master Data</li>
		<li class="breadcrumb-item active" aria-current="page">Data Pelanggan</li>
	</ol>
</nav>
<div class="card card-light">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-users"></i> Data Pelanggan
		</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="<?= BASE_URL ?>/customer/create" class="btn btn-outline-primary btn-sm">
					<i class="fa fa-edit"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped table-sm-custom">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th>Nama Pelanggan</th>
						<th>Nomor Telp</th>
						<th>Jenis Kelamin</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
                    <?php
					$no = 1;
					foreach ($customers as $data) {
					?>

						<tr>
							<td class="text-center">
								<?php echo $no++; ?>
							</td>
							<td>
								<?php echo $data['Name']; ?>
							</td>
							<td>
								<?php echo $data['PhoneNumber']; ?>
							</td>
							<td>
								<?php echo $data['Gender']; ?>
							</td>
							<td class="text-center">
								<a href="<?= BASE_URL ?>/customer/edit/<?= $data['Id']; ?>" title="Ubah" class="btn btn-outline-success btn-sm">
									<i class="fa fa-edit"></i>
								</a>
								<button type="button" onclick="confirmDelete('<?= BASE_URL ?>/customer/delete/<?= $data['Id']; ?>', '<?= addslashes($data['Name']); ?>')" title="Hapus" class="btn btn-outline-danger btn-sm">
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