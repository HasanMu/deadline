<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_post = \App\PostQuestion::with('user', 'category', 'tags')->orderBy('created_at')->paginate(5);

        return view('frontend.index', compact('all_post'));
    }

    public function postCategory(Category $category)
    {
        $all_post = $category->postquestion()->latest()->paginate(5);

        return view('frontend.index', compact('all_post'));
    }

    public function postTag(Tag $tag)
    {
        $all_post = $tag->postquestion()->latest()->paginate(5);

        return view('frontend.index', compact('all_post'));
    }

    public function profile()
    {
        return view('frontend.myprofile');
    }
}
