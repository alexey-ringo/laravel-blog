@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
@endif

<div class="shadow card">
    <div class="card-header">
		<button type="submit" class="btn btn-primary float-right">Сохранить</button>
    </div>
</div>		

<div class="card mt-3">
	<div class="card-header">
		<ul class="nav nav-tabs card-header-tabs">
		    <li class="nav-item">
		        <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true"><i class="fas fa-home"></i> Основные</a>
		    </li>
		</ul>
	</div>
	<div class="card-body">

		<div class="tab-content" id="myTabContent">

		    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
				
				<div class="form-group">
					<label for="">Имя</label>
					{{--Если в возвращаемом из валибатора (после неправильной валидации), массиве есть поле name - выводим его, иначе берем значение из таблицы или пустое --}}
					<input type="text" class="form-control" name="name" placeholder="Имя" value="@if(old('name')){{old('name')}}@else{{$user->name ?? ""}}@endif" required>
				</div>

				<div class="form-group">
					<label for="">Email</label>
					<input type="email" class="form-control" name="email" placeholder="Email" value="@if(old('email')){{old('email')}}@else{{$user->email ?? ""}}@endif" required>
				</div>
				
				<div class="row form-group">
            		<div class="col col-md-3">
                		<label for="roles" class=" form-control-label">Роли</label>
            		</div>
            		<div class="col-12 col-md-9">
                		<select name="roles[]" id="roles" class="form-control" multiple="">
                    		@include('admin.user_management.user.partials.roles', ['roles' => $roles])
                    		
                		</select>
            		</div>
        		</div>

				<div class="form-group">
					<label for="">Пароль</label>
					<input type="password" class="form-control" name="password">
				</div>

				<div class="form-group">
					<label for="">Подтверждение</label>
					<input type="password" class="form-control" name="password_confirmation">	
				</div>
		    </div>

		</div>
		
	</div>
</div>