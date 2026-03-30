<!DOCTYPE html>
<html>
<head>
  <title><?= APP_NAME ?></title>
  <?php include __DIR__ . '/../partials/head.php'; ?>
  <?php include __DIR__ . '/../partials/css.php'; ?>
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">

  <?php include __DIR__ . '/../partials/navbar.php'; ?>
  <?php include __DIR__ . '/../partials/sidebar.php'; ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    
    <?php include __DIR__ . '/../partials/notification.php';?>
    <section class="content">
		  <div class="container-fluid">
        <?= $content; ?>
      </div>
    </section>
  </div>

  <?php include __DIR__ . '/../partials/footer.php'; ?>
  
</div>

<?php include __DIR__ . '/../partials/js.php'; ?>
</body>
</html>
<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
  <div class="loading-spinner"></div>
</div>
