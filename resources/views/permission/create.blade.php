@extends('layouts/template')
@section('title', 'Permission Baru')
@push('style')
@endpush
@section('content')
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Permission Baru</h1>
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
					<form action="{{ Request::url() }}" method="post" data-parsley-validate>
						@csrf
						<div class="form-group row">
							<label class="col-md-2 col-form-label">Menu</label>
							<div class="col-md-4">
								<select name="menu" class="form-control select2" placeholder="Pilih Menu" required>
									<option></option>
									@foreach ($menu as $item)
										<option value="{{ $item->menu_id }}">{{ $item->menu_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-2 col-form-label">Permission</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="permission_name" placeholder="Nama Permission" data-parsley-maxlength="50" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-4">
								<button class="btn btn-sm btn-primary">Simpan</button>
								<a href="{{ route('permission') }}" class="btn btn-sm btn-secondary">Batal</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
@endsection
@push('script')
@endpush