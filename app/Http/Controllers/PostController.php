<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Http\Requests\Post\CreatePostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Apply middleware on request
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verifyCategoryCount')->only(['create', 'edit', 'store', 'update']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // $posts = Post::orderByDesc('id')->get();
        $posts = Post::simplePaginate(1);
        $tags  = Tag::all();
        // return $posts;
        return view('posts.index', ['posts' => $posts, 'trashed' => 0, 'tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();
        $tags       = Tag::all();
        return view('posts.create')->with('categories', $categories)->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        // return $request;
        $minimum_one_post = Post::find(1);
        if (!$minimum_one_post) {
            Db::statement('ALTER TABLE posts AUTO_INCREMENT = 1');
            Db::statement('ALTER TABLE post_tag AUTO_INCREMENT = 1');
        }

        // Sample method for ref.
        // $image = $request->file('image')->store('images');
        // Storage::move($image, 'sub' . $image);
        // $image = 'sub' . $image;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('posts');
        } else {
            $image = '';
        }
        // create full post
        $post = Post::create([
            'title'       => $request->title,
            'description' => $request->description,
            'content'     => $request->content,
            'image'       => $image,
            'categories_id' => $request->category,
        ]);
        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }
        // flash success message
        session()->flash('success', 'Post created successfully!');
        //  redirect to posts.index route
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Categories::all();
        $tags       = Tag::all();
        return view('posts.create')->with('post', $post)->with('categories', $categories)->with('tags', $tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title'       => 'required',
            'description' => 'required',
            'content'     => 'required',
            'category'    => 'required',
        ]);
        $data = $request->only(['title', 'description', 'content']);

        if ($request->hasFile('image')) {
            // update image
            $data['image'] = $request->image->store('posts');
            // delete image
            $post->deleteImage();
        }
        $data['category_id'] = $request->category;
        // return $data;
        // Update the post
        $post->update($data);
        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        // Flas update message
        session()->flash('success', 'Post Updated successfully');
        // Redirect
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        if ($post->trashed()) {
            $post->forceDelete();
            // Storage::delete($post->image);
            $post->deleteImage();
            $post->tags()->detach();
            session()->flash('error', 'Parmanently Deleted the post!');
            return redirect()->route('trashed-posts.index');
        } else {
            $post->delete();
            session()->flash('error', 'Thrown the post to trash!');
        }
        return redirect(route('posts.index'));
    }

    public function trashed()
    {
        // $trashed = Post::withTrashed()->get();
        $trashed = Post::onlyTrashed()->get();
        // return view('posts.index')->withPosts($trashed);
        return view('posts.index', [
            'posts'   => $trashed,
            'trashed' => 1,
        ]);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();
        return redirect()->back()->with('success', 'Restored the post!');
    }
    // TODO:: Accomplish the Restore All feature

    public function restore_all()
    {
        $posts = Post::onlyTrashed()->get();
        foreach ($posts as $post) {
            $post->restore();
        }
        return redirect(route('posts.index'))->with('Restored all trashed post!');
    }
}
