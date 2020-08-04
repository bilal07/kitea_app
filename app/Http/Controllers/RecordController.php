<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\CategoryController;
use App\Records as Records;
use App\Categories as Categories;
use Auth;


class RecordController extends Controller
{
    protected $controllerCat;
    public function __construct()
    {
        $this->controllerCat = new CategoryController();
    }

    public function index(){

        $getAllCat = $this->controllerCat->getAllCategories();
        return view('records.record', $getAllCat);
    }

    public function addRecord(Request $request){

        $this->validate($request, [
            'record_title' => 'required',
            'record_file' => 'required'
        ]);
        $records = new Records;
        $records->record_title = $request->input('record_title');
        $records->record_date = date("Y-m-d");
        $records->record_owner = Auth::user()->id;
        
        $result = $request->input('record_cat');
        if (strpos($result, '|') !== false) {
            $result_explode = explode('|', $result);
            $records->record_category = $result_explode[0];
            $records->parent_category = $result_explode[1];
            $cat  = Categories::find($result_explode[1]);
            $records->cat_name = $cat->name;
        }
        else {
            $records->record_category = $result;
            $records->parent_category = null;
            $cat  = Categories::find($result);
            $records->cat_name = $cat->name;
        }
        

        if($request->file('record_file')){
            $file = $request->file('record_file');
            $file->move(public_path().'/uploads/', $file->getClientOriginalName());
            $url = $file->getClientOriginalName();
        }
        $records->record_file = $url;
        $records->save();
        return redirect('/home')->with('response','Record Added Successfully');
    }

    public function getRecordByCat(Request $request){

        $id_cat = $request->id_cat;
        $cat = $request->cat;
        $scat = $request->scat;
        $recordByCat = DB::table('records')
                        ->join('users', 'users.id', '=', 'records.record_owner')
                        ->select('records.*', 'users.first_name', 'users.last_name')
                        ->where('record_category', $id_cat)
                        ->where('is_recycled', 0)
                        ->get();
                            
        $data = [];
        $data['recordByCat'] = $recordByCat;
        $data['all_cat'] = false;
        $data['cat'] = $cat;
        $data['scat'] = $scat;
        return view('Records.recordByCat',$data);
    }

    public function view($record_id){
        //$record  = Records::where('id', '=', $record_id)->get();
        $records = DB::table('records')
            ->join('users', 'users.id', '=', 'records.record_owner')
            ->select('records.*', 'users.first_name', 'users.last_name')
            ->where('records.id', $record_id)
            ->get();
        $getAllCat = $this->controllerCat->getAllCategories();
        return view('Records.view', ['records' => $records], $getAllCat);

    }

    public function download($file){
        $file_path = public_path('uploads/'.$file);
        return response()->download($file_path);
    }

    public function edit($record_id){
        
        $getAllCat = $this->controllerCat->getAllCategories();
        $records = Records::find($record_id);
        if($records->parent_category)
        $cat_value = $records->record_category.'|'.$records->parent_category;
        else
        $cat_value = $records->record_category;
        //var_dump($cat_value);die;
        $cat = Categories::find($records->record_category);
        // var_dump($cat->id);die;
        return view('records.edit', ['records' => $records, 'cat' => $cat, 'cat_value' => $cat_value], $getAllCat);
    }

    public function editRecord(Request $request, $record_id){
        $this->validate($request, [
            'record_title' => 'required',
            'record_file' => 'required'
        ]);
        $records = new Records;
        $records->record_title = $request->input('record_title');
        $records->record_date = date("Y-m-d");
        $records->record_owner = Auth::user()->id;
        
        $result = $request->input('record_cat');
        if (strpos($result, '|') !== false) {
            $result_explode = explode('|', $result);
            $records->record_category = $result_explode[0];
            $records->parent_category = $result_explode[1];
        }
        else {
            $records->record_category = $result;
            $records->parent_category = null;
        }
        // $records->record_file = $request->input('record_file');
        if($request->file('record_file')){
            $file = $request->file('record_file');
            $file->move(public_path().'/uploads/', $file->getClientOriginalName());
            $url = $file->getClientOriginalName();
        }
        $records->record_file = $url;
        $data = array(
            'record_title' => $records->record_title,
            'record_category' => $records->record_category,
            'parent_category' => $records->parent_category,
            'record_file' => $records->record_file
        );
        Records::where('id', $record_id)->update($data);
        $records->update();
        return redirect('/home')->with('response','Record Updated Successfully');
    }

    public function deleteRecord($record_id){
        $data = array(
            'is_recycled' => 1
        );
        Records::where('id', $record_id)->update($data);
        return redirect('/home')->with('response','Record Deleted Successfully');
    }
    public function deleteRecordPermanent($record_id){
        Records::where('id', $record_id)->delete();
        return redirect()->route('admin.recycle.index')->with('response','Record permanently Deleted Successfully');
    }
    public function restoreRecord($record_id){
        $data = array(
            'is_recycled' => 0
        );
        Records::where('id', $record_id)->update($data);
        return redirect()->route('admin.recycle.index')->with('response','Record Restored Successfully');
    }
}
