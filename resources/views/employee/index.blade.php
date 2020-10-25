@extends('layouts/template')
@section('title', 'Pegawai')
@push('style')
@endpush
@section('content')
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Pegawai</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<a href="{{ route('employee') }}/create" class="btn btn-sm btn-primary float-md-right float-sm-left">Pegawai Baru</a>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<div class="container-fluid">
			@include('layouts.session-message')

			<div class="card">
				<div class="card-body">
					<table id="dt-table" class="table" style="width: 100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Lengkap</th>
								<th>JK</th>
								<th>Tempat Tanggal Lahir</th>
								<th>Alamat</th>
								<th>Telepon</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
@endsection
@push('script')
	<script src="{{ asset('js/pages/teacher.js') }}"></script>
@endpush