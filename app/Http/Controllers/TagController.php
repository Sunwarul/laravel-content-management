<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\Tag\CreateTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {
        $min_one_tag = Tag::all()->count();
        if (!$min_one_tag) {
            DB::statement('ALTER TABLE tags AUTO_INCREMENT = 1');
        }
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();
        return redirect()->route('tags.index')->with('success', 'Tag Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('tags.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tags.create')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->save();

        // $tag->update([
        //     'name' => $request->name
        // ]);

        session()->flash('success', 'Tag Updated!');
        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        session()->flash('warning', 'tag deleted successfully!');
        return redirect(route('tags.index'));
    }
}
