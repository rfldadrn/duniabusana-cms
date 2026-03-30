<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (isset($_SESSION['success'])): ?>
            showMessage("<?= $_SESSION['success']; ?>", 'success');
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            showMessage("<?= $_SESSION['error']; ?>", 'error');
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['info'])): ?>
            showMessage("<?= $_SESSION['info']; ?>", 'info');
            <?php unset($_SESSION['info']); ?>
        <?php endif; ?>
    });
</script>