<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    //

    public function index(): View
    {
        $posts = Post::all();
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());


        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $image->hashName(),
        ]);

        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show($id): View
    {
       $post = Post::find($id);
         return view('posts.show', [
              'post' => $post
         ]);
    }

    public function edit($id): View
    {
        $post = Post::find($id);
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {

        $this->validate($request, [
            'image'     => 'image|mimes:jpeg,jpg,png|max:2048',
            'title'     => 'required',
            'content'   => 'required'
        ]);

        $post = Post::findOrFail($id);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            Storage::delete('public/posts/'.$post->image);

            $post->update([
                'title'     => $request->title,
                'content'   => $request->content,
                'image'     => $image->hashName(),
            ]);

        } else {
            $post->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);
        }

        //redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
      
        $post = Post::find($id);
        Storage::delete('public/posts/'.$post->image);
        $post->delete();
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
