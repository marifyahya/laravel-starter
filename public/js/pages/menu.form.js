let select_val = $('select[name="icon"]').data('value');
$('select[name="groupmenu"]').select2({
	theme: 'bootstrap4'
});
$('select[name="icon"]').select2({
	theme: 'bootstrap4',
	placeholder: 'Pilih icon',
	allowClear: true,
	data: fontAwesome,
	templateResult: function  (state) {
		return $('<span><i class="'+state.text+'"></i> '+state.text+'</span>');
	},
	templateSelection: function (state) {
		return $('<span><i class="'+state.text+'"></i> '+state.text+'</span>');
	}
});
if (select_val != null) {
	$('select[name="icon"]').val(select_val).trigger('change');
}