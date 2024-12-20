<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::select(['id', 'name', 'status']);

            return DataTables::of($categories)
                ->addColumn('actions', function ($category) {
                    return '
                        <a href="' . route('categories.edit', $category) . '" class="btn btn-warning btn-sm">Edit</a>
                        <form action="' . route('categories.destroy', $category) . '" method="POST" class="delete-form" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    ';
                })
                ->addColumn('status', function ($category) {
                    return '<button class="btn ' . ($category->status == 'active' ? 'btn-success' : 'btn-secondary') . ' btn-sm toggle-status" data-id="' . $category->id . '" data-status="' . ($category->status == 'active' ? 'inactive' : 'active') . '">' . ucfirst($category->status) . '</button>';
                })
                ->rawColumns(['actions', 'status'])
                ->make(true);
        }

        // $categories = Category::all();
        return view('categories.index');
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);
        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category Created Successfully.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category Updated Successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category Deleted Successfully.');
    }

    public function show()
    {
        $categories = Category::all();

        return view('home', compact('categories'));
    }

    public function showCategoryProducts(Category $category)
    {
        $products = Product::where('category_id', $category->id)->get();
        return view('categories.show', compact('category', 'products'));
    }
}
