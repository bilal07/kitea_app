<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class RecycleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = DB::table('records')
                        ->join('users', 'users.id', '=', 'records.record_owner')
                        ->join('categories', 'categories.id', '=', 'records.record_category')
                        ->select('records.*', 'users.first_name', 'users.last_name', 'categories.name_category')
                        ->where('is_recycled', 1)
                        ->get();
        return view('admin.recycle.index',['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Gate::denies('edit-users')){
            return redirect()->route('admin.users.index');
        }
        
        $roles = Role::all();
        return view('admin.users.edit',[
            'user' => $user,
            'roles' => $roles
        ]);
    }

    
}
