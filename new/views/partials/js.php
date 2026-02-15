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
<!-- Alert -->
<!-- <script src="<?php echo BASE_URL; ?>/assets/plugins/alert.js"></script> -->
<script>
	$(function() {
		$("#example1").DataTable();
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,	
			"autoWidth": false,
		});
	});
</script>

<script>
	$(function() {
		//Initialize Select2 Elements
		$('.select2').select2()

		//Initialize Select2 Elements
		$('.select2bs4').select2({
			theme: 'bootstrap4'
		})
	})
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var notif = document.querySelectorAll('.toast-notif');
	console.log(notif);
    notif.forEach(function(el) {
        setTimeout(function() {
            el.style.opacity = '0';
            setTimeout(function() {
                el.style.display = 'none';
            }, 500);
        }, 3500);
    });
});
</script>

<script>
// SweetAlert Delete Confirmation
function confirmDelete(url, title = 'Data') {
	event.preventDefault();
    Swal.fire({
        title: 'Hapus Data?',
        text: `Apakah Anda yakin ingin menghapus ${title} ini?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '<i class="fas fa-trash"></i> Ya, Hapus!',
        cancelButtonText: '<i class="fas fa-times"></i> Batal',
        reverseButtons: true,
        focusCancel: true
    }).then((result) => {
		console.log(result);
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Menghapus...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Redirect to delete URL
            window.location.href = url;
        }
    });
    
    return false;
}
</script>