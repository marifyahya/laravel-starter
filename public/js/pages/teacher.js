let table = $('#dt-table').DataTable({
	processing: true,
	serverSide: true,
	searchDelay: 2000,
	scrollX: true,
	ajax: {
		url: $CURRENT_URL +'/table',
	},
	columns: [
		{data: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center'},
		{data: 'full_name'},
		{data: 'gender'},
		{data: 'date_of_birth'},
		{data: 'address'},
		{data: 'phone'},
		{data: 'email'},
		{data: 'action', orderable: false, searchable: false, className: 'text-center'}
	], 
	order: [
		[1, 'asc']
	]
});
$(document).on('click', '.btn-delete', function(){
	swal.fire({
		title: "Apakah anda yakin?",
		text: "Setelah dihapus, Data tidak bisa dikembalikan.",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	})
	.then((result) => {
		if (result.value) {
			var id = $(this).val();
			$.ajax({
				type: "DELETE",
				url: $CURRENT_URL + '/' + id,
				success: function (data) {
					table.ajax.reload();
					Toast.fire({
						icon: 'success',
						title: data
					})
				},
				error: function (data) {
					swal.fire({
						title: "Terjadi Kesalahan", 
						html: 'Kami mengalami masalah saat menyelesaikan permintaan Anda. <br> Coba lagi.',
						icon: "error",
					})
				}
			});
		}
	});        
});