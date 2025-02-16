<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
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
