@extends('layouts/template')
@section('title', 'Menu')
@section('content')
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Menu</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<a href="{{ route('menu') }}/create" class="btn btn-sm btn-primary float-md-right float-sm-left">Menu Baru</a>
				</div>
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
								<th>Group menu</th>
								<th>Menu</th>
								<th>Icon</th>
								<th>Link</th>
								<th>Urutan</th>
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
	<script src="{{ asset('js/pages/menu.js') }}"></script>
@endpush