@extends('layouts/template')
@section('title', 'Blank Page')
@push('style')
<style>
	#show-image {
		display: block;
		margin-left: auto;
		margin-right: auto;
		max-width: 180px;
		height: auto;
	}
</style>
@endpush
@section('content')
	<!-- Main content -->
	<div class="content">
		<div class="container-fluid">
			@include('layouts.session-message')

			<div class="col-md-4 pl-3 pr-3 pt-3">
				<h5>Menyesuaikan Identitas Situs</h5>
				<form action="{{ Request::url() }}" method="post" enctype="multipart/form-data" data-parsley-validate>
					@csrf
					<label class="d-block">Ubah Logo</label>
					<img id="show-image" src="{{ siteOptionLogo('250') }}" alt="Choose Foto"/>
					<div class="p-0 mt-1">
						<div class="custom-file">
							<input type="file" name="sitelogo" class="custom-file-input" id="customFile">
							<label class="custom-file-label" for="customFile">Choose file</label>
						</div>
					</div>
					<div class="form-group">
						<label>Nama Aplikasi</label>
						<input type="text" class="form-control" name="sitename" placeholder="Nama Aplikasi" value="{{ siteOption('sitename') }}" required>
					</div>

					<button type="submit" class="btn btn-primary mt-2">Simpan</button>
				</form>
			</div>
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
@endsection
@push('script')
	<script>
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#show-image').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		$("#customFile").change(function() {
			readURL(this);
		});
	</script>
@endpush