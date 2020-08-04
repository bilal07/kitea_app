@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                @endif
                @if(session('response'))
                    <div class="alert alert-success">{{session('response')}}</div>
                @endif
            <div class="card">
                <div class="card-header">Records</div>
                <div class="card-body">
                <form method="POST" action="{{ url('/addRecord') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="record_title" class="col-md-4 col-form-label text-md-right">{{ __('Record Title') }}</label>

                            <div class="col-md-6">
                                <input id="record_title" type="record_title" class="form-control @error('record_title') is-invalid @enderror" name="record_title" value="{{ old('record_title') }}" required autocomplete="record_title" autofocus>

                                @error('record_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="record_cat" class="col-md-4 col-form-label text-md-right">{{ __('Record Category') }}</label>

                            <div class="col-md-6">
                                <!--<input id="record_cat" type="number" class="form-control @error('record_cat') is-invalid @enderror"
                                 name="record_cat" value="{{ old('record_cat') }}" required autocomplete="record_cat" autofocus>-->

                                 <select class="form-control select2 @error('record_cat') is-invalid @enderror"
                                 data-placeholder="" name="record_cat" id="record_cat">
                                        @foreach ($top_cats as $top_cat)
                                            <option value="{{ $top_cat->id }}"  style="background-color:grey">{{ $top_cat->name_category }}</option>
                                                @foreach ($sub_cats as $sub_cat)
                                                    @if ( $sub_cat->parent_category === $top_cat->id )
                                                        <option value="{{ $sub_cat->id }}|{{ $top_cat->id }}">{{ $sub_cat->name_category }}</option>
                                                    @endif
                                                @endforeach
                                        @endforeach    
                                </select>
                                @error('record_cat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="record_file" class="col-md-4 col-form-label text-md-right">{{ __('Upload File') }}</label>

                            <div class="col-md-6">
                                <input id="record_file" type="file" class="form-control @error('record_file') is-invalid @enderror" name="record_file" value="{{ old('record_file') }}" required autocomplete="record_file" autofocus>

                                @error('record_file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
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
