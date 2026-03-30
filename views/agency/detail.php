<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Master Data</li>
		<li class="breadcrumb-item" aria-current="page"><a href="<?= BASE_URL ?>/agencies">Data Instansi</a></li>
		<li class="breadcrumb-item active" aria-current="page">Form Data Instansi</li>
	</ol>
</nav>
<div class="card card-light">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-university"></i> Form Data Instansi
		</h3>
	</div>
	<form action="<?= BASE_URL ?><?php if (isset($agency['Id'])) { echo '/agency/update'; } else { echo '/agency/store'; } ?>" method="post">
		<div class="card-body">
			<input type="text" class="form-control" id="Id" name="Id" value="<?= $agency['Id'] ?? '' ?>" hidden>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label required-label">Nama Instansi</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="name" name="Name" placeholder="Nama instansi" required value="<?= $agency['Name'] ?? '' ?>">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label required-label">Deskripsi</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="description" name="Description" placeholder="Deskripsi" required value="<?= $agency['Description'] ?? '' ?>">
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-sm-2 col-form-label required-label">Tanggal Mulai</label>
				<div class="col-sm-4">
					<input type="date" class="form-control" id="startDate" name="StartDate" required value="<?= $agency['StartDate'] != null ? date('Y-m-d', strtotime($agency['StartDate'])) : null ?>">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label required-label">Tanggal Selesai</label>
				<div class="col-sm-4">
					<input type="date" class="form-control" id="targetDate" name="TargetDate" required value="<?= $agency['TargetDate'] != null ? date('Y-m-d', strtotime($agency['TargetDate'])) : null ?>">
				</div>
			</div>	
		</div>
		<div class="card-footer">
			<a href="<?= BASE_URL ?>/agencies" title="Kembali" class="btn btn-secondary float-right">Batal</a>
			<?php 
				if (!isset($agency['Id'])) {
			?>	
					<input type="submit" name="Simpan" value="Simpan" class="btn btn-primary float-right mr-2">
			<?php
				} else {
			?>
					<input type="submit" name="Update" value="Update" class="btn btn-warning float-right mr-2">
			<?php
				}
			?>
		</div>
	</form>
</div>

<div id="formView" class="view-container" <?php if (!isset($agency['Id'])) echo 'style="display:none;"'; ?>>
	<div class="row">
		<div class="">
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<div class="col-md-6">
						<span><i class="bi bi-people"></i> List Data Pegawai</span>
					</div>    
				</div>
				<div class="card-body">
					<div class="form-group row d-flex">
						<div class="col-sm-3">
							<input type="file" class="form-control form-control-sm mb-2" accept=".xls, .xlsx, .csv" id="importEmployee" name="importEmployee"/>
						</div>
						<div class="col-sm-4">
							<button class="btn btn-primary btn-sm" onclick="importEmployees()">
								<i class="bi bi-file-earmark-arrow-up"></i> Import
							</button>
							<a href="<?= BASE_PATH . "/src/excel-template/Instansi - Template Pegawai.xlsx" ?>" target="_blank" class="btn btn-success btn-sm">
								<i class="bi bi-download"></i> Template
							</a>
						</div>
					</div>
					<div class="data-content">	
						<?php 
						if($employee == null || count($employee) == 0) {
							?>
							<div class="text-center text-muted py-4"><i class="bi bi-inbox" style="font-size: 3rem;"></i><p class="mt-2">No employees added yet</p></div>
							<?php
						}else{
							?>
							<div class="overflow-auto">
								<table class="table table-bordered table-striped w-100" id="example1">
									<thead>
										<tr>
											<th>Nama Pegawai</th>
											<th>Nomor Telepon</th>
											<th>Jenis Kelamin</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($employee as $index => $emp) : ?>
											<tr>
												<td><?= htmlspecialchars($emp['Name']) ?></td>
												<td><?= htmlspecialchars($emp['PhoneNumber']) ?></td>
												<td><?= htmlspecialchars($emp['Gender']) ?></td>
												<td>
													<div class="d-flex gap-2 justify-content-center">
														<a class="btn btn-sm btn-warning" href="<?= BASE_URL . '/customer/edit/' . $emp['Id'] ?>">
															<i class="bi bi-pencil-square"></i>
														</a>
														<button class="btn btn-sm btn-danger" onclick="deleteEmployee(<?= $emp['Id'] ?>)">
															<i class="bi bi-trash"></i>
														</button>
													</div>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						<?php
							}
						?>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

