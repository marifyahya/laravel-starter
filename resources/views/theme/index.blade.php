@extends('layouts/template')
@section('title', 'Blank Page')
@push('style')
@endpush
@section('content')
	<!-- Main content -->
	<div class="content">
		<div class="container-fluid">
			<div class="pb-4">
				<div class="custom-theme"></div>
				<button id="btn-save" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label">Simpan</span></button>
				<button id="btn-reset" class="btn btn-danger ladda-button" data-style="zoom-out"><span class="ladda-label">Reset Tema</span></button>
			</div>
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
@endsection
@push('script')
	<script src="{{ asset('js/pages/theme.js?v=') . date('His') }}"></script>
@endpush