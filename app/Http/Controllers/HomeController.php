<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Records as Records;
use App\Categories as Categories;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->controllerCat = new CategoryController();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $categories_parent = DB::table('Categories')
                            ->select(DB::raw('id, name_category'))
                            ->where('is_child_category', 0)
                            ->get();
        //$records = Records::all();
        $records = DB::table('records')
            ->join('users', 'users.id', '=', 'records.record_owner')
            ->select('records.*', 'users.first_name', 'users.last_name')
            ->where('records.is_recycled', 0)
            ->get();
        
       // var_dump($records);die;
        $getAllCat = $this->controllerCat->getAllCategories();
        
        $data = [];
        $data['records'] = $records;
        $data['categories_parent'] = $categories_parent;
        $data['all_cat'] = true;
        $stat = DB::table('Records')
                     ->select('cat_name', DB::raw('count(*) as total'))
                     ->groupBy('cat_name')
                     ->get();
        $data['stat'] = $stat;
        //var_dump($categories_parent);die;
       /* echo '<pre>';
        print_r($records);
        echo '</pre>'; die;*/
        return view('home',$data, $getAllCat);
    }
}
