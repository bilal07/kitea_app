@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                <ul>
                    @foreach ($top_cats as $top_cat)
                        <li>{{ $top_cat->name }}
                            @foreach ($sub_cats as $sub_cat)
                                @if ( $sub_cat->parent_category === $top_cat->id )
                                    <ul>
                                        <li>{{ $sub_cat->name }}</li>
                                    </ul>
                                @endif
                            @endforeach
                        </li>
                    @endforeach
                </ul>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
