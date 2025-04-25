<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\str;
use Illuminate\Support\Facades\storage;

class PostController extends Controller
{
    public function index(){
        $posts=Post::all();
        return view('posts.index',compact('posts '));
    }

    public function create(){
        return view('post.create');


    }
   
    public function store(Requests $request){

               $request->validate([
                'title'=>'require|string|max:255',
                'content'=>'required',
                'image'=>'image|nullable|max:1999'
               ]);



               $imagepath=null;


               if($request->hasFile('image')){
                $imagePath =$request->file('image')->store('image','public');
               }

                 
             Post::Create([
                'title'=>$request->title,
                'slug'=>str::slug($request->title),
                'content'=>$request->content,
                'image' =>$imagePath
             ]);


             return redirect()->route('post_index')->with('success','Post Created Successfully');
    }



}
