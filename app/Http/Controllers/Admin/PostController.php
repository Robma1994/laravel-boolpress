<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->all();
        $new_post = new Post();
        $new_post->fill($form_data);
       
    /* 
        Se provo ad inviare dati al DB mi darà errore perchè non c'è corrispondenza tra le
        fillable e i name dell'input perchè manca lo slug che faremo create automaticamente
        con il metodo ::slug.
    */
        $slug = Str::slug($new_post->title, '-');
        //Where('nomecolonna', valore colonna)
        $slug_exist = Post::where('slug', $slug)->first();
        //il ciclo inizia se lo slug è gia presente
        $i= 1;
        while($slug_exist) {
            $slug = $slug . '-' . $i;
            $slug_exist = Post::where('slug', $slug)->first();
            $i++;
        }

        $new_post->slug = $slug;
        $new_post->save();
        return redirect()->route('admin.posts.index')->with('inserted', 'Il record è stato salvato correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if(!$post) {
            abort(404);
        }
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
