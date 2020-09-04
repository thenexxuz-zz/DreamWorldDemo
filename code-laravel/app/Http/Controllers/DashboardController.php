<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'my_posts' => Post::query()->where('user_id', '=', auth()->id())->get(),
            'others_posts' => Post::query()->with('User')->where('user_id', '!=', auth()->id())->get(),
        ];

        return view('dashboard', $data);
    }
}
