<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function products(Request $request)
    {
        $user = Auth::user();
        $subcategories = Category::whereNotNull('parent_id')->get();
        $categories = Category::whereNull('parent_id')->get();

        if ($user) {
            if ($request->ajax()) {
                $data = Product::select(['id', 'product_name', 'image', 'status']);

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn(
                        'action',
                        function ($data) {
                            $statusClass = $data->status ? 'btn-success' : 'btn-danger';
                            $statusText = $data->status ? 'Active' : 'Inactive';

                            $statusButton = '<button type="button" class="statusBtn btn ' . $statusClass . ' btn-sm ml-2" data-id="' . $data->id . '">';
                            $statusButton .= $statusText;
                            $statusButton .= '</button>';

                            $editButton = '<button type="button" class="editBtn btn btn-primary btn-sm ml-2" data-id="' . $data->id . '">Edit</button>';

                            $deleteButton = '<button type="button" class="deleteBtn btn btn-danger btn-sm ml-2" data-id="' . $data->id . '">Delete</button>';

                            return $statusButton . $editButton . $deleteButton;
                        }
                    )
                    ->rawColumns(['subcategory', 'action'])
                    ->make(true);
            }
            return view('products', compact('user', 'subcategories', 'categories'));
        }
        return redirect()->route('profile');
    }

    public function addProduct(Request $request)
    {
        if ($request->product_id != null) {
            $product = Product::find($request->product_id);
            if (!$product) {
                abort(404);
            }
            $data = $request->only('product_name', 'subcategory_id', 'category_id', 'status');

            // Check if a new image is provided
            if ($request->hasFile('image')) {
                // Handle file upload
                $imagePath = $request->file('image')->store('products', 'public');
                // Delete the previous image file
                Storage::disk('public')->delete($product->image);
                // Update the image path
                $data['image'] = $imagePath;
                // Update the product with all data including the new image path
                $product->update($data);
            } else {
                // If no new image is provided, update the product with other data
                $product->update($data);
            }

            $product->update($data);
            return response()->json([
                'success' => "Product Edited Successfully",
            ], 201);
        } else {
            $validator = Validator::make($request->all(), [
                'product_name' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'category_id' => 'required|exists:categories,id',
                'subcategory_id' => 'required|exists:categories,id',
                'status' => 'required|in:0,1',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->first()], 422);
            }

            // Handle file upload
            $imagePath = $request->file('image')->store('products', 'public');

            $product = new Product();
            $product->product_name = $request->product_name;
            $product->image = $imagePath;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->status = $request->status;
            $product->save();

            return response()->json(['success' => 'Product added successfully'], 201);
        }
    }

    public function editProduct($id)
    {
        $product = Product::find($id);

        if ($product) {
            return response()->json(['success' => true, 'data' => $product]);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }
    public function deleteProduct($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();

            return response()->json([
                'success' => 'Product deleted successfully'
            ], 201);
        } else {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }

    public function toggleStatus($id)
    {
        $product = Product::find($id);
        if ($product) {
            // Toggle the status
            $product->status = $product->status ? 0 : 1; // Toggle between 0 and 1
            $product->save();

            return response()->json(['success' => 'Product status toggled successfully', 'status' => $product->status]);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }
}
