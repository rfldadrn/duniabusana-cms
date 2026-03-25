<?php if (isset($_SESSION['success'])): ?>
    <div class="toast-notif alert alert-success">
        <i class="fas fa-check-circle mr-2"></i>
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="toast-notif alert alert-danger">
        <i class="fas fa-exclamation-circle mr-2"></i>
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['info'])): ?>
    <div class="toast-notif alert alert-info">
        <i class="fas fa-info-circle mr-2"></i>
        <?= $_SESSION['info']; unset($_SESSION['info']); ?>
    </div>
<?php endif; ?>