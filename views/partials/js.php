<script src="<?php echo BASE_URL; ?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo BASE_URL; ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?php echo BASE_URL; ?>/assets/plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables -->
<script src="<?php echo BASE_URL; ?>/assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- AdminLTE App -->
<script src="<?php echo BASE_URL; ?>/assets/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo BASE_URL; ?>/assets/js/demo.js"></script>
<!-- page script -->
<script src="<?php echo BASE_URL; ?>/assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="<?= BASE_URL ?>/assets/plugins/tinymce/tinymce.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
<!-- Alert -->
<!-- <script src="<?php echo BASE_URL; ?>/assets/plugins/alert.js"></script> -->

<script src="<?php echo BASE_URL; ?>/assets/js/customJS/common.js"></script>
<script src="<?= BASE_URL ?>/assets/js/customJS/size.js"></script>
<script type="text/javascript" src="<?= BASE_URL ?>/assets/js/customJS/transaction.js"></script>
<script>
    const BASE_URL = "<?php echo ALTERNATE_BASE_URL; ?>";
    if (typeof tinymce !== 'undefined' && document.getElementById('note-richtext')) {
        tinymce.init({
            selector: "#note-richtext",
            height: 300,
            menubar: false,
            readonly: false,
            plugins: "lists link table code",
            toolbar: "undo redo | bold italic underline | bullist numlist | link | code"
        });
    }
</script>