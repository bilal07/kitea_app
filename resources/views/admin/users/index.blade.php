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
                <div class="card-header">Accounts</div>
                <div class="card-body ">
                    <div class="ml-auto float-right mb-2" >
                        <a href="{{ route('register') }}"><button class="btn_download"><i class="fa fa-plus"></i> New Account</button></a>
                    </div> 
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Profile</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ implode(',', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}"><button class="btn_edit"><i class="fa fa-edit"></i> Edit</button></a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn_delete"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                            </td>
                            </tr>
                         @endforeach
                           
                        </tbody>
                    </table>
                    
                       
                 
                </div>
            </div>
        </div>  
    </div>
</div>


@endsection






