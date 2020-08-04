<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profiles;
class ProfileController extends Controller
{
    public function profile(){
        return view('profiles.profile');
    }

    public function addProfile(Request $request){
        $this->validate($request, [
            'name' => 'required'
        ]);
        $profiles = new Profiles;
        $profiles->profile_name = $request->input('name');
        $profiles->save();
        return redirect('/profile')->with('response','Profile Added Successfully');
    }
}
