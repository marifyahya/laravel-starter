@extends('layouts/template')
@section('title', 'Permission')
@push('style')
@endpush
@section('content')
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Permission</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<a href="{{ route('permission') }}/create" class="btn btn-sm btn-primary float-md-right float-sm-left">Permission Baru</a>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<div class="container-fluid">
			<div class="card">
				<div class="card-body">
					<table id="dt-table" class="table" style="width: 100%">
						<thead>
							<tr>
								<th>Menu</th>
								<th>Permission</th>
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
	<script src="{{ asset('js/pages/permission.js') }}"></script>
@endpush