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
                <div class="card-header">General</div>
                <div class="card-body ">
                <form action="{{ route('admin.company.update', $company->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="company_name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>

                            <div class="col-md-6">
                                <input id="company_name" type="company_name" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ $company->company_name }}" required autocomplete="company_name" autofocus>

                                @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company_country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                            <div class="col-md-6">
                                <input id="company_country" type="company_country" class="form-control @error('company_country') is-invalid @enderror" name="company_country" value="{{ $company->company_country }}" required autocomplete="company_country" autofocus>

                                @error('company_country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company_city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="company_city" type="company_city" class="form-control @error('company_city') is-invalid @enderror" name="company_city" value="{{ $company->company_city }}" required autocomplete="company_city" autofocus>

                                @error('company_city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company_address" class="col-md-4 col-form-label text-md-right">{{ __('Postal address') }}</label>

                            <div class="col-md-6">
                                <input id="company_address" type="company_address" class="form-control @error('company_address') is-invalid @enderror" name="company_address" value="{{ $company->company_address }}" required autocomplete="company_address" autofocus>

                                @error('company_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save Changes') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    
                       
                 
                </div>
            </div>
        </div>  
    </div>
</div>


@endsection






