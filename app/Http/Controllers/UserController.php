<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create() { 
    $newUser = [
        [
            'name'=> 'name',
            'email'=> 'email',
            'password'=> 'password',
            
        ]
        ];

        foreach($newUser as $item){
            User::create([
            'name' => $item['name'],
            'email' => $item['email'],
            'password' => $item['password'],
            ]);
        }

        
    }


    public function index () {
        $posts = User::all();
        
        return view('users',compact('users'));

    }
}
