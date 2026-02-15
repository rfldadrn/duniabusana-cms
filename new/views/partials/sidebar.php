<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= BASE_URL ?>" class="brand-link">
        <img src="<?= BASE_URL ?>/assets/img/logo.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text"> <?= APP_TITLE ?></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-2 pb-2 mb-2 d-flex">
            <div class="image">
                <img src="<?= BASE_URL ?>/assets/img/user.png" class="img-circle elevation-2 mt-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?= BASE_URL ?>/user/profile" class="d-block">
                    <?php echo $_SESSION['user']['nama']; ?>
                </a>
                <span class="text-light" style="font-size: 12px;">
                    <?php echo $_SESSION['user']['roleName']; ?>
                </span>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php foreach ($menuTree as $menu): ?>
                <li class="nav-item <?= isset($menu['children']) ? 'has-treeview' : '' ?>">
                <?php if ($menu['IsMenu']): ?>
                    <a href="<?= BASE_URL . $menu['MenuUrl'] ?>" class="nav-link">
                    <p>
                    <i class="nav-icon fas <?= $menu['MenuIcon'] ?>"></i>
                <?php else: ?>
                    <a href="#" class="nav-link">
                    <p>
                <?php endif; ?>
                        <?= $menu['MenuName'] ?>
                        <?php if (isset($menu['children'])): ?>
                            <i class="right fas fa-angle-left"></i>
                        <?php endif; ?>
                    </p>
                </a>

                <?php if (isset($menu['children'])): ?>
                    <ul class="nav nav-treeview">
                        <?php foreach ($menu['children'] as $child): ?>
                            <li class="nav-item px-2">
                                <a href="<?= BASE_URL . $child['MenuUrl'] ?>" class="nav-link">
                                    <p>
                                        <i class="fas <?= $child['MenuIcon'] ?> nav-icon"></i>
                                        <?= $child['MenuName'] ?>
                                    </p>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
                </li>
            <?php endforeach; ?>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>