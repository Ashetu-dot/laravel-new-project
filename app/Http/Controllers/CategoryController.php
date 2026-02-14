<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $vendor = Auth::user(); // Get the authenticated vendor
        
        // Get categories with product counts and parent/child relationships
        $categories = Category::withCount('products')
            ->with('parent')
            ->orderBy('name')
            ->get();
            
        // Get only parent categories for the dropdown (for creating new categories)
        $parentCategories = Category::whereNull('parent_id')->orderBy('name')->get();
        
        // Pass vendor to the view along with categories
        return view('vendor.categories.index', compact('vendor', 'categories', 'parentCategories'));
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string|max:500',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'is_active' => $request->boolean('is_active', true),
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $data['image'] = $path;
        }

        $category = Category::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully!',
            'category' => $category->load('parent')
        ]);
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:500',
            'parent_id' => 'nullable|exists:categories,id|not_in:' . $category->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'is_active' => $request->boolean('is_active', $category->is_active),
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $path = $request->file('image')->store('categories', 'public');
            $data['image'] = $path;
        }

        $category->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully!',
            'category' => $category->load('parent')
        ]);
    }

    /**
     * Remove the specified category.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        // Check if category has products
        if ($category->products()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete category with associated products.'
            ], 400);
        }

        // Check if category has child categories
        if ($category->children()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete category with subcategories.'
            ], 400);
        }

        // Delete image if exists
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully!'
        ]);
    }

    /**
     * Get all categories for API.
     */
    public function getCategories()
    {
        $categories = Category::withCount('products')
            ->with('parent')
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'categories' => $categories
        ]);
    }
}