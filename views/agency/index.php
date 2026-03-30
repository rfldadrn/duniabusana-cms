<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Master Data</li>
		<li class="breadcrumb-item active" aria-current="page">Data Instansi</li>
	</ol>
</nav>
<div class="card card-light">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-university"></i> Data Instansi
		</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="<?= BASE_URL ?>/agency/create" class="btn btn-outline-primary btn-sm">
					<i class="fa fa-edit"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped table-sm-custom">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th>Nama Instansi</th>
						<th>Deskripsi</th>
						<th>Tanggal Mulai</th>
						<th>Tanggal Selesai</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
                    <?php
					$no = 1;
					foreach ($agencies as $data) {
					?>

						<tr>
							<td class="text-center">
								<?= $no++; ?>
							</td>
							<td>
								<a class="text-decoration-none" href="<?= BASE_URL ?>/agency/edit/<?= $data['Id']; ?>"><?= $data['Name']; ?></a>
							</td>
							<td>
								<?= $data['Description']; ?>
							</td>
							<td>
								<?=  MenuHelper::formatTanggal($data['StartDate']) ?>
							</td>
							<td>
								<?=  MenuHelper::formatTanggal($data['TargetDate']) ?>
							</td>
							<td class="text-center">
								<a href="<?= BASE_URL ?>/agency/edit/<?= $data['Id']; ?>" title="Ubah" class="btn btn-outline-success btn-sm">
									<i class="fa fa-edit"></i>
								</a>
								<button type="button" onclick="confirmDelete('<?= BASE_URL ?>/agency/delete/<?= $data['Id']; ?>', '<?= addslashes($data['Name']); ?>')" title="Hapus" class="btn btn-outline-danger btn-sm">
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