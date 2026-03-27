<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Master Data</li>
		<li class="breadcrumb-item active" aria-current="page">Data Users</li>
	</ol>
</nav>
<div class="card card-light">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-users"></i> Data Users
		</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="<?= BASE_URL ?>/user/create" class="btn btn-outline-primary btn-sm">
					<i class="fa fa-edit"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped table-sm-custom">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th>Nama User</th>
						<th>Username</th>
						<th>Role User</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
                    <?php
					$no = 1;
					foreach ($users as $data) {
					?>

						<tr>
							<td class="text-center">
								<?php echo $no++; ?>
							</td>
							<td>
								<?php echo $data['nama_pengguna']; ?>
							</td>
							<td>
								<?php echo $data['username']; ?>
							</td>
							<td>
								<?php echo $data['rolename']; ?>
							</td>
							<td class="text-center">
								<a href="<?= BASE_URL ?>/user/edit/<?= $data['id']; ?>" title="Ubah" class="btn btn-outline-success btn-sm">
									<i class="fa fa-edit"></i>
								</a>
								<button type="button" onclick="confirmDelete('<?= BASE_URL ?>/user/delete/<?= $data['id']; ?>', '<?= addslashes($data['nama_pengguna']); ?>')" title="Hapus" class="btn btn-outline-danger btn-sm">
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