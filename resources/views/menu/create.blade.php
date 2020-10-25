@extends('layouts/template')
@section('title', 'Menu Baru')
@push('style')
@endpush
@section('content')
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Menu Baru</h1>
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
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form action="{{ Request::url() }}" method="post" data-parsley-validate>
						@csrf
						<div class="form-group row">
							<label class="col-md-2 col-form-label">Groupmenu</label>
							<div class="col-md-4">
								<select name="groupmenu" class="form-control" style="width: 100%">
									@foreach ($groupmenu as $item)
										<option value="{{ $item['menu_id'] }}">{{ $item['menu_name'] }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-2 col-form-label">Nama menu</label>
							<div class="col-md-4">
								<input type="text" name="menu_name" class="form-control" placeholder="Nama menu" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-2 col-form-label">Link</label>
							<div class="col-md-4">
								<input type="text" name="link" class="form-control" placeholder="Link" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-2 col-form-label">Icon</label>
							<div class="col-md-4">
								<select name="icon" class="form-control" style="width: 100%">
									<option></option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-2 col-form-label">Urutan</label>
							<div class="col-md-4">
								<input type="text" name="ordinal" class="form-control" placeholder="Urutan" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-2 col-form-label">Status</label>
							<div class="col-md-4">
								<div class="col-form-label">
									<div class="form-group clearfix">
										<div class="icheck-primary d-inline mr-2">
											<input type="radio" id="stateAktif" name="state" value="1" checked>
											<label for="stateAktif">Aktif</label>
										</div>
										<div class="icheck-primary d-inline">
											<input type="radio" id="stateNonAktif" name="state" value="0">
											<label for="stateNonAktif">Non aktif</label>
										</div>
									</div>
								</div>
							</div>
						</div>

						<button type="submit" class="btn btn-sm btn-primary">Simpan</button>
						<a href="{{ route('menu') }}" class="btn btn-sm btn-secondary">Batal</a>
					</form>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
@endsection
@push('script')
	<script src="{{ asset('js/select2-list-icon.js') }}"></script>
	<script src="{{ asset('js/pages/menu.form.js') }}"></script>
@endpush