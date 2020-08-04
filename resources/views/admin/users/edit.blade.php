@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-3">
            <div class="card">
                <div class="card-header">Admin Panel</div>
                <div class="card-body nav-side-menu">

                    <div class="menu-list">
                        <ul id="menu-content" class="menu-content collapse out">
                            <li class="collapsed active">
                                <a href="{{ route('admin.company.index') }}" class="link">
                                    <i class='fab fa-buromobelexperte'></i>General
                                </a>
                            </li>    
                            <li class="collapsed active">
                                <a href="{{ route('admin.users.index') }}" class="link">
                                    <i class='fas fa-users'></i>Accounts
                                </a>
                            </li>
                            <li class="collapsed active">
                                <a href="{{ route('admin.recycle.index') }}" class="link">
                                    <i class='fa fa-recycle'></i>Recycle Bin
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>       
        <div class="col-md-9 record_cat">
            <div class="card">
                <div class="card-header">Edit Account <strong>{{ $user->first_name }} {{ $user->last_name }}</strong></div>
                <div class="card-body ">
                   
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="first_name" class="col-md-6 col-form-label">{{ __('First Name') }}</label>

                            <div class="col-md-12">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') ?? $user->first_name}}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-md-6 col-form-label">{{ __('Last Name') }}</label>

                            <div class="col-md-12">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') ?? $user->last_name}}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-6 col-form-label">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email}}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        @foreach($roles as $role)
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="roles[]" value="{{ $role->id }}"
                                id="{{ $role->id }}"
                                    @if($user->roles->pluck('id')->contains($role->id))
                                        checked
                                    @endif>
                                <label for="{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">Modifier les informations</button>
                    </form>
                       
                 
                </div>
            </div>
        </div>  
    </div>
</div>


@endsection






