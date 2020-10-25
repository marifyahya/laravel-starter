@extends('layouts/template')
@section('title', 'Pegawai Baru')
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
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Pegawai Baru</h1>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<div class="container-fluid">
			@include('layouts.session-message')

			<form action="{{ Request::url() }}" method="post" enctype="multipart/form-data" data-parsley-validate>
				@csrf
				@method('put')
				<div class="row">
					<div class="col-lg-3">
						<div class="card">
							<div class="card-body">
								<img id="show-image" src="{{ $employee->photo == null ? asset('img/profile-dummy.png') : asset(Storage::url('/images/employee/500/' . $employee->photo)) }}" alt="Choose Foto" />
								<div class="form-group">
									{{-- <label for="customFile"></label> --}}
									<div class="custom-file mt-2">
										<input type="file" name="photo" class="custom-file-input" id="customFile">
										<label class="custom-file-label" for="customFile">Choose file</label>
									</div>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" name="email" class="form-control" value="{{ $employee->email }}"/>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password" class="form-control" data-parsley-minlength="6"/>
								</div>
								<div class="form-group">
									<label>Role</label>
									<select name="role_id" class="form-control">
											<option selected disabled>Pilih Role</option>
											@foreach ($role as $item)
											<option value="{{ $item->role_id }}" {{ $employee->role_id == $item->role_id ? 'selected' : '' }}>{{ $item->role_name }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label>Status</label>
									<select name="state" class="form-control">
										<option value="1" {{ $employee->state == '1' ? 'selected' : '' }}>Aktif</option>
										<option value="0" {{ $employee->state == '0' ? 'selected' : '' }}>Non Aktif</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<!-- /.col-md-6 -->
					<div class="col-lg-9">
						<div class="card">
							<div class="card-body">
								<div class="form-group row">
									<label class="col-md-4 col-form-label">Nama Depan</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="first_name" value="{{ $employee->first_name }}" required />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label">Nama Belakang</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="last_name" value="{{ $employee->last_name }}" required />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4">Jenis Kelamin</label>
									<div class="col-md-6">
										<div class="icheck-primary d-inline mr-3">
											<input class="form-control" type="radio" id="radioPrimary1" name="gender" {{ $employee->gender == 'M' ? 'checked' : '' }} value="M">
											<label class="font-weight-normal" for="radioPrimary1">Laki-laki</label>
										</div>
										<div class="icheck-primary d-inline">
											<input class="form-control" type="radio" id="radioPrimary2" name="gender" {{ $employee->gender == 'F' ? 'checked' : '' }} value="F">
											<label class="font-weight-normal" for="radioPrimary2">Perempuan</label>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label">Tempat Lahir</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="birth_place" value="{{ $employee->birth_place }}" required />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label">Tanggal Lahir</label>
									<div class="col-md-6">
										<div class="input-group date" id="reservationdate" data-target-input="nearest">
											<input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="birth_date" value="{{ $employee->birth_date }}" />
											<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-calendar"></i></div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label">Alamat Rumah</label>
									<div class="col-md-6">
										<textarea name="address" rows="2" class="form-control">{{ $employee->address }}</textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label">Telepon</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="phone" value="{{ $employee->phone }}" required />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label">NIP</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="nip" value="{{ $employee->nip }}"/>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label">NIK</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="nik" value="{{ $employee->nik }}"/>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label">No SK Pengangkatan</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="decision_number" value="{{ $employee->decision_number }}"/>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label">Status Pegawai</label>
									<div class="col-md-6">
										<select name="employee_status" class="form-control" required>
											<option selected disabled>Status Pegawai</option>
											@foreach ($employeeState as $item)
												<option value="{{ $item }}" {{ $employee->employee_status == $item ? 'selected' : '' }}>{{ $item }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label">Jabatan</label>
									<div class="col-md-6">
										<select name="position_id" class="form-control">
											@foreach ($position as $item)
												<option value="{{ $item->position_id }}" {{ $employee->position_id == $item->position_id ? 'selected' : '' }}>{{ $item->position_name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label">Pendidikan Terakhir</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="last_diploma" value="{{ $employee->last_diploma }}" required />
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label">Tahun Pendidikan Terakhir</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="last_diploma_year" value="{{ $employee->last_diploma_year }}" required />
									</div>
								</div>
							</div>
							<div class="card-footer">
								<button class="btn btn-primary">Update</button>
								<a href="{{ route('employee') }}" class="btn btn-secondary">Kembali</a>
							</div>
						</div>
					</div>
					<!-- /.col-md-6 -->
				</div>
				<!-- /.row -->
			</form>
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
@endsection
@push('script')
<script>
	$(function() {
		// bsCustomFileInput.init();
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
		$('#reservationdate').datetimepicker({
			format: 'DD-MM-YYYY',
			locale: 'id'
		});
	});
	
</script>
@endpush