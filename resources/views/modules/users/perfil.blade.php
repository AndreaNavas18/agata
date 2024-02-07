@extends('layouts.app')
@section('title', 'My profile')
@section('content')

	@component('componentes.card', [
		'shadow' => true,
		'title' => 'My profile',
		'breadcrumb' => 'my-profile',
		'dataBreadcrumb' => ['id' => $user->id]
	])
		<div class="row">
			<!-- Basic information -->
			<div class="col-sm-12 col-md-6">
				@component('componentes.card', ['title' => 'Basic information'])

					<div class="row">
						<div class="col-sm-12 col-lg-7 col-xl-6">
							<div class="form-group">
								<label class="font-weight-bold" for="fullname">Full name</label>
								<p id="fullname">{{ $user->employee->full_name }}</p>
							</div>
						</div>
						
						<div class="col-sm-12 col-lg-7 col-xl-6">
							<div class="form-group">
								<label class="font-weight-bold" for="email">Email</label>
								<p id="email">{{ $user->employee->email }}</p>
							</div>
						</div>

						<div class="col-sm-12 col-lg-5 col-xl-6">
							<div class="form-group">
								<label class="font-weight-bold" for="user">User</label>
								<p id="user">{{ $user->nombre }}</p>
							</div>
						</div>
					</div>
				@endcomponent
			</div>

			<!-- Change of password -->
			<div class="col-sm-12 col-md-6">
				@component('componentes.card', ['title' => 'Change of password'])

					<form action="{{ route('update_my_profile', $user->id) }}" method="POST">
						@csrf
						@method('PUT')

						<div class="row">
							<div class="col-sm-12 col-md-9">
								<div class="form-group">
									<label for="currentpassword">Contraseña Actual *</label>
									<input class="form-control" type="password" name="currentpassword" id="currentpassword">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-9">
								<div class="form-group">
									<label for="password">Nueva Contraseña *</label>
									<input class="form-control" type="password" name="password" id="password">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-9">
								<div class="form-group">
									<label for="password_confirmation">Confirm New Password *</label>
									<input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
								</div>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col">
								<button class="btn btn-outline-primary btn-sm loading" 
									type="submit"><i class="fas fa-save"></i> 
									Save
								</button>
							</div>
						</div>
					</form>
				@endcomponent
			</div>
		</div>
	@endcomponent
@endsection
