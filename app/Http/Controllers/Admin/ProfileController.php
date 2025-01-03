<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Traits\ApiResponse;

class ProfileController extends Controller
{
    use ApiResponse;
    public function index(){
        return view('admin.profile');
    }

    public function saveProfile(Request $request){
        $validatedData = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'email'=>['required','email','string',Rule::unique('users','email')->ignore(auth()->user()->id)],
            'profile'=>'nullable|mimes:jpeg,png,jpg,gif|max:5120',
            'phone'=>'required|string|max:20',
            'address'=>'required|string|max:255',
            'twitter'=>'nullable|string|max:255',
            'instagram'=>'nullable|string|max:255',
            'facebook'=>'nullable|string|max:255',
        ]);

        if($validatedData->fails()){
            return response()->json([
                'status'=>400,
                'message'=>$validatedData->errors()->first()
            ]);
        }

        $validatedData = $validatedData->validate();

        if($request->hasFile('profile')){
            $image_name = 'images/'.$request->name.time().'.'.$request->profile->extension();
            $request->profile->move(public_path('images/'),$image_name);
            $validatedData['profile'] = $image_name;
        }else{
            $validatedData['profile'] = null;
        }

        $user = User::updateOrCreate(
            ['id'=>Auth::user()->id],
            [
                'name'=>$validatedData['name'],
                'email'=>$validatedData['email'],
                'phone'=>$validatedData['phone'],
                'address'=>$validatedData['address'],
                'profile'=>$validatedData['profile'],
                'twitter'=>$validatedData['twitter'],
                'instagram'=>$validatedData['instagram'],
                'facebook'=>$validatedData['facebook']
            ]
            );
        if($user){
            return $this->success([],'Successfully Updated',200);
        }else{
            return  $this->error([],'Fail to Updated',404);
        }
    }
}
