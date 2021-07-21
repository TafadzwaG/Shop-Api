<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Models\Wishlist;
use App\Models\Cart;

class AuthController extends Controller
{  
   
    public function register(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        

        // $user->customer = null;
        // $user->business_owner = null;

       
        Cart::create([
            'user_id'=> $user->id
        ]);
    
        Wishlist::create([
            'user_id' => $user->id
        ]);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user'=> $user, 'access_token' => $accessToken]);

    }

     public function login(Request $request){

        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        
        if(!auth()->attempt($loginData)){

            return response(['message' => 'Invalid Credentials'], $status = 401);
        }
        
        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);



    }


    public function update_user(Request $request, $id){

        $user = User::findOrFail($id);

        $this->validate($request,[
            'name' => 'max:55',
            'email' => 'email|required|unique:users,email,'.$user->id,
            'password' => 'sometimes|min:8'
        ]);

        if($id){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            return $this->jsonSuccess($message = "User Updated", $statusCode = 200);
        }

        else{
            $this->jsonSuccess($message = "ID Not Found", $statusCode = 401);
        }
    }

    public function updated_user(Request $request ,$id){

        return new UserResource(User::findOrFail($id));
    }

    public function getuser(User $user){
        return response(['user' => $user]);
    }

    
}
