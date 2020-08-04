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
                      $('.record_cat').show();
                      $('.record_cat').html(result);
                  }});
               });
            });

      </script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">View record</div>

                <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-9 record_cat">
                                        @foreach($records as $record)
                                                <h4>{{ $record->record_title }}</h4>
                                                <h4>posté par: {{ $record->first_name }} {{ $record->last_name }}</h4>
                                                <h4>posté le: {{ $record->record_date }}</h4>
                                                <h4>lien doc: {{ $record->record_file }}</h4>
                                                <ul class="nav nav-pills">
                                                    <li role="presentaion">
                                                        <a href='{{ url("/download/{$record->record_file}") }}'>
                                                            <span class="fa fa-download">download</span> 
                                                        </a>
                                                    </li>
                                                </ul>
                                                
                                        @endforeach
                            </div>
                            <div class="" style="display:none"></div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

