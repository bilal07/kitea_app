@extends('layouts.app')

@section('content')
<script>
    jQuery(document).ready(function(){
        jQuery('.link').click(function(e){
            e.preventDefault();
            var load = $(this).attr("href");
            var elem = load.split('/');
            console.log(elem);
            if(elem.length == 3){
                cat=elem[0];scat=elem[1];id_cat=elem[2];
            }
            else{
                cat=elem[0];scat=null;id_cat=elem[1];
            }
            jQuery.ajax({
                url: "{{ url('/record/cat') }}",
                method: 'GET',
                data: {
                    cat: cat,
                    scat: scat,
                    id_cat: id_cat
                },
                success: function(result){
                    if(result){
                    $('.record_cat').show();
                    $('.record_cat').html(result);
                }
                }
            });
        });
    });
</script>
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-3">
            <div class="card">
                <div class="card-header">Admin Panel</div>
                <div class="card-body nav-side-menu">

                    <div class="menu-list">
                        <ul id="menu-content" class="menu-content collapse out">
                                        @foreach ($top_cats as $top_cat)
                                                <li data-toggle="collapse" data-target="#{{ $top_cat->name_category }}" class="collapsed active">
                                                    <a href="{{ $top_cat->name_category }}/{{ $top_cat->id }}" class="link">
                                                        {!!html_entity_decode($top_cat->icons)!!}{{ $top_cat->name_category }}
                                                        @if($top_cat->name_category == 'guides')
                                                        <span class="arrow"></span>
                                                        @endif
                                                    </a>
                                                </li>
                                                <ul class="sub-menu collapse" id="{{ $top_cat->name_category }}">
                                                @foreach ($sub_cats as $sub_cat)
                                                    @if ( $sub_cat->parent_category === $top_cat->id )
                                                        <li><a href="{{ $top_cat->name_category }}/{{ $sub_cat->name_category }}/{{ $sub_cat->id }}" class="link">{!!html_entity_decode($sub_cat->icons)!!}{{ $sub_cat->name_category }}</a></li>
                                                    @endif
                                                @endforeach
                                                </ul>
                                        @endforeach
                        </ul>
                        </div>
                    </div>

                </div>
            </div>
            
        <div class="col-md-9 record_cat">
            <div class="card">
                <div class="card-header">Edit Account <strong>{{ $user->first_name }} {{ $user->last_name }}</strong></div>
                <div class="card-body ">
                   
                    <form action="{{ route('settings.users.update', $user) }}" method="POST">
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
                        <div class="form-group row">
                            <label for="password" class="col-md-6 col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-6 col-form-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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






