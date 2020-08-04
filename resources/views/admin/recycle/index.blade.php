@extends('layouts.app')

@section('content')
<script>
    
    $(function () {
    //$.noConflict();
    $('.data-table').DataTable(); 
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
                <div class="card-header">Recycle Bin</div>
                <div class="card-body ">
                
                    @if(count($records) >0)
                    <table class="table table-bordered data-table" >
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Title</th>
                                <th>Owner</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($records as $record)
                            <tr>
                                <td>{{ $record->id }}</td>
                                <td>{{ $record->record_title }}</td>
                                <td>{{ $record->name }}</td>
                                <td>{{ $record->name_category }}</td>
                                <td>
                                <a href='{{ url("/view/{$record->id}") }}'><button class="btn_prevue"><i class="fa fa-eye"></i> Prevue</button></a>
                                <a href='{{ url("/restore/{$record->id}") }}'><button class="btn_download"><i class="	fas fa-undo-alt"></i> Restore</button></a>
                                <a href='{{ url("/delete_permanent/{$record->id}") }}'><button class="btn_delete"><i class="fa fa-trash"></i> Delete</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @else
                    <h3>No data available</h3>
                    @endif
                    </table>
                       
                </div>
            </div>
        </div>  
    </div>
</div>


@endsection






