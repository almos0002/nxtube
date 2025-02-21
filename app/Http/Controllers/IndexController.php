<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $settings;
    protected $categories;

    public function __construct()
    {
        $this->settings = Setting::first();
        $this->categories = Category::all();
        view()->share([
            'settings' => $this->settings,
            'categories' => $this->categories
        ]);
    }

    public function home()
    {
        return view('index.home');
    }

    public function about()
    {
        return view('index.about');
    }

    public function contact()
    {
        return view('index.contact');
    }

    public function privacy()
    {
        return view('index.privacy');
    }

    public function video($id)
    {
        return view('index.video', compact('id'));
    }

    public function channel($id)
    {
        return view('index.channel', compact('id'));
    }

    public function actor($id)
    {
        return view('index.actor', compact('id'));
    }

    public function category($id)
    {
        $category = Category::findOrFail($id);
        $videos = $category->videos()->paginate(12);
        return view('index.category', compact('category', 'videos'));
    }
}
