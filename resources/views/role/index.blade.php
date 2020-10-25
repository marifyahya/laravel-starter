@extends('layouts/template')
@section('title', 'Role')
@push('style')
@endpush
@section('content')
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Role</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<a href="{{ route('role') . '/create' }}" class="btn btn-sm btn-primary float-md-right float-xs-left">Role Baru</a>
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
								<th>Role</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
@endsection
@push('script')
	<script src="{{ asset('js/pages/role.js') }}"></script>
@endpush