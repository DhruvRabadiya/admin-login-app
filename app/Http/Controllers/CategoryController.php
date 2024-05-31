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
            if ($request->ajax()) {
                $data = Category::withCount('subcategories')->whereNull('parent_id')->select(['id', 'category_name', 'url', 'description']);
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('subcategory', function ($category) {
                        return '<button type="button" class="viewSubcategories btn btn-info btn-sm" data-id="' . $category->id . '">View Subcategories</button>';
                    })
                    ->addColumn(
                        'action',
                        function ($data) {

                            $editButton = '<button type="button" class="editBtn btn btn-primary btn-sm ml-2" data-id="' . $data->id . '">Edit</button>';

                            $deleteButton =
                                '<button type="button" class="deleteBtn btn btn-danger btn-sm ml-2" data-id="' . $data->id . '">Delete</button>';
                            return  $editButton . $deleteButton;
                        }
                    )
                    ->rawColumns(['subcategory' ,'action'])

                    ->make(true);
            }
            return view('category', compact('user'));
        }
        return redirect()->route('profile');
    }

    public function subcategories($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $subcategories = $category->subcategories()->select('id', 'category_name', 'url', 'description', 'status')->get();
        return response()->json($subcategories);
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
}
