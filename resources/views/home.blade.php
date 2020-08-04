@extends('layouts.app')

@section('content')
<script>

        jQuery(document).ready(function(){
            jQuery('.link').click(function(e){
               e.preventDefault();
               var load = $(this).attr("href");
                var elem = load.split('/');
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
                <div class="card-header">Categories</div>
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
                <div class="card-header">Dashboard</div>
                <div class="card-body ">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    <div class="row">  <!-- row statistic -->
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Guides</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @foreach ($stat as $st)
                                        @if($st->cat_name == 'guides')
                                            {{ $st->total }} 
                                            @php
                                            $tot1=1
                                            @endphp 
                                        @endif
                                    @endforeach
                                    @if(empty($tot1))
                                        0
                                    @endif
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="far fa-file-alt fa-2x text-gray-300"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Contrats</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @foreach ($stat as $st)
                                        @if($st->cat_name == 'contrats')
                                            {{ $st->total }} 
                                            @php 
                                            $tot2=1
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if(empty($tot2))
                                        0
                                    @endif
                                    </div>
                                </div>
                                <div class="col-auto">
                                <i class="fa fa-edit fa-2x text-gray-300"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Licenses</div>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    @foreach ($stat as $st)
                                        @if($st->cat_name == 'licenses')
                                            {{ $st->total }}  
                                            @php
                                            $tot3=1
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if(empty($tot3))
                                        0
                                    @endif
                                    </div>
                                </div>
                                <div class="col-auto">
                                <i class="fa fa-key fa-2x text-gray-300"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Zones</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @foreach ($stat as $st)
                                        @if($st->cat_name == 'zones')
                                            {{ $st->total }} 
                                            @php
                                            $tot4=1
                                            @endphp  
                                        @endif
                                    @endforeach
                                    @if(empty($tot4))
                                        0
                                    @endif
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa fa-sitemap fa-2x text-gray-300"></i>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div> <!-- fin row statstic -->
                       
                        @foreach ($stat as $st)
                        @if($st->total)
                            <h6>{{ $st->cat_name }}</h6>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>title</th>
                                        <th>owner</th>
                                        <th>date</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            @foreach($records as $record)
                            @if ( $st->cat_name === $record->cat_name)
                                <tr>
                                    <td>{{ $record->id }}</td>
                                    <td>{{ $record->record_title }}</td>
                                    <td>{{ $record->first_name }} {{ $record->last_name }}</td>
                                    <td>{{ $record->record_date }}</td>
                                    <td>
                                    <a href='{{ url("/view/{$record->id}") }}'><button class="btn_prevue"><i class="fa fa-eye"></i> Prevue</button></a>
                                    <a href='{{ url("/download/{$record->record_file}") }}'><button class="btn_download"><i class="fa fa-download"></i> Download</button></a>
                                    </td>
                                </tr>
                            @endif    
                            @endforeach
                            </tbody>
                            </table>
                            <hr>
                            @endif
                        @endforeach
                </div>
            </div>
        </div>  
    </div>
</div>


@endsection






