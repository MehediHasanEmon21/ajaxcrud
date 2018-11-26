<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $data = [
        'title' => $request['title'],
        'author' => $request['author'],
        'details' => $request['details'],
       ];
        return Post::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request['title'];
        $post->author = $request['author'];
        $post->details = $request['details'];
        $post->update();
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id);
       
    }

    public function all_post(){

        $posts = Post::all();
        return DataTables::of($posts)
               ->addColumn('action',function($posts){

                return 
                '<a onclick="showData('.$posts->id.')" class="btn btn-sm btn-info">Show</a>'.' '.'<a onclick="editForm('.$posts->id.')" class="btn btn-sm btn-primary">Edit</a>'.' '.'<a onclick="deleteData('.$posts->id.')" class="btn btn-sm btn-danger">Delete</a>';

               })->make(true);

    }
}
