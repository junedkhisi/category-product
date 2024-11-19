<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with('category:id,name')
                ->select(['id', 'category_id', 'name', 'description', 'price', 'image']); // Include the 'image' column

            return DataTables::of($products)
                ->addColumn('category_name', function ($product) {
                    return $product->category->name;
                })
                ->addColumn('image', function ($product) {

                    if ($product->image) {
                        $imageUrl = asset(  $product->image);
                        return '<img src="' . $imageUrl . '" alt="' . $product->name . '" width="100" height="100" class="img-thumbnail">';
                    } else {
                        return '<span>No Image</span>';
                    }
                })
                ->addColumn('actions', function ($product) {
                    return '
                    <a href="' . route('products.edit', $product) . '" class="btn btn-warning btn-sm">Edit</a>
                    <form action="' . route('products.destroy', $product) . '" method="POST" class="delete-form" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    ';
                })
                ->rawColumns(['actions', 'image'])  // Make the 'image' column HTML safe
                ->make(true);
        }

        return view('products.index');
    }


    public function create()
    {
        $categories = \App\Models\Category::all();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,avif,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/products'), $imageName);  // Move image to public/images/products/
            $imagePath = 'images/products/' . $imageName;  // Store relative path
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => isset($imagePath) ? $imagePath : null,
        ]);

        return redirect()->route('products.index')->with('success', 'Product Created Successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,avif,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(storage_path( $product->image))) {
                unlink(storage_path($product->image));

            }


            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/products'), $imageName);  // Move image to public/images/products/
            $imagePath = 'images/products/' . $imageName;  // Store

            $product->image = $imagePath;
        }

        $product->update($request->except('image'));

        return redirect()->route('products.index')->with('success', 'Product Updated Successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully.');
    }
}
