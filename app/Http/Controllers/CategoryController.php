<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Categories as Categories;

class CategoryController extends Controller
{
    public function __construct()
    {
    }

    public function index(){
        return view('categories.category');
    }

    public function getAllCategories()
    {
        $top_cats = DB::table('Categories')
                                    ->where('is_child_category', 0)
                                    ->get();

        $sub_cats = DB::table('Categories')
                                    ->where('is_child_category', 1)
                                    ->get();

        $data = [];
        $data['top_cats'] = $top_cats;
        $data['sub_cats'] = $sub_cats;
        // return view('categories.category', array('top_cats' => $top_cats,'sub_cats' => $sub_cats));
        return $data;
    }
}