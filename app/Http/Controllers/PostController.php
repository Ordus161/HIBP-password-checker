<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index () {
        $posts = Post::all();
        
        return view('posts',compact('posts'));

    }

    public function create() {

        $postsArr = [
            [
                'title'=> 'another title',
                'content'=> 'another content',
                'image'=> 'another image',
                'likes'=> 50,
                'is_published'=> 1,
            ]

            ];


            foreach($postsArr as $item){
                Post::create([
                'title' => $item['title'],
                'content' => $item['content'],
                'image' => $item['image'],
                'likes'=> $item['likes'],
                'is_published' => $item['is_published'],
                ]);
            }
    }

    public function update(){
        $post = Post::find(2);
        $post -> update([
            'title' => 'updated',
            'content' => 'updated',
            'image' => 'updated',
            'likes'=> 1000,
            'is_published' => 0,
        ]);
    }


    public function ForceDelete (){
        $post = Post::find(2);
        $post->delete();

    }


    public function firstOrCreate(){
     
        $anotherPost = [
            'title' => 'some post',
            'content' => 'some content',
            'image' => 'some img',
            'likes'=> 101,
            'is_published' => 1,

        ];

        $post = Post::firstOrCreate([
            'title' => 'some title',
        ],[
            'title' => 'some post',
            'content' => 'some content',
            'image' => 'some img',
            'likes'=> 101,
            'is_published' => 1,
        ]);

        dd('finished');

    }


    public function updateOrCreate(){
     
        $anotherPost = [
            'title' => 'updated some post',
            'content' => 'updated some content',
            'image' => 'updated some img',
            'likes'=> 101,
            'is_published' => 1,

        ];

        $post = Post::updateOrCreate([
            'title' => 'some post',
        ],$anotherPost);

        dd('update finished');

    }

}


