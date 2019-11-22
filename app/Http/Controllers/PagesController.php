<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function search()
    {
        // $posts = DB::select('select * from posts where title like "%Timesheets%"');
        // $posts = Post::where('title', 'LIKE', "%Timesheets%")->get();
        // return $posts;
        if (request()->query('search')) {
            $searchString = request()->query('search');
            $posts = Post::where('title', 'LIKE', "%{$searchString}%")->get();
            return view('posts.search-result')->with('posts', $posts);
        }
    }
}
