<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;
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
        //Prendiamo tutte le categorie presenti sul DB e le inserisco in una variabile
        //Variabile = Oggetto::metodoAll()
        $categories = Category::all();
        $tags = Tag::all();
        //Oltre a passare la vista, passeremo la variabile che conterrà al suo interno un array di tutte le categorie
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //prima validazione create
        $request->validate([
            "title" => "required|max:255",
            'content' => "required",
            //L'id che mi hai appena passato, nella tabella categories esiste? 
            'category_id' => 'nullable|exists:categories,id',
            //tags esiste nella tabella tags e nello specifico nella colonna id?
            'tags' => 'exists:tags,id'
        ]);
    

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
        $new_post->tags()->attach($form_data['tags']);
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
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(!$post) {
            abort(404);
        }
        $categories = Category::all();
        return view('admin.posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //prima validazione edit
        $request->validate([
            "title" => "required|max:255",
            'content' => "required"
        ]);
        
        $form_data = $request->all();
        //Il titolo è diverso da quello che c'era 'precedentemente? 
        //Se si, devi modificare anche lo slug che è strettamente legato al title.
        if($form_data != $post->title) {
            $slug = Str::slug($form_data['title'], '-');
            //Where('nomecolonna', valore colonna)
            $slug_exist = Post::where('slug', $slug)->first();
            //il ciclo inizia se lo slug è gia presente
            $i= 1;
            while($slug_exist) {
                $slug = $slug . '-' . $i;
                $slug_exist = Post::where('slug', $slug)->first();
                $i++;
            }
            /*
                Dobbiamo inviare il nuovo slug, quindi bisogna assegnare la proprietà slug
            */
            $form_data['slug'] = $slug;
        }
        $post->update($form_data);
        return redirect()->route('admin.posts.index')->with('modified', 'Il record è stato modificato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
