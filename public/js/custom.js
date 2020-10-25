const $BASE_URL = $('meta[name=base-url]').attr("content"),
	$PAGE_URL = $('meta[name=page-url]').attr("content"),
	$CURRENT_URL = $('meta[name=current-url]').attr("content"),
	$SIDEBAR_MENU = $('#sidebar-menu'),
	$TOAST = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
})
$.extend( true, $.fn.dataTable.defaults, {
	language: {
		"sEmptyTable":   "Tidak ada data yang tersedia pada tabel ini",
		"sProcessing":   "Sedang memproses...",
		"sLengthMenu":   "Tampilkan _MENU_ entri",
		"sZeroRecords":  "Tidak ditemukan data yang sesuai",
		"sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
		"sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
		"sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
		"sInfoPostFix":  "",
		"sSearch":       "Cari:",
		"sUrl":          "",
		"oPaginate": {
			"sFirst":    "Pertama",
			"sPrevious": "Sebelumnya",
			"sNext":     "Selanjutnya",
			"sLast":     "Terakhir"
		}
	}
});
$('.select2').select2({
	placeholder: $('.select2').attr('placeholder')
});

function init_sidebar() {
	$SIDEBAR_MENU.find('a').filter(function () {
			return this.href == $PAGE_URL;
		})
		.addClass('active')
		.parents('.has-treeview')
		.addClass('menu-open')
		.children('a').addClass('active');

	if ($PAGE_URL == $CURRENT_URL) {
		$SIDEBAR_MENU.find('a[href="' + $PAGE_URL + '/dashboard"]').addClass('active');
	}
}

$(function(){
	init_sidebar();
});