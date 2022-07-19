<?php

namespace App\Http\Controllers;

use App\Models\Breach;

use Illuminate\Http\Request;

class BreachesController extends Controller
{
    public function create() { 
        $newBreach = [
            [
                'hash'=> 'hash',
                'times_pwnd'=> 'times_pwnd',
                'last_check'=> 'last_check',
                
            ]
            ];
    
            foreach($newBreach as $item){
                Breach::create([
                'hash' => $item['hash'],
                'times_pwnd' => $item['times_pwnd'],
                'last_check' => $item['last_check'],
                ]);
            }
        }
    

        public static function update($pwnd_count,$id){
            $breach = Breach::find($id);
            $breach -> update(
            [
                'times_pwnd' => $pwnd_count,
                'last_check' => date("Y-m-d H:i:s"),
            ]);
        }

    
        public function index () {
            $posts = Breach::all();
            
            return view('breaches',compact('breaches'));
    
        }
}
