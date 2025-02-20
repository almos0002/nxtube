<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        // Get all categories with their video counts using pivot table
        $categories = Category::withCount('videos')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        // Calculate total categories
        $totalCategories = Category::count();

        // Get last month's category count for comparison
        $lastMonthCategories = Category::where('created_at', '<', Carbon::now()->startOfMonth())
            ->where('created_at', '>=', Carbon::now()->subMonth()->startOfMonth())
            ->count();

        // Calculate growth percentage
        $growth = $lastMonthCategories > 0 
            ? (($totalCategories - $lastMonthCategories) / $lastMonthCategories) * 100 
            : 0;

        // Get categories with most videos using pivot table
        $popularCategories = Category::withCount('videos')
            ->orderBy('videos_count', 'desc')
            ->limit(3)
            ->get();

        // Get total videos across all categories
        $totalVideos = Video::count();

        // Get active categories (categories with videos) using pivot table
        $activeCategories = Category::whereHas('videos')->count();

        return view('admin.category', compact(
            'categories',
            'totalCategories',
            'growth',
            'popularCategories',
            'totalVideos',
            'activeCategories'
        ));
    }

    public function create()
    {
        return view('crud.category.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'required',
        ]);

        // If Name is Duplicate
        if (Category::where('name', $validatedData['name'])->exists()) {
            return redirect()->back()->withErrors(['name' => 'This name is already taken.'])->withInput();
        }

        $category = Category::create($validatedData);

        return redirect()->route('categories')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('crud.category.update', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:categories,name,'.$id,
            'description' => 'required',
        ]);

        $category->update($validatedData);

        return redirect()->route('categories')->with('success', 'Category updated successfully.');
    }
}
