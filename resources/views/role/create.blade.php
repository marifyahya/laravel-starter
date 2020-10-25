@extends('layouts/template')
@section('title', 'Role Baru')
@push('style')
	<link rel="stylesheet" href="{{ asset('css/pages/role.form.css') }}">
@endpush
@section('content')
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="mb-2">
				<h1 class="m-0 text-dark">Role Baru</h1>
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
					<form action="{{ Request::url() }}" method="post" data-parsley-validate>
						@csrf
						<div class="form-group row">
							<label class="col-md-2 col-form-label">Nama Role</label>
							<div class="col-md-4">
								<input type="text" class="form-control" maxlength="45" name="role_name" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-2 col-form-label">Nama Role</label>
							<div class="col-md-4">
								<select class="form-control" name="state" required>
									<option value="1">Aktif</option>
									<option value="0">Non Aktif</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-2 col-form-label">Menu & Permission</label>
							<div class="col-md-10">
								<div id="form-menu">
									@foreach ($menu->where('groupmenu', null) as $item)
										<div class="list-menu">
											<div class="row">
												<div class="col-md-4">
													@if (count($menu->where('groupmenu', $item->menu_id)) > 0)
														<label class="font-weight-normal" for="menu{{ $item->menu_id }}">
															<i class="{{ $item->icon }}"></i> {{ $item->menu_name }}
														</label>
													@else
														<div class="icheck-primary d-inline">
															<input type="checkbox" id="menu{{ $item->menu_id }}" value="{{ $item->menu_id }}" name="menu[]">
															<label class="font-weight-normal" for="menu{{ $item->menu_id }}">
																<i class="{{ $item->icon }}"></i> {{ $item->menu_name }}
															</label>
														</div>
													@endif
												</div>
												<div class="col-md-8">
													<div class="ml-5">
														@foreach ($item->permission as $permission)
															<div class="icheck-primary d-inline">
																<input type="checkbox" id="permission{{ $permission->permission_id }}" value="{{ $permission->permission_id }}" name="permission[]">
																<label class="font-weight-normal" for="permission{{ $permission->permission_id }}">
																	{{ $permission->permission_name }}
																</label>
															</div>
														@endforeach
													</div>
												</div>
											</div>
											@foreach ($menu->where('groupmenu', $item->menu_id) as $submenu)
												<div class="row">
													<div class="col-md-4">
														<div class="icheck-primary d-inline ml-4">
															<input type="checkbox" id="menu{{ $submenu->menu_id }}" value="{{ $submenu->menu_id }}" name="menu[]">
															<label class="font-weight-normal" for="menu{{ $submenu->menu_id }}">
																{{ $submenu->menu_name }}
															</label>
														</div>
													</div>
													<div class="col-md-8">
														<div class="ml-5">
															@foreach ($submenu->permission as $permission)
																<div class="icheck-primary d-inline mr-2">
																	<input type="checkbox" id="permission{{ $permission->permission_id }}" value="{{ $permission->permission_id }}" name="permission[]">
																	<label class="font-weight-normal" for="permission{{ $permission->permission_id }}">
																		{{ $permission->permission_name }}
																	</label>
																</div>
															@endforeach
														</div>
													</div>
												</div>
											@endforeach
										</div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-2"></div>
							<div class="col-md-8">
								<button class="btn btn-primary">Simpan</button>
								<a href="{{ route('role') }}" class="btn btn-secondary">Batal</a>
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