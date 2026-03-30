<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Settings</li>
		<li class="breadcrumb-item active" aria-current="page">Data Management</li>
	</ol>
</nav>
<div class="card card-light">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-database"></i> Data Management
		</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
        <div class="row">
            <?php 
                foreach ($menuTree as $menu):
                    if ($menu['IsMenu']){
                        if ($menu['MenuSlug'] == null || $menu['MenuSlug'] == '') {
                            continue; // Skip menu dengan URL '#'
                        }
                        ?>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?= $menu['MenuName'] ?></h5>
                                    <p class="card-text">Kelola <?= strtolower($menu['MenuName']) ?>.</p>
                                    <div class="row d-flex align-items-center mb-3">
                                        <div class="col-auto mb-2">
                                            <input type="file" class="form-control form-control-sm" id="importFile<?= $menu['Id'] ?>" accept=".xlsx, .xls">
                                        </div>
                                        <div class="col">
                                            <button class="btn btn-primary btn-sm" onclick="ImportData('importFile<?= $menu['Id'] ?>', '<?= $menu['MenuSlug'] ?>')">Import</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    if (isset($menu['children'])): 
                    ?>
                        <?php foreach ($menu['children'] as $child): ?>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold"><?= $child['MenuName'] ?></h5>
                                        <p class="card-text">Kelola <?= strtolower($child['MenuName']) ?>.</p>
                                        <div class="row d-flex align-items-center mb-3">
                                            <div class="col-auto mb-2">
                                                <input type="file" class="form-control form-control-sm" id="importFile<?= $child['Id'] ?>" accept=".xlsx, .xls">
                                            </div>
                                            <div class="col">
                                                <button class="btn btn-primary btn-sm" onclick="ImportData('importFile<?= $child['Id'] ?>', '<?= $child['MenuSlug'] ?>')">Import</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php endif;
                endforeach
            ?>
        </div>
    </div>
</div>
	<!-- /.card-body -->