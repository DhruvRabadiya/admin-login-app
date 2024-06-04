<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function category(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $categories = Category::whereNull('parent_id')->get();

            if ($request->ajax()) {
                $data = Category::withCount('subcategories')
                    ->whereNull('parent_id')
                    ->select(['id', 'category_name', 'status']); // Include status field here

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('subcategory', function ($category) {
                        return '<button type="button" class="viewSubcategories btn btn-info btn-sm" data-id="' . $category->id . '">View Subcategories</button>';
                    })
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
                            $addSubCategory = '<button type="button" class="addSubCategoryBtn btn btn-warning btn-sm ml-2" data-id="' . $data->id . '">Add Subcategory</button>';
                            return $statusButton . $addSubCategory . $editButton . $deleteButton;
                        }
                    )
                    ->rawColumns(['subcategory', 'action'])
                    ->make(true);
            }
            return view('category', compact('user', 'categories'));
        }
        return redirect()->route('profile');
    }

    public function subcategories($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $subcategories = $category->subcategories()->select('id', 'category_name',   'status')->get();
        return response()->json($subcategories);
    }

    public function addCategory(Request $request)
    {
        if ($request->category_id != null) {
            $category = Category::find($request->category_id);
            if (!$category) {
                abort(404);
            }
            $data = $request->only('category_name', 'status');
            $category->update($data);
            return response()->json([
                'success' => "User Edited Successfully",
            ], 201);
        } else {
            $request->validate([
                'category_name' => 'required|string|max:255',
                'status' => 'required|integer',
            ]);

            Category::create([
                'category_name' => $request->category_name,
                'status' => $request->status,
            ]);

            return response()->json(['success' => 'Category Added Successfully']);
        }
    }

    public function editCategory($id)
    {
        $category = Category::find($id);
        if ($category) {
            return response()->json($category);
        } else {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json([
                'success' => 'Category Deleted Successfully'
            ], 201);
        } else {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }
    public function toggleStatus($id)
    {
        $category = Category::find($id);
        if ($category) {
            // Toggle the status
            $category->status = $category->status ? 0 : 1; // Toggle between 0 and 1
            $category->save();

            return response()->json(['success' => 'Category status toggled successfully', 'status' => $category->status]);
        } else {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }
    public function addSubCategory(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_name' => 'required|string|max:255',
            'status' => 'required|integer',
        ]);

        // Create the subcategory
        Category::create([
            'parent_id' => $request->category_id,
            'category_name' => $request->subcategory_name,
            'status' => $request->status,
        ]);

        return response()->json(['success' => 'Subcategory Added Successfully']);
    }
}
