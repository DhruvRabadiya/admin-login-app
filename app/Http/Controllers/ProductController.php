<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function products(Request $request)
    {
        $user = Auth::user();
        $subcategories = Category::whereNotNull('parent_id')->get();
        $categories = Category::whereNull('parent_id')->get();

        if ($user) {
            if ($request->ajax()) {
                $data = Product::select(['id','product_name'  , 'image' ,'status']);

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


    public function deleteProduct($id){
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
