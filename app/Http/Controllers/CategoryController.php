<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Video;
use App\Enums\ActiveStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
        }

        // Get all stats
        $totalCategories = Category::count();
        $activeCategories = Category::where('status', ActiveStatus::ACTIVE)->count();
        $totalVideos = Video::count();
        $categoriesWithVideos = Category::whereHas('videos')->count();

        // Calculate growth
        $lastMonthCategories = Category::where('created_at', '<', Carbon::now()->startOfMonth())
            ->where('created_at', '>=', Carbon::now()->subMonth()->startOfMonth())
            ->count();

        $growth = $lastMonthCategories > 0 
            ? (($totalCategories - $lastMonthCategories) / $lastMonthCategories) * 100 
            : ($totalCategories > 0 ? 100 : 0);

        // Get popular categories
        $popularCategories = Category::withCount('videos')
            ->orderBy('videos_count', 'desc')
            ->limit(3)
            ->get();

        // Get categories with video counts
        $categories = $query->withCount('videos')
                          ->latest()
                          ->paginate(12);

        return view('admin.category', compact(
            'categories',
            'totalCategories',
            'activeCategories',
            'totalVideos',
            'categoriesWithVideos',
            'popularCategories',
            'growth'
        ));
    }

    public function toggleStatus(Category $category)
    {
        try {
            $category->status = $category->status === ActiveStatus::ACTIVE 
                ? ActiveStatus::INACTIVE 
                : ActiveStatus::ACTIVE;
            $category->save();

            return response()->json([
                'success' => true,
                'status' => $category->status->value,
                'message' => 'Category status updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update category status'
            ], 500);
        }
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

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            
            // Detach all videos from this category (removes pivot table entries)
            $category->videos()->detach();
            
            // Delete the category
            $category->delete();

            return redirect()->route('categories')
                ->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('categories')
                ->with('error', 'Failed to delete category. Please try again.');
        }
    }
}
